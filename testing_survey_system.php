<?php


//testSurveyPage() checks if the survey page loads correctly.
//testSubmitSurveyResponse() tests submitting a survey response.
//testSurveyResult() verifies if survey results are displayed correctly.


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
    
    public function testSurveyPage()
    {
        // Test if the survey page loads successfully
        $response = self::$client->get('/survey');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Survey', (string)$response->getBody());
    }
    
    public function testSubmitSurveyResponse()
    {
        // Test submitting a survey response
        $response = self::$client->post('/survey/submit', [
            'form_params' => [
                'question1' => 'Answer 1',
                'question2' => 'Answer 2',
                'question3' => 'Answer 3',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Survey response submitted successfully', (string)$response->getBody());
    }
    
    public function testSurveyResult()
    {
        // Test retrieving survey results
        $response = self::$client->get('/survey/result');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Survey Result', (string)$response->getBody());
        $this->assertStringContainsString('Question 1: Answer 1', (string)$response->getBody());
        $this->assertStringContainsString('Question 2: Answer 2', (string)$response->getBody());
        $this->assertStringContainsString('Question 3: Answer 3', (string)$response->getBody());
    }
}
