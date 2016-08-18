@if (session('success'))
    <div class = "alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>{{ session('success') }}</p>
        {{ session()->forget('success') }}
    </div>
@endif
