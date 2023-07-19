<?php

namespace App\Http\Controllers;

use App\Services\JsonPlaceholderApi;

class ApiController extends Controller
{
    public function index()
    {
        $api = new JsonPlaceholderApi();

        // calling methods to work with API
        $users = $api->getUsers();
        $userPosts = $api->getUserPosts(3);
        $userTodos = $api->getUserTodos(3);
        $newPostData = [
            'userId' => 1,
            'title' => 'New Post Title ',
            'body' => 'New post content ',
        ];
        $newPost = $api->addPost($newPostData);
        $updatedPostData = [
            'title' => 'Updated Post Title',
            'body' => 'Updated post content',
        ];
        $updatedPost = $api->updatePost(1, $updatedPostData);
        $deletedPost = $api->deletePost(1);

        return view('my-view', [
            'users' => $users,
            'userPosts' => $userPosts,
            'userTodos' => $userTodos,
            'newPost' => $newPost,
            'updatedPost' => $updatedPost,
            'deletedPost' => $deletedPost,
        ]);
    }
}
