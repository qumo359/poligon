@extends ('layouts.app')

@section('content')
    @include('blog.admin.admin_sidebar')

    @php /** @var \App\Models\BlogCategory $item */ @endphp

    @if($item->exists())
        <form method="POST" action="{{ route('admin.categories.update', $item->id) }}">
        @method('PATCH')
            @else
                <form method="POST"  action="{{ route('admin.categories.store', $item->id) }}">
                    @endif
                    @csrf

                    <input class="visually-hidden">
                    <div class="container">
                        @php /** @var \Illuminate\Support\ViewErrorBag $errors */ @endphp
                        @if($errors->any())
                            <div class="row justify-content-center">
                                <div class="col-md-11">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                        {{$errors->first()}}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="row justify-content-center">
                                <div class="col-md-11">
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include('blog.admin.categories.includes.item_edit_main_col')
                            </div>
                            <div class="col-md-3">
                                @include('blog.admin.categories.includes.item_edit_add_col')
                            </div>
                        </div>
                    </div>
                </form>
        @endsection


