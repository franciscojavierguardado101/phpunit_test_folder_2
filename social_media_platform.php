<?php

//testProfilePage() checks if the user profile page loads correctly.
//testUpdateProfile() tests updating user profile information.
//testCreatePost() verifies if users can create a new post successfully.
//testViewFeed() tests viewing the feed and ensures that the created post is displayed.

use PHPUnit\Framework\TestCase;

class ComplexWebsiteTest extends TestCase
{
    protected static $client;
    
    public static function setUpBeforeClass(): void
    {
        // Initialize a HTTP client or any necessary setup
        self::$client = new GuzzleHttp\Client([
            'base_uri' => 'http://example.com',
            'timeout'  => 2.0,
        ]);
    }
    
    public static function tearDownAfterClass(): void
    {
        // Clean up any resources if needed
    }
    
    public function testProfilePage()
    {
        // Test if the user profile page loads successfully
        $response = self::$client->get('/profile/1');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('User Profile', (string)$response->getBody());
    }
    
    public function testUpdateProfile()
    {
        // Test updating user profile information
        $response = self::$client->post('/profile/update', [
            'form_params' => [
                'name' => 'New Name',
                'bio' => 'This is a new bio.',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Profile updated successfully', (string)$response->getBody());
    }
    
    public function testCreatePost()
    {
        // Test creating a new post
        $response = self::$client->post('/post/create', [
            'form_params' => [
                'content' => 'This is a test post.',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Post created successfully', (string)$response->getBody());
    }
    
    public function testViewFeed()
    {
        // Test viewing the feed
        $response = self::$client->get('/feed');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Test Post', (string)$response->getBody());
    }
}
