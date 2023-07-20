<?php

namespace App\Services;

use App\Exceptions\CustomApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class JsonPlaceholderApi
{
    private const BASE_URL = 'https://jsonplaceholder.typicode.com/';

    private Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => self::BASE_URL,
            'timeout' => 10,
        ]);
    }

    /**
     * Get all users from the API
     *
     * @return array|null
     * @throws CustomApiException
     */
    public function getUsers(): ?array
    {
        $response = $this->sendRequest('users');

        if ($response['statusCode'] !== 200) {
            throw new CustomApiException('Ошибка при получении пользователей', $response['statusCode']);
        }

        return $response['data'];
    }

    /**
     * Get posts of a specific user by ID
     *
     * @param int $userId
     * @return array|null
     * @throws CustomApiException
     */
    public function getUserPosts(int $userId): ?array
    {
        $response = $this->sendRequest("users/{$userId}/posts");

        if ($response['statusCode'] !== 200) {
            throw new CustomApiException('Ошибка при получении постов пользователя', $response['statusCode']);
        }

        return $response['data'];
    }

    /**
     * Get todos of a specific user by ID
     *
     * @param int $userId
     * @return array|null
     * @throws CustomApiException
     */
    public function getUserTodos(int $userId): ?array
    {
        $response = $this->sendRequest("users/{$userId}/todos");

        if ($response['statusCode'] !== 200) {
            throw new CustomApiException('Ошибка при получении заданий пользователя', $response['statusCode']);
        }

        return $response['data'];
    }

    /**
     * @throws CustomApiException
     */
    public function getUserById(int $userId): ?array
    {
        $user = $this->sendRequest("users/{$userId}");

        if ($user['statusCode'] !== 200) {
            throw new CustomApiException('Ошибка при получении данных о пользователе', $user['statusCode']);
        }

        $posts = $this->getUserPosts($userId);
        $todos = $this->getUserTodos($userId);

        return [
            'user' => $user['data'],
            'posts' => $posts,
            'todos' => $todos,
        ];
    }

    /**
     * Add a new post
     *
     * @param array $data
     * @return array|null
     * @throws CustomApiException
     */
    public function addPost(array $data): ?array
    {
        $response = $this->sendRequest('posts', 'POST', $data);

        if ($response['statusCode'] !== 200 and $response['statusCode'] !== 201) {
            throw new CustomApiException('Ошибка при добавлении поста', $response['statusCode']);
        }

        return [
            'message' => 'Пост успешно создан',
            'data' => $response['data'],
        ];

    }

    /**
     * Update existing post by ID
     *
     * @param int $postId
     * @param array $data
     * @return array|null
     * @throws CustomApiException
     */
    public function updatePost(int $postId, array $data): ?array
    {
        $response = $this->sendRequest("posts/{$postId}", 'PUT', $data);

        if ($response['statusCode'] !== 200 and $response['statusCode'] !== 201) {
            throw new CustomApiException('Ошибка при обновлении поста', $response['statusCode']);
        }

        return [
            'message' => 'Пост успешно обновлен',
            'data' => $response['data'],
        ];
    }

    /**
     * Delete post by ID
     *
     * @param int $postId
     * @return array|null
     * @throws CustomApiException
     */
    public function deletePost(int $postId): ?array
    {
        $response = $this->sendRequest("posts/{$postId}", 'DELETE');

        if ($response['statusCode'] !== 200) {
            throw new CustomApiException('Ошибка при удалении поста', $response['statusCode']);
        }

        return [
            'message' => 'Пост успешно удален',
            'data' => $response['data'],
        ];
    }

    /**
     * Sending a request to the API and processing the response
     *
     * @param string $endpoint
     * @param string $method
     * @param array|null $data
     * @return array|null
     * @throws CustomApiException
     */
    private function sendRequest(string $endpoint, string $method = 'GET', ?array $data = null): array
    {
        try {
            $response = $this->httpClient->request($method, $endpoint, ['json' => $data]);
            $statusCode = $response->getStatusCode();
            $data = json_decode($response->getBody()->getContents(), true);

            return ['statusCode' => $statusCode, 'data' => $data];
        } catch (GuzzleException $e) {
            throw new CustomApiException('Ошибка при выполнении запроса: ' . $e->getMessage(), $e->getCode());
        }
    }
}

