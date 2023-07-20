<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomApiException;
use App\Services\JsonPlaceholderApi;
use Illuminate\Http\Request;

class JsonPlaceholderApiController extends Controller
{
    private JsonPlaceholderApi $api;

    public function __construct(JsonPlaceholderApi $api)
    {
        $this->api = $api;
    }

    /**
     * @throws CustomApiException
     */
    public function getUsers(): ?array
    {
        return $this->api->getUsers();
    }

    /**
     * @throws CustomApiException
     */
    public function getUserPosts($userId): ?array
    {
        return $this->api->getUserPosts($userId);
    }

    /**
     * @throws CustomApiException
     */
    public function getUserTodos($userId): ?array
    {
        return $this->api->getUserTodos($userId);
    }

    /**
     * Get user details, posts and todos by ID
     *
     * @param int $userId
     * @return array|null
     * @throws CustomApiException
     */
    public function getUserById(int $userId): ?array
    {
        return $this->api->getUserById($userId);
    }

    /**
     * @throws CustomApiException
     */
    public function addPost(Request $request): ?array
    {
        $data = $request->all();
        return $this->api->addPost($data);
    }

    /**
     * @throws CustomApiException
     */
    public function updatePost($postId, Request $request): ?array
    {
        $data = $request->all();
        return $this->api->updatePost($postId, $data);
    }

    /**
     * @throws CustomApiException
     */
    public function deletePost($postId): ?array
    {
        return $this->api->deletePost($postId);
    }
}
