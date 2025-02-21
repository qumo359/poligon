<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

/**
 * Управление сстатьями блога
 *
 * @package App\Http\Controllers\Blog\Admin
 */
class PostController extends BaseController
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * PostController constructor
     */
    function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index', compact('paginator'));
    }

    public function storeTest(Request $request)
    {
        dd(1);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostCreateRequest $request)
    {
        dd(1);

        $data = $request->input();


        // **Загрузка и обработка изображения (если есть)**
        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();

            $imageInstance = Image::make($image); // Intervention Image
            $imageInstance->resize(800, null, function ($constraint) { // Изменение размера (опционально)
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $path = Storage::disk('public')->put('blog_post_images/' . $filename, $imageInstance->stream());
            $data['post_image'] = $path; // Сохраняем путь к изображению в данных поста
        }

        $item = (new BlogPost())->create($data);

        if ($item) {
            $job = new BlogPostAfterCreateJob($item);
            $this->dispatch($job);

            return redirect()->route('blog.admin.posts.edit', [$item->id])
                ->with(['success' => 'Успешно Сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ощибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     *
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogPostUpdateRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {

        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => 'Запись id=[{$id}] не найдена'])
                ->withInput();
        }

        $data = $request->all();
//        Ушло в обсервер
//        if (empty($data['slug'])) {
//            $data['slug'] = \Str::slug($data['title']);
//        }
//        if (empty($item->published_at) && $data['is_published']) {
//            $data['published_at'] = \Carbon\Carbon::now();
//        }

        // **Обновление изображения (если загружено новое)**
        if ($request->hasFile('post_image')) {

            // Удаление старого изображения (если есть) - Опционально, зависит от логики
            if ($item->post_image) {
                Storage::disk('public')->delete($item->post_image);
            }

            $image = $request->file('post_image');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();

            $imageInstance = Image::make($image);
            $imageInstance->resize(1600, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            Storage::disk('public')->put('test/' . $filename, $imageInstance->stream());

            $imagePreviewInstance = Image::make($image);
            $imagePreviewInstance->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            Storage::disk('public')->put('test/preview/' . $filename, $imagePreviewInstance->stream());

            $data['post_image'] = $filename;

        }

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = $this->blogPostRepository->getEdit($id); // Получаем запись перед удалением

        if (empty($item)) {
            return back()->withErrors(['msg' => 'Запись не найдена для удаления.']);
        }

        /** Soft delete: */
        $result = BlogPost::destroy($id);

//        /** Полное удаление: */
//        $result = BlogPost::forceDestroy($id);

//        /** Полное удаление без срабатывания обсерверов: */
//        $result = BlogPost::find($id)->forceDelete();

        if ($result) {
            // **Удаление изображения после удаления поста (если есть) - Опционально, зависит от логики**
            if ($item->post_image) {
                Storage::disk('public')->delete($item->post_image);
            }

            BlogPostAfterDeleteJob::dispatch($id);

            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['deleted_id' => $id, 'success' => "Запись с ID {$id} успешно удалена."]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления.']);
        }
    }

    /**
     *  Restore the specified resource from trash.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $post = BlogPost::onlyTrashed()->find($id);
        $post->restore();

        if (empty($post)) {
            return back()->withErrors(['msg' => 'Ошибка Восстановления.']);
        } else {
            return redirect()->route('blog.admin.posts.edit', $post->id)
                ->with(['success' => "Запись id: [$id] Восстановлена."]);
        }
    }
}
