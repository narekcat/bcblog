@extends('layouts.app')

@section('content')

    <div class = "panel-body">
        @include('common.errors')
        @include('common.success')
        
        <div class = "blog-post">
            <h2 class = "blog-post-title">{{ $post->title }}</h2>
            <p clas = "blog-post-meta">
                <small class="text-muted">{{ $post->user()->get()->first()->name }}</small>
                <small class = "text-muted">{{ $post->created_at }}</small>
            </p>
            <p>{{ $post->body }}</p>
            <br>
        </div>

        @if ($post->user_id == $user_id)
        <div class = "row">
            <!-- Edit Button -->
            <div  class = "col-sm-1">
                <form action="{{ url('posts/' . $post->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <button type="submit" id="edit-task-{{ $post->id }}" class="btn btn-default">
                        <i class="fa fa-btn fa-edit"></i>Edit
                    </button>
                </form>
            </div>
            
            <!-- Delete Button -->
            <div class = "col-sm-1">
                <form action="{{ url('posts/'.$post->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" id="delete-post-{{ $post->id }}" class="btn btn-danger">
                        <i class="fa fa-btn fa-trash"></i>Delete
                    </button>
                </form>
            </div>
        </div>
        @endif

        @include('comments.add')
        @include('comments.list')
    </div>

@endsection