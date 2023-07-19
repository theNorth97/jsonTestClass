<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;
use App\Services\JsonPlaceholderApi;

class JsonPlaceholderApiTest extends TestCase
{

    public function testAddPost(): void
    {
        $api = new JsonPlaceholderApi();

        $newPostData = [
            'userId' => 1,
            'title' => 'New Post Title',
            'body' => 'New post content',
        ];

        $newPost = $api->addPost($newPostData);

        $this->assertIsArray($newPost);
        $this->assertArrayHasKey('userId', $newPost);
        $this->assertArrayHasKey('title', $newPost);
        $this->assertArrayHasKey('body', $newPost);
        $this->assertArrayHasKey('id', $newPost);
        $this->assertEquals(1, $newPost['userId']);
        $this->assertEquals('New Post Title', $newPost['title']);
        $this->assertEquals('New post content', $newPost['body']);

    }

    public function testUpdatePost(): void
    {
        $api = new JsonPlaceholderApi();

        $newPostData = [
            'userId' => 1,
            'title' => 'New Post Title',
            'body' => 'New post content',
        ];

        $newPost = $api->addPost($newPostData);

        $this->assertIsArray($newPost);
        $this->assertArrayHasKey('id', $newPost);

        $postId = $newPost['userId'];

        $updatedPostData = [
            'userId' => 1,
            'title' => 'Updated Post Title',
            'body' => 'Updated post content',
            'id' => 1
        ];

        $updatedPost = $api->updatePost($postId, $updatedPostData);

        $this->assertIsArray($updatedPost);
        $this->assertArrayHasKey('id', $updatedPost);
        $this->assertEquals($postId, $updatedPost['id']);
        $this->assertEquals($updatedPostData['title'], $updatedPost['title']);
        $this->assertEquals($updatedPostData['body'], $updatedPost['body']);
    }

    public function testDeletePost(): void
    {
        $api = new JsonPlaceholderApi();

        $postId = 1;
        $api->deletePost($postId);

        $this->expectNotToPerformAssertions();
    }

}

