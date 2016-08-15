<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function edit(User $user, Post $post)
    {
        return $user->id === (int)$post->user_id;
    }

    /**
     * Determine if the given user can delete the given post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === (int)$post->user_id;
    }
}
