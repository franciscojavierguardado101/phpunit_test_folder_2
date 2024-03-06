<?php


//testCalendarPage() checks if the calendar page loads correctly.
//testCreateEvent() tests creating a new event in the calendar.
//testRetrieveEvents() verifies if events are retrieved correctly from the calendar.


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
    
    public function testCalendarPage()
    {
        // Test if the calendar page loads successfully
        $response = self::$client->get('/calendar');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Calendar', (string)$response->getBody());
    }
    
    public function testCreateEvent()
    {
        // Test creating a new event in the calendar
        $response = self::$client->post('/calendar/create-event', [
            'form_params' => [
                'title' => 'Test Event',
                'date' => '2024-03-10',
                'description' => 'This is a test event.',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Event created successfully', (string)$response->getBody());
    }
    
    public function testRetrieveEvents()
    {
        // Test retrieving events from the calendar
        $response = self::$client->get('/calendar/events');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Test Event', (string)$response->getBody());
    }
}
