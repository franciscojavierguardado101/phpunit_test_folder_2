<?php

//testTicketPage() checks if the ticket page loads correctly.
//testCreateTicket() tests creating a new ticket.
//testAssignTicket() verifies if tickets can be assigned to a user successfully.
//testResolveTicket() tests resolving a ticket.


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
    
    public function testTicketPage()
    {
        // Test if the ticket page loads successfully
        $response = self::$client->get('/tickets');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Ticket System', (string)$response->getBody());
    }
    
    public function testCreateTicket()
    {
        // Test creating a new ticket
        $response = self::$client->post('/tickets/create', [
            'form_params' => [
                'subject' => 'Test Ticket',
                'description' => 'This is a test ticket.',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Ticket created successfully', (string)$response->getBody());
    }
    
    public function testAssignTicket()
    {
        // Test assigning a ticket to a user
        $response = self::$client->post('/tickets/1/assign', [
            'form_params' => [
                'assignee_id' => 2,
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Ticket assigned successfully', (string)$response->getBody());
    }
    
    public function testResolveTicket()
    {
        // Test resolving a ticket
        $response = self::$client->post('/tickets/1/resolve');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Ticket resolved successfully', (string)$response->getBody());
    }
}
