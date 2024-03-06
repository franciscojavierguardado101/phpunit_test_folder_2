<?php


//testFileManagerPage() checks if the file manager page loads correctly.
//testUploadFile() tests uploading a file to the file manager.
//testDeleteFile() verifies if users can delete a file from the file manager successfully.

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
    
    public function testFileManagerPage()
    {
        // Test if the file manager page loads successfully
        $response = self::$client->get('/file-manager');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('File Manager', (string)$response->getBody());
    }
    
    public function testUploadFile()
    {
        // Test uploading a file to the file manager
        $response = self::$client->post('/file-manager/upload', [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen('/path/to/test_file.txt', 'r'),
                ],
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('File uploaded successfully', (string)$response->getBody());
    }
    
    public function testDeleteFile()
    {
        // Test deleting a file from the file manager
        $response = self::$client->post('/file-manager/delete', [
            'form_params' => [
                'file_id' => 1,
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('File deleted successfully', (string)$response->getBody());
    }
}
