<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\ProductEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{


    public function isAuthorized()
    {
        return $user = User::first();
        if (!$user) {
            return  $user = User::factory()->create();
        }
        // $response = $this->actingAs($user);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $user = $this->isAuthorized();
        $response = $this->actingAs($user);
        $response = $this->get('product');
        $response->assertStatus(200);
    }





    public function test_product_insert()
    {
        $user = $this->isAuthorized();
        $response = $this->actingAs($user)

            ->json('POST', '/product/create', [
                'name' => 'product1',
                'category_id' => 1,
                'price' => 23,
                'image' => 'test.jpg',
            ]);


        // notification testing doubt
        // $message = "message";
        // $notification = new ProductEmailNotification($response);
        // $rendered = $notification->toMail($user)->render();
        // $this->assertStringContainsString("message: {$message}", $rendered);

        $response->assertStatus(302);
    }

    public function test_product_edit()
    {
        $user = $this->isAuthorized();
        $response = $this->actingAs($user)

            ->json('GET', 'product/edit/2', [
                'name' => 'product1',
                'category_id' => 1,
                'price' => 23,
                'image' => 'test.jpg',
            ]);

        $response->assertStatus(200);
    }



    public function test_product_multiple_delete()
    {
        $user = $this->isAuthorized();
        $response = $this->actingAs($user)

            ->json('POST', 'product/delete', [
                'id' => [0 => 1],
            ]);
        $response->assertStatus(200);
    }
}
