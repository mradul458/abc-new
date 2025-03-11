<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\ClassModel;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Bookings",
 *     description="API Endpoints for booking classes"
 * )
 */

class BookingController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     summary="Book a class",
     *     tags={"Bookings"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"member_name", "date"},
     *             @OA\Property(property="member_name", type="string", example="John Doe"),
     *             @OA\Property(property="date", type="string", format="date", example="2025-03-07")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Booking successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Booking successful"),
     *             @OA\Property(property="booking", type="object")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {

        $data = $request->validated();
        
        $class = ClassModel::where('start_date', '<=', $data['date'])
            ->where('end_date', '>=', $data['date'])
            ->first();

        if (!$class) {
            return response()->json(['error' => 'No class available on this date'], 404);
        }

        $booking = Booking::create([
            'class_id' => $class->id,
            'member_name' => $data['member_name'],
            'date' => $data['date']
        ]);

        return response()->json([
            'message' => 'Booking successful',
            'booking' => $booking
        ], 201);
    }
}

