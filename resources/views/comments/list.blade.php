@if (count($comments) > 0)
    <div class = "panel panel-default">
        <div cla{{-- ss = "panel-heading">
            Current Tasks
        </div> --}}

        <div class = "panel-body">
            <table class = "table table-striped task-table">
                
                {{-- <thead>
                    <th>Comment</th>
                    <th>Author</th>
                    <th>&nbsp;</th>
                </thead> --}}

                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td class = "table-text">
                            <p>
                                <span class = "text-muted">Author:</span>&nbsp;
                                {{ $comment->user()->get()->first()->name }}
                            </p>
                            <div>{{ $comment->body }}</div>
                        </td>

                        <td>
                        @if ($comment->user_id == $user_id)
                            <form action="{{ url('/comments/'.$comment->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" id="delete-task-{{ $comment->id }}" class="btn btn-xs btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>
                                </button>
                            </form>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
