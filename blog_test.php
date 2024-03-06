<?php

//testBlogPage() checks if the blog page loads correctly and displays the latest blog posts.
//testViewBlogPost() tests viewing a specific blog post by accessing its URL.
//testSubmitComment() verifies if users can submit comments on a blog post successfully.
//testSearch() tests the search functionality by searching for a term and checking the search results page.

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
    
    public function testBlogPage()
    {
        // Test if the blog page loads successfully
        $response = self::$client->get('/blog');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Latest Blog Posts', (string)$response->getBody());
    }
    
    public function testViewBlogPost()
    {
        // Test viewing a specific blog post
        $response = self::$client->get('/blog/post/1');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Blog Post Title', (string)$response->getBody());
    }
    
    public function testSubmitComment()
    {
        // Test submitting a comment on a blog post
        $response = self::$client->post('/blog/post/1/comment', [
            'form_params' => [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'comment' => 'This is a test comment.',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Comment submitted successfully', (string)$response->getBody());
    }
    
    public function testSearch()
    {
        // Test the search functionality
        $response = self::$client->get('/search?q=test');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Search Results', (string)$response->getBody());
    }
}
