<?php


//testLoginPage() checks if the login page loads correctly.
//testSuccessfulLogin() tests the login process by submitting credentials and checking for a successful response.
//testSendMessage() verifies if users can send messages in the chat successfully.
//testRetrieveMessages() tests retrieving messages from the chat and ensures that the sent message is displayed.

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
    
    public function testLoginPage()
    {
        // Test if the login page loads successfully
        $response = self::$client->get('/login');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Login', (string)$response->getBody());
    }
    
    public function testSuccessfulLogin()
    {
        // Test successful login process
        $response = self::$client->post('/login', [
            'form_params' => [
                'username' => 'test_user',
                'password' => 'test_password',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Welcome, test_user', (string)$response->getBody());
    }
    
    public function testSendMessage()
    {
        // Test sending a message in the chat
        $response = self::$client->post('/chat/send', [
            'form_params' => [
                'message' => 'Hello, world!',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Message sent successfully', (string)$response->getBody());
    }
    
    public function testRetrieveMessages()
    {
        // Test retrieving messages from the chat
        $response = self::$client->get('/chat/messages');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Hello, world!', (string)$response->getBody());
    }
}
