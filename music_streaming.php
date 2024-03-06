<?php


//testLoginPage() checks if the login page loads correctly.
//testUserAuthentication() tests user authentication.
//testCreatePlaylist() verifies if playlists can be created successfully.
//testPlaySong() tests playing a song from a playlist.


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
    
    public function testUserAuthentication()
    {
        // Test user authentication
        $response = self::$client->post('/login', [
            'form_params' => [
                'username' => 'testuser',
                'password' => 'testpassword',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Welcome, testuser', (string)$response->getBody());
    }
    
    public function testCreatePlaylist()
    {
        // Test creating a new playlist
        $response = self::$client->post('/playlist/create', [
            'form_params' => [
                'name' => 'Test Playlist',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Playlist created successfully', (string)$response->getBody());
    }
    
    public function testPlaySong()
    {
        // Test playing a song from a playlist
        $response = self::$client->get('/playlist/1/play-song?song_id=1');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Now playing: Song Title', (string)$response->getBody());
    }
}
