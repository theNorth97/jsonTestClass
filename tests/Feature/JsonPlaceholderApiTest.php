<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\JsonPlaceholderApi;

class JsonPlaceholderApiTest extends TestCase
{
    private JsonPlaceholderApi $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new JsonPlaceholderApi();
    }

    public function testAddPost(): void
    {

        $newPostData = [
            'userId' => 1,
            'title' => 'New Post Title',
            'body' => 'New post content',
        ];

        $newPost = $this->api->addPost($newPostData);

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

        $newPostData = [
            'userId' => 1,
            'title' => 'New Post Title',
            'body' => 'New post content',
        ];

        $newPost = $this->api->addPost($newPostData);

        $this->assertIsArray($newPost);
        $this->assertArrayHasKey('id', $newPost);

        $postId = $newPost['userId'];

        $updatedPostData = [
            'userId' => 1,
            'title' => 'Updated Post Title',
            'body' => 'Updated post content',
            'id' => 1
        ];

        $updatedPost = $this->api->updatePost($postId, $updatedPostData);

        $this->assertIsArray($updatedPost);
        $this->assertArrayHasKey('id', $updatedPost);
        $this->assertEquals($postId, $updatedPost['id']);
        $this->assertEquals($updatedPostData['title'], $updatedPost['title']);
        $this->assertEquals($updatedPostData['body'], $updatedPost['body']);
    }

    public function testDeletePost(): void
    {

        $postId = 1;
        $this->api->deletePost($postId);

        $this->expectNotToPerformAssertions();
    }

}

