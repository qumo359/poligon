@if($errors->any())
    <div class="row justify-content-center">
        <div class="col-md-11">
            @foreach ($errors->all() as $errorTxt)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errorTxt }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if(session('success'))
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
