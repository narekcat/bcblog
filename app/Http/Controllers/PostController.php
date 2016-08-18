<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a list of all of the user's posts.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('posts.index', [
            'posts' => $request->user()->posts()->paginate(4),
        ]);
    }

    /**
     * Add new post to the database.
     *
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'body' => 'required',
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        $request->session()
            ->put('success', 'Your post was successfully added.');
        return redirect('/posts');
    }

    /**
     * Get a post by id.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function view(Request $request, Post $post)
    {
        if (!empty($post)) {
            return view('posts.view', [
                'post' => $post,
                'comments' => $post->comments()->get(),
                'user_id' => $request->user()->id,
            ]);
        }
    }

    /**
     * Edit the post.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function edit(Request $request, Post $post)
    {
        $this->authorize('edit', $post);

        if (isset($request->title)) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:200',
                'body' => 'required',
            ]);
            if (!$validator->fails()) {
                $post->title = $request->title;
                $post->body = $request->body;
                $post->save();
                $request->session()
                    ->put('success', 'Your post was successfully edited.');
            } else {
                return view('posts.edit', [
                    'post' => $post,
                ])->withErrors($validator);
            }
        }
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Delete the post.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function delete(Request $request, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect('/posts')
            ->with('success', 'Your post was successfully deleted.');
    }

    /**
     * Search post by title.
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'word' => 'required|min:3'
        ]);
        
        $posts = Post::where('title', 'LIKE', '%' . $request->word . '%')->get();

        if (count($posts) == 0) {
            return view('posts.search', [
                'posts' => $posts,
            ])->withErrors('There is no result for this search');
        }

        return view('posts.search', [
            'posts' => $posts,
        ]);
    }
}
