@extends('layouts.app')

@section('content')

    <div class = "panel-body">
        @include('common.errors')
        @include('common.success')

        <h3 class = "text-center">Edit post</h3>
        <form action = "{{ url('posts/' . $post->id) }}" method = "POST" class = "form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class = "form-group">
                <label for = "title" class = "col-sm-3 control-label">Title</label>

                <div class = "col-sm-6">
                    <input type = "text" name = "title" class = "form-control" value = "{{ $post->title }}">
                </div>
            </div>

            <div class = "form-group">
                <label for = "body" class = "col-sm-3 control-label">Body</label>

                <div class = "col-sm-6">
                    <textarea name = "body" class = "form-control" rows = "10">{{ $post->body }}</textarea>
                </div>
            </div>

            <div class = "form-group">
                <div class = "col-sm-offset-3 col-sm-6">
                    <button type = "submit" class = "btn btn-default">
                        <i class = "fa fa-btn fa-edit"></i> Edit Post
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection