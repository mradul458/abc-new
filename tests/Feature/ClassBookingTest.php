<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ClassModel;
use App\Models\Booking;
use Carbon\Carbon;

class ClassBookingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate'); 
    }

    /** @test */
    public function it_should_create_a_class_successfully()
    {
        $response = $this->postJson('/api/classes', [
            'name' => 'Yoga New Class',
            'start_date' => Carbon::tomorrow()->toDateString(),
            'end_date' => Carbon::tomorrow()->addDays(5)->toDateString(),
            'capacity' => 20,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Class created successfully',
                     'class' => [
                         'name' => 'Yoga New Class',
                         'capacity' => 20,
                     ],
                 ]);

        $this->assertDatabaseHas('classes', ['name' => 'Yoga New Class']);
    }

    /** @test */
    public function it_should_return_validation_error_when_creating_a_class_with_missing_fields()
    {
        $response = $this->postJson('/api/classes', []); // Sending empty data

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'start_date', 'end_date', 'capacity']);
    }

    /** @test */
    public function it_should_not_allow_duplicate_classes_on_same_date()
    {
        ClassModel::create([
            'name' => 'Pilates Class',
            'start_date' => Carbon::tomorrow()->toDateString(),
            'end_date' => Carbon::tomorrow()->addDays(5)->toDateString(),
            'capacity' => 15,
        ]);

        $response = $this->postJson('/api/classes', [
            'name' => 'Pilates Class',
            'start_date' => Carbon::tomorrow()->toDateString(),
            'end_date' => Carbon::tomorrow()->addDays(5)->toDateString(),
            'capacity' => 15,
        ]);

        $response->assertStatus(422)
         ->assertJson([
             'message' => 'A class with the same name and date range already exists.',
             'errors' => [
                 'name' => ['This class has already been scheduled for the selected dates.']
             ]
         ]);

    }

    /** @test */
    public function it_should_book_a_class_successfully()
    {
        // Create a class first
        $class = ClassModel::create([
            'name' => 'Pilates Class',
            'start_date' => Carbon::tomorrow()->toDateString(),
            'end_date' => Carbon::tomorrow()->addDays(5)->toDateString(),
            'capacity' => 15,
        ]);

        // Book a class
        $response = $this->postJson('/api/bookings', [
            'member_name' => 'John Doe',
            'date' => Carbon::tomorrow()->toDateString(),
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Booking successful',
                     'booking' => [
                         'member_name' => 'John Doe',
                         'date' => Carbon::tomorrow()->toDateString(),
                     ],
                 ]);

        $this->assertDatabaseHas('bookings', ['member_name' => 'John Doe']);
    }

    /** @test */
    public function it_should_return_validation_error_when_booking_a_class_with_missing_fields()
    {
        $response = $this->postJson('/api/bookings', []); // Sending empty data

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['member_name', 'date']);
    }

}
