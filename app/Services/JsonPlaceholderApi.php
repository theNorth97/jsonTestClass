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
    public function getUsers(): array
    {
        return $this->sendRequest('users');
    }

    /**
     * Get posts of a specific user by ID
     *
     * @param int $userId
     * @return array|null
     * @throws CustomApiException
     */
    public function getUserPosts(int $userId): array
    {
       return $this->sendRequest("users/{$userId}/posts");
    }

    /**
     * Get todos of a specific user by ID
     *
     * @param int $userId
     * @return array|null
     * @throws CustomApiException
     */
    public function getUserTodos(int $userId): array
    {
        return $this->sendRequest("users/{$userId}/todos");
    }

    /**
     * Get user details by ID
     *
     * @param int $userId
     * @return array|null
     * @throws CustomApiException
     */
    public function getUserById(int $userId): array
    {
        return $this->sendRequest("users/{$userId}");
    }

    /**
     * Add a new post
     *
     * @param array $data
     * @return array
     * @throws CustomApiException
     */
    public function addPost(array $data): array
    {
        $response = $this->sendRequest('posts', 'POST', $data);

        return $response['data'];
    }

    /**
     * Update existing post by ID
     *
     * @param int $postId
     * @param array $data
     * @return array|null
     * @throws CustomApiException
     */
    public function updatePost(int $postId, array $data): array
    {
        $response = $this->sendRequest("posts/{$postId}", 'PUT', $data);

        return $response['data'];
    }

    /**
     * Delete post by ID
     *
     * @param int $postId
     * @return array|null
     * @throws CustomApiException
     */
    public function deletePost(int $postId): array
    {
        return $this->sendRequest("posts/{$postId}", 'DELETE');
    }

    /**
     * Sending a request to the API and processing the response
     *
     * @param string $endpoint
     * @param string $method
     * @param array|null $data
     * @return array
     * @throws CustomApiException
     */
    private function sendRequest(string $endpoint, string $method = 'GET', array $data = null): array
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

