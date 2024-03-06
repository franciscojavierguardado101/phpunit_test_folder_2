<?php

//testCourseCatalogPage() checks if the course catalog page loads correctly.
//testEnrollCourse() tests enrolling in a course.
//testCompleteLesson() verifies if lessons in a course can be completed successfully.
//testTrackProgress() tests tracking progress of a course.


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
    
    public function testCourseCatalogPage()
    {
        // Test if the course catalog page loads successfully
        $response = self::$client->get('/courses');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Course Catalog', (string)$response->getBody());
    }
    
    public function testEnrollCourse()
    {
        // Test enrolling in a course
        $response = self::$client->post('/courses/enroll', [
            'form_params' => [
                'course_id' => 1,
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Enrolled in course successfully', (string)$response->getBody());
    }
    
    public function testCompleteLesson()
    {
        // Test completing a lesson in a course
        $response = self::$client->post('/courses/1/complete-lesson', [
            'form_params' => [
                'lesson_id' => 1,
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Lesson completed successfully', (string)$response->getBody());
    }
    
    public function testTrackProgress()
    {
        // Test tracking progress of a course
        $response = self::$client->get('/courses/1/progress');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Course Progress', (string)$response->getBody());
    }
}
