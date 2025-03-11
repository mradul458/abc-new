<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use App\Models\ClassModel;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *      title="Studio Management API",
 *      version="1.0.0",
 *      description="API documentation for class and booking system"
 * )
 *
 * @OA\Tag(
 *     name="Classes",
 *     description="API Endpoints for managing studio classes"
 * )
 */
class ClassController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/classes",
     *     summary="Create a new class",
     *     tags={"Classes"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "start_date", "end_date", "capacity"},
     *             @OA\Property(property="name", type="string", example="Yoga"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2025-03-07"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2025-03-20"),
     *             @OA\Property(property="capacity", type="integer", example=20)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Class created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Class created successfully"),
     *             @OA\Property(property="class", type="object")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreClassRequest $request): JsonResponse
    {   

        $data = $request->validated();
        
        $class = ClassModel::create($data);

        return response()->json([
            'message' => 'Class created successfully',
            'class' => $class
        ], 201);
    }
}
