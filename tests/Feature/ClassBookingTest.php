<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ClassModel;

class ClassBookingTest extends TestCase
{
    use RefreshDatabase; // Resets the database after each test

    /** @test */
    public function it_should_create_a_class_successfully()
    {
        $response = $this->postJson('/api/classes', [
            'name' => 'Yoga Class',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
            'capacity' => 20,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Class created successfully',
                     'class' => [
                         'name' => 'Yoga Class',
                         'capacity' => 20,
                     ],
                 ]);
    }

    /** @test */
    public function it_should_return_validation_error_when_creating_a_class_with_missing_fields()
    {
        $response = $this->postJson('/api/classes', []); // Sending empty data

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'start_date', 'end_date', 'capacity']);
    }

    /** @test */
    public function it_should_book_a_class_successfully()
    {
        // Create a class first
        $class = ClassModel::create([
            'name' => 'Pilates Class',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
            'capacity' => 15,
        ]);

        // Book a class
        $response = $this->postJson('/api/bookings', [
            'member_name' => 'John Doe',
            'date' => now()->toDateString(),
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Booking successful',
                     'booking' => [
                         'member_name' => 'John Doe',
                         'date' => now()->toDateString(),
                     ],
                 ]);
    }

    /** @test */
    public function it_should_return_validation_error_when_booking_a_class_with_missing_fields()
    {
        $response = $this->postJson('/api/bookings', []); // Sending empty data

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['member_name', 'date']);
    }
}
