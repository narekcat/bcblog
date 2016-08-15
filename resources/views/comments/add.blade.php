<h4>Comments</h4>
<form action = "{{ url('comments') }}" method = "POST" class = "form-horizontal">
    {{ csrf_field() }}
    
    <input type = "hidden" name = "post_id" value = "{{ $post->id }}">

    <div class = "form-group">

        <div class = "col-sm-6">
            <textarea name = "body" class = "form-control"></textarea>
            {{-- <input type = "text" name = "body" class = "form-control"> --}}
        </div>
    </div>

    <div class = "form-group">
        <div class = "col-sm-1">
            <button type = "submit" class = "btn btn-default">
                <i class = "fa fa-plus"></i> Add Comment
            </button>
        </div>
    </div>
</form>
