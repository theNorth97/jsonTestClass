<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomApiException;
use App\Services\JsonPlaceholderApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JsonPlaceholderApiController extends Controller
{
    private JsonPlaceholderApi $api;

    public function __construct(JsonPlaceholderApi $api)
    {
        $this->api = $api;
    }

    /**
     * Get all users from the API
     *
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse
    {
        try {
            $users = $this->api->getUsers();

            $statusCode = $users['statusCode'] ?? 200;
            if ($statusCode !== 200) {
                throw new CustomApiException('Ошибка при получении пользователей', $statusCode);
            }

            return response()->json(['data' => $users['data']], $statusCode);
        } catch (CustomApiException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }

    /**
     * Get posts of a specific user by ID
     *
     * @param int $userId
     * @return array|null
     */
    public function getUserPosts(int $userId): ?JsonResponse
    {
        try {
            $userPosts = $this->api->getUserPosts($userId);

            $statusCode = $userPosts['statusCode'] ?? 200;
            if ($statusCode !== 200) {
                throw new CustomApiException('Ошибка при получении постов пользователя', $statusCode);
            }

            return response()->json(['data' => $userPosts['data']], $statusCode);
        } catch (CustomApiException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }

    /**
     * Get todos of a specific user by ID
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function getUserTodos(int $userId): JsonResponse
    {
        try {
            $userTodos = $this->api->getUserTodos($userId);

            $statusCode = $userTodos['statusCode'] ?? 200;
            if ($statusCode !== 200) {
                throw new CustomApiException('Ошибка при получении заданий пользователя', $statusCode);
            }

            return response()->json(['data' => $userTodos['data']], $statusCode);
        } catch (CustomApiException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }

    /**
     * Get user details, posts, and todos by ID
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function getUserById(int $userId): JsonResponse
    {
        try {
            $user = $this->api->getUserById($userId);
            $posts = $this->api->getUserPosts($userId);
            $todos = $this->api->getUserTodos($userId);

            return response()->json([
                'user' => $user['data'],
                'posts' => $posts,
                'todos' => $todos,
            ], 200);
        } catch (CustomApiException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }

    /**
     * Add a new post
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addPost(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $postData = $this->api->addPost($data);
            return response()->json(['message' => 'Пост успешно создан', 'data' => $postData], 200);
        } catch (CustomApiException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }

    /**
     * Update existing post by ID
     *
     * @param int $postId
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePost(int $postId, Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $postData = $this->api->updatePost($postId, $data);
            return response()->json(['message' => 'Пост успешно обновлен', 'data' => $postData], 200);
        } catch (CustomApiException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }

    /**
     * Delete post by ID
     *
     * @param int $postId
     * @return JsonResponse
     */
    public function deletePost(int $postId): JsonResponse
    {
        try {
            $postData = $this->api->deletePost($postId);
            return response()->json(['message' => 'Пост успешно удален', 'data' => $postData['data']], 200);
        } catch (CustomApiException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }
}
