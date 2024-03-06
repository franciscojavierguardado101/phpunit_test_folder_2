<?php

//testProjectPage() checks if the project page loads correctly.
//testCreateProject() tests creating a new project.
//testAssignTask() verifies if tasks can be assigned to users in the project successfully.
//testTrackProgress() tests tracking progress of a task in the project.

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
    
    public function testProjectPage()
    {
        // Test if the project page loads successfully
        $response = self::$client->get('/projects');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Projects', (string)$response->getBody());
    }
    
    public function testCreateProject()
    {
        // Test creating a new project
        $response = self::$client->post('/projects/create', [
            'form_params' => [
                'name' => 'New Project',
                'description' => 'This is a new project.',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Project created successfully', (string)$response->getBody());
    }
    
    public function testAssignTask()
    {
        // Test assigning a task to a user in the project
        $response = self::$client->post('/projects/1/assign-task', [
            'form_params' => [
                'task_id' => 1,
                'assignee_id' => 2,
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Task assigned successfully', (string)$response->getBody());
    }
    
    public function testTrackProgress()
    {
        // Test tracking progress of a task in the project
        $response = self::$client->post('/projects/1/track-progress', [
            'form_params' => [
                'task_id' => 1,
                'progress' => 50,
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Progress tracked successfully', (string)$response->getBody());
    }
}
