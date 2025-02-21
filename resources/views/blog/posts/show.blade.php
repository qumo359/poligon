@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h1>{{$item->title}}</h1>
            </div>
        </div>
        <div class="col">
            {{$item->content_raw}}
        </div>
    </div>
@endsection
