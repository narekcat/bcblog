@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <h2>Welcome to the Post WebSite</h2>

        @include('common.errors')
        @include('common.success')

        @if (count($posts) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Posts
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>Post</th>
                            <th>Author</th>
                            <th>Created at</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <!-- Post Name -->
                                    <td class="table-text">
                                        <div>
                                            <a href = "{{ url('/posts/' . $post->id) }}">
                                                {{ $post->title }}
                                            </a>
                                        </div>
                                    </td>

                                    <td>
                                        <div>{{ $post->user()->get()->first()->name }}</div>
                                    </td>

                                    <td>
                                        <div>{{ $post->created_at }}</div>
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
