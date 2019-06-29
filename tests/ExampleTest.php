<?php

use App\Ip;
use Carbon\Carbon;
use Laravel\Lumen\Testing\DatabaseMigrations;

class IpsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testStore()
    {
        $response = $this->get('/ip/register');
        $this->assertEquals(201, $response->response->getStatusCode());
        $this->assertEquals('127.0.0.1', json_decode($response->response->getContent())->address);
    }

    /**
     * @return void
     */
    public function testGetLatest()
    {
        Ip::unguard();
        Ip::create(['address' => '12.11.22.21', 'created_at' => Carbon::yesterday()]);
        $ipEntry = Ip::create(['address' => '12.21.12.21']);

        $response = $this->get('/ip/latest');
        $address = json_decode($response->response->getContent(), true);
        $this->assertEquals($ipEntry->address, $address['address']);
    }
}
