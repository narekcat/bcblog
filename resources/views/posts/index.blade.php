@extends('layouts.app')

@section('content')

    <div class = "panel-body">
        @include('common.errors')
        
        <h3 class = "text-center">Add new post</h3>
        <form action = "{{ url('posts') }}" method = "POST" class = "form-horizontal">
            {{ csrf_field() }}

            <div class = "form-group">
                <label for = "title" class = "col-sm-3 control-label">Title</label>

                <div class = "col-sm-6">
                    <input type = "text" name = "title" class = "form-control">
                </div>
            </div>

            <div class = "form-group">
                <label for = "body" class = "col-sm-3 control-label">Body</label>

                <div class = "col-sm-6">
                    <textarea name = "body" class = "form-control" rows = "10"></textarea>
                </div>
            </div>

            <div class = "form-group">
                <div class = "col-sm-offset-3 col-sm-6">
                    <button type = "submit" class = "btn btn-default">
                        <i class = "fa fa-plus"></i> Add Post
                    </button>
                </div>
            </div>

        </form>

        @if (count($posts) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Posts
                </div>

                <div class="panel-body">
                    <table class = "table table-striped task-table">
                        <thead>
                            <th>Title</th>
                            <th>Created at</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>

                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <a href = "{{ url('posts/' . $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                
                                <td>{{ $post->created_at }}</td>
                                
                                <!-- Edit Button -->
                                <td>
                                    <form action="{{ url('posts/' . $post->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        <button type="submit" id="edit-task-{{ $post->id }}" class="btn btn-default">
                                            <i class="fa fa-btn fa-edit"></i>Edit
                                        </button>
                                    </form>
                                </td>
                                
                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('posts/'.$post->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-post-{{ $post->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        @endif

    </div>

@endsection