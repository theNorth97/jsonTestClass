<?php

namespace App\Services;

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
     */
    public function getUsers(): ?array
    {
        return $this->sendRequest('users');
    }

    /**
     * Get posts of a specific user by ID
     *
     * @param int $userId
     * @return array|null
     */
    public function getUserPosts(int $userId): ?array
    {
        return $this->sendRequest("users/{$userId}/posts");
    }

    /**
     * Get todos of a specific user by ID
     *
     * @param int $userId
     * @return array|null
     */
    public function getUserTodos(int $userId): ?array
    {
        return $this->sendRequest("users/{$userId}/todos");
    }

    /**
     * Add a new post
     *
     * @param array $data
     * @return array|null
     */
    public function addPost(array $data): ?array
    {
        return $this->sendRequest('posts', 'POST', $data);

    }

    /**
     * Update existing post by ID
     *
     * @param int $postId
     * @param array $data
     * @return array|null
     */
    public function updatePost(int $postId, array $data): ?array
    {
        return $this->sendRequest("posts/{$postId}", 'PUT', $data);
    }

    /**
     * Delete post by ID
     *
     * @param int $postId
     * @return array|null
     */
    public function deletePost(int $postId): void
    {
        $this->sendRequest("posts/{$postId}", 'DELETE');
    }

    /**
     * Sending a request to the API and processing the response
     *
     * @param string $endpoint
     * @param string $method
     * @param array|null $data
     * @return array|null
     */
    private function sendRequest(string $endpoint, string $method = 'GET', ?array $data = null): ?array
    {
        try {
            $response = $this->httpClient->request($method, $endpoint, ['json' => $data]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            echo 'Ошибка при выполнении запроса: ' . $e->getMessage();
        }

        return null;
    }
}

