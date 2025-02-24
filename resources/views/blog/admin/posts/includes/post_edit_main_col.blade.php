@php
    /** @var \App\Models\BlogPost $item */
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <div class="card-subtitle mb-2 text-muted"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#adddata" role="tab">Доп данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input name="title" value="{{ $item->title }}"
                                   id="title"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="content_raw">Статья</label>


                            <textarea id="editor" name="content_raw">
                                 {{ old('content_raw', $item->content_raw) }}
                            </textarea>

{{--                            <textarea name="content_raw"--}}
{{--                                      id="content_raw"--}}
{{--                                      class="form-control"--}}
{{--                                      rows="20">{{ old('content_raw', $item->content_raw) }}</textarea>--}}
                        </div>

                        {{-- ** START: Added Image Upload Field ** --}}
                        <div class="form-group pt-2">

                            @if($item->post_image)
                            <img src="/storage/test/{{$item->post_image}}" style="max-width: 200px;">
                            @endif

                            <label for="post_image">Изображение поста</label>
                            <input type="file" name="post_image" id="post_image" class="form-control-file">
                            @if($item->post_image)
                                <div class="mt-2">
                                    <img  src="{{ asset('storage/' . $item->post_image) }}" alt="Текущее изображение" style="max-width: 200px;">
                                </div>
                            @endif
                            @error('post_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- ** END: Added Image Upload Field ** --}}

                    </div>
                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select name="category_id"
                                    id="category_id"
                                    class="form-control"
                                    placeholder="Выберите категорию"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->category_id) selected @endif>
                                        {{ $categoryOption->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input name="slug" value="{{ $item->slug }}"
                                   id="slug"
                                   type="text"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea name="excerpt"
                                      id="excerpt"
                                      class="form-control"
                                      rows="3">{{ old('excerpt', $item->excerpt) }}</textarea>
                        </div>

                        <div class="form-check">
                            <input name="is_published"
                                   type="hidden"
                                   value="0">

                            <input name="is_published"
                                   type="checkbox"
                                   class="form-check-input"
                                   value="1"
                                   @if($item->is_published)
                                       checked="checked"
                                @endif
                            >
                            <label class="form-check-label" for="is_published">Опубликовано</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        const {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } = CKEDITOR;
        const { FormatPainter } = CKEDITOR_PREMIUM_FEATURES;

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDE2NTExOTksImp0aSI6IjczNzExYjYxLTVhZGItNGY1Zi04MWI2LTdlYzQyNTI0MzQ2YSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImM0Mjg2N2M5In0.8ZafITx_lpqbj-g-hniggoivYqqxmXIJq3Gh26SQVAJ3tEJR2lgSchdT76Mmpy7gghP_ngL2L9wv1-4fNheckQ',
                plugins: [ Essentials, Bold, Italic, Font, Paragraph, FormatPainter ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'formatPainter'
                ]
            } )
            .then( /* ... */ )
            .catch( /* ... */ );
    </script>
@endpush
