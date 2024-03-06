<?php

//testHomePage() checks if the home page loads correctly.
//testBrowseProducts() tests browsing products in the product catalog.
//testAddToCart() verifies if products can be added to the cart successfully.
//testCheckoutProcess() tests the checkout process by submitting order information.

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
    
    public function testHomePage()
    {
        // Test if the home page loads successfully
        $response = self::$client->get('/');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Welcome to Our E-commerce Platform', (string)$response->getBody());
    }
    
    public function testBrowseProducts()
    {
        // Test browsing products
        $response = self::$client->get('/products');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Product Catalog', (string)$response->getBody());
    }
    
    public function testAddToCart()
    {
        // Test adding a product to the cart
        $response = self::$client->post('/cart/add', [
            'form_params' => [
                'product_id' => 1,
                'quantity' => 2,
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Product added to cart successfully', (string)$response->getBody());
    }
    
    public function testCheckoutProcess()
    {
        // Test the checkout process
        $response = self::$client->post('/checkout/process', [
            'form_params' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'address' => '123 Main St',
                'payment_method' => 'credit_card',
                // Additional form fields as needed
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Order placed successfully', (string)$response->getBody());
    }
}
