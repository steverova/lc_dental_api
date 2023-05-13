<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

require_once './Test.php';
class testAppointmentTest extends TestCase
{

    // /** @test **/
    // public function testHistoryAppointmet()
    // {

    //     $data = array(
    //         "id" => 2,
    //         "date_appointment" => ""
    //     );
    //     $form = json_encode($data);
    //     $client = new Client();
    //     $response = $client->post('http://localhost/api/appointment/history', [
    //         'headers' => [
    //             'Content-Type' => 'application/json',
    //         ],
    //         'body' => $form
    //     ]);
    //     $body = $response->getBody();
    //     print_r(json_decode((string) $body));
    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertNotEmpty($response);
    // }
    // /** @test **/

    // public function testFindDataAppointmet()
    // {

    //     $data = array(
    //         "id" => 2,
    //         "date_appointment" => "",
    //         "flag" => 0
    //     );
    //     $form = json_encode($data);
    //     $client = new Client();
    //     $response = $client->post('http://localhost/api/appointment/listData', [
    //         'headers' => [
    //             'Content-Type' => 'application/json',
    //         ],
    //         'body' => $form
    //     ]);
    //     $body = $response->getBody();
    //     print_r(json_decode((string) $body));
    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertNotEmpty($response);
    // }

        // /** @test **/
        // /** @test **/
    // public function testCreateAppointmet()
    // {

    //     $data = array(
    //         "id_patient" => 2,
    //         "date_appointment" => "2023-02-08 21:56:00",
    //         "reason" => "Hola desde phpUnit"
    //     );
    //     $form = json_encode($data);
    //     $client = new Client();
    //     $response = $client->post('http://localhost/api/appointment/create', [
    //         'headers' => [
    //             'Content-Type' => 'application/json',
    //         ],
    //         'body' => $form
    //     ]);
    //     $body = $response->getBody();
    //     print_r(json_decode((string) $body));
    //     $this->assertNotEmpty($response);
    //     $this->assertEquals(200, $response->getStatusCode());

    // }

            // // /** @test **/
            // public function testUpdateAppointmet()
            // {
        
            //     $data = array(
            //         "id" => 84,
            //         "date_appointment" => "2023-02-08 21:56:00",
            //         "reason" => "Hola desde phpUnit pero update jeje"
            //     );
            //     $form = json_encode($data);
            //     $client = new Client();
            //     $response = $client->put('http://localhost/api/appointment/create', [
            //         'headers' => [
            //             'Content-Type' => 'application/json',
            //         ],
            //         'body' => $form
            //     ]);
            //     $body = $response->getBody();
            //     print_r(json_decode((string) $body));
            //     $this->assertNotEmpty($response);
            //     $this->assertEquals(200, $response->getStatusCode());
        
            // }

    // /** @test **/
    // public function testAppointmentDelete()
    // {
    //     $client = new Client();
    //     $response = $client->delete('http://localhost/api/appointment/delete/84');
    //     $body = $response->getBody();
    //     $bodyResponse = json_decode((string) $body);
    //     print_r($bodyResponse);
    //     $this->assertEquals(200, $response->getStatusCode());
    // }

    public function testAppointmentFindById()
    {
         $client = new Client();
        $response = $client->get('http://localhost/api/patient/findById/2');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertNotEmpty($data, "el json viene vacio");
        $this->assertEmpty($data, "el json viene lleno");
    }

}