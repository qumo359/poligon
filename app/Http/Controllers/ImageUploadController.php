<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        // 1. Валидация запроса
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Правила валидации
        ]);

        // 2. Проверка наличия файла в запросе
        if ($request->hasFile('image')) {

            // 3. Получение загруженного файла
            $image = $request->file('image');

            // 4. Генерация уникального имени файла
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();

            // 5. Сохранение файла на диск (public диск - storage/app/public)
            $path = $image->storeAs('images', $filename, 'public'); // 'images' - директория внутри storage/app/public, 'public' - имя диска

            // Или, если хотите сохранить в 'local' диске (storage/app):
            // $path = $image->storeAs('images', $filename, 'local');

            // 6. Сохранение пути к файлу в базе данных (опционально, пример)
            // ImageModel::create(['path' => $path]);

            // 7. Возврат ответа (например, URL к загруженному изображению)
            $imageUrl = Storage::disk('public')->url($path); // Получаем публичный URL к изображению (для public диска)

            // Или, если использовали local disk, URL не будет доступен напрямую,
            // вам нужно будет отдавать файл через контроллер, если нужно публично показывать.

            return response()->json(['success' => true, 'image_url' => $imageUrl, 'message' => 'Изображение успешно загружено.']);

        } else {
            return response()->json(['success' => false, 'message' => 'Файл не был загружен.'], 400); // Возвращаем ошибку, если файл отсутствует
        }
    }
}
