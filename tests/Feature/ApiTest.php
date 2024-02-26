<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Subscriber;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use GuzzleHttp\Psr7\Response;
// use Illuminate\Http\Response as HttpResponse;
// use Illuminate\Testing\TestResponse;

class ApiTest extends TestCase
{
    /** 
     * Helper functions
     */

    private function create_gonzo() {
        return [
            'name'              => 'Gonzo Muppet',
            'email'             => 'gonzo_muppet@meatintheseat.com',
            'gender'            => 'rather not say',
            'mailing_list_id'   => '4'
        ];
    }
    
    private function add_gonzo(array $subscriberDetails){
        $response = $this->withHeaders([
            'Cache-Control'         => 'no-cache',
            'Content-Type'          => 'application/x-www-form-urlencoded',
            'X-Requested-With'      => 'XMLHttpRequest'
        ])->post('/api/post/subscriber', $subscriberDetails);

        return $response;
    }

    private function del_gonzo(int $id){
        $subscriber =  Subscriber::find($id);
        $subscriber->delete();
    }

    /**
     * A Test the one mailinglist api function
     */
    public function test_get_mailing_list(): void
    {
        $response = $this->get('/api/get/mailinglist');
        $response->assertOk();
    }

    public function test_get_mailing_list_with_param(): void
    {
        $response = $this->get('/api/get/mailinglist/xyz');
        $response->assertNotFound();
    }

    /**
     * A Test the one subscriber api function
     */
    public function test_get_subscriber(): void
    {
        $response = $this->get('/api/get/subscriber');
        $response->assertNotFound();
    }

    public function test_get_subscriber_with_param(): void
    {
        $response = $this->get('/api/get/subscriber/xyz');
        $response->assertNotFound();
    }

    public function test_post_subscriber_gonzo(): void
    {
        $response = $this->add_gonzo($this->create_gonzo());

        // Now get the id for this newly created user so we can 
        // again remote it.
        if( $response->baseResponse->status() == 201 ) {
            $id = json_decode($response->baseResponse->content())->id;
            $this->del_gonzo($id);
        }
        $response->assertStatus(201);
    }

    public function test_post_two_subscribers_gonzo(): void
    {   
        // Add the first gonzo.
        $responseOne = $this->add_gonzo($this->create_gonzo());
        if($responseOne->baseResponse->status() != 201 ){
            // bail out
            $this->assertFalse(false);
        }
        // Now try to add the second gonzo
        $responseTwo = $this->add_gonzo($this->create_gonzo());

        // We still need to clean up the first gonzo.
        $id = json_decode($responseOne->baseResponse->content())->id;
        $this->del_gonzo($id);

            // Second gonzo shoul return an 500 Error
        $responseTwo->assertInternalServerError();
    }

    public function test_post_subscriber_no_name() : void
    {
        $subscriberDetails = $this->create_gonzo();
        $subscriberDetails['name'] = null;
        
        $response = $this->add_gonzo($subscriberDetails);

        // Laravel will redirect, so it returns a 302 "Found"  Hmmm :-(
        $response->assertFound();
    }

    public function test_post_subscriber_no_email() : void
    {
        $subscriberDetails = $this->create_gonzo();
        $subscriberDetails['email'] = null;
        
        $response = $this->add_gonzo($subscriberDetails);

        // Laravel will redirect, so it returns a 302 "Found"  Hmmm :-(
        $response->assertFound();
    }

    public function test_post_subscriber_no_valid_email() : void
    {
        $subscriberDetails = $this->create_gonzo();
        $subscriberDetails['email'] = 'gonzo@muppets.show';
        
        $response = $this->add_gonzo($subscriberDetails);

        // Laravel will redirect, so it returns a 302 "Found"  Hmmm :-(
        $response->assertFound();
    }

    public function test_post_subscriber_no_gender() : void
    {
        $subscriberDetails = $this->create_gonzo();
        $subscriberDetails['gender'] = null;
        
        $response = $this->add_gonzo($subscriberDetails);

        // Laravel will redirect, so it returns a 302 "Found"  Hmmm :-(
        $response->assertFound();
    }

    public function test_post_subscriber_no_mailing_list_id() : void
    {
        $subscriberDetails = $this->create_gonzo();
        $subscriberDetails['mailing_list_id'] = null;
        
        $response = $this->add_gonzo($subscriberDetails);

        // Laravel will redirect, so it returns a 302 "Found"  Hmmm :-(
        $response->assertFound();
    }
}
