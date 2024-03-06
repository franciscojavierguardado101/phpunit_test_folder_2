<?php


//testReservationPage() checks if the reservation page loads correctly.
//testCheckRoomAvailability() tests checking room availability for a specific date range.
//testCreateReservation() verifies if reservations can be created successfully for available rooms.
//testCancelReservation() tests canceling a reservation.


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
    
    public function testReservationPage()
    {
        // Test if the reservation page loads successfully
        $response = self::$client->get('/reservations');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Reservation System', (string)$response->getBody());
    }
    
    public function testCheckRoomAvailability()
    {
        // Test checking room availability for a specific date range
        $response = self::$client->get('/reservations/availability?start_date=2024-03-15&end_date=2024-03-20');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Available Rooms', (string)$response->getBody());
    }
    
    public function testCreateReservation()
    {
        // Test creating a reservation for a room
        $response = self::$client->post('/reservations/create', [
            'form_params' => [
                'room_id' => 1,
                'start_date' => '2024-03-15',
                'end_date' => '2024-03-20',
                'guest_name' => 'John Doe',
                'guest_email' => 'john@example.com',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Reservation created successfully', (string)$response->getBody());
    }
    
    public function testCancelReservation()
    {
        // Test canceling a reservation
        $response = self::$client->post('/reservations/cancel', [
            'form_params' => [
                'reservation_id' => 1,
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Reservation canceled successfully', (string)$response->getBody());
    }
}
