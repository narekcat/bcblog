<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Create new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Add new comment to the post
     *
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        $post = Post::find($request->post_id);
        if (empty($post)) {
            return redirect('/')->withErrors('Wrong post id.');
        }

        $this->validate($request, [
            'body' => 'required|min:3',
        ]);
        
        $post->comments()->create([
            'body' => $request->body,
            'user_id' => $request->user()->id,
        ]);

        return redirect('posts/' . $post->id)
            ->with('success', 'Your comment was successfully added.');
    }

    /**
     * Delete comment.
     *
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    public function delete(Request $request, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $postId = $comment->post_id;
        $comment->delete();

        return redirect('/posts/' . $postId)
            ->with('success', 'Your comment was successfully deleted.');
    }
}
