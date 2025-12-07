<?php

namespace App\Http\Controllers;

use App\Models\TripDamage;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="TripDamage",
 *     description="API Endpoints of TripDamage"
 * )
 */
class TripDamageController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/trip-damage",
     *      operationId="getTripDamageList",
     *      tags={"TripDamage"},
     *      summary="Get list of TripDamage",
     *      description="Returns list of TripDamage",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        return TripDamage::all();
    }

    /**
     * @OA\Post(
     *      path="/api/trip-damage",
     *      operationId="storeTripDamage",
     *      tags={"TripDamage"},
     *      summary="Store new TripDamage",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"trip_id"},
     *              @OA\Property(property="trip_id", type="integer", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'program_id' => 'nullable|exists:mst_program,id',
            'trip_id' => 'required|exists:tbl_trip,id',
            'driver_id' => 'nullable|exists:tbl_driver,id',
        ]);

        return TripDamage::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/trip-damage/{id}",
     *      operationId="getTripDamageById",
     *      tags={"TripDamage"},
     *      summary="Get information about TripDamage",
     *      description="Returns TripDamage data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripDamage id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function show($id)
    {
        return TripDamage::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/trip-damage/{id}",
     *      operationId="updateTripDamage",
     *      tags={"TripDamage"},
     *      summary="Update existing TripDamage",
     *      description="Returns updated TripDamage data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripDamage id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"trip_id"},
     *              @OA\Property(property="trip_id", type="integer", example=1),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        $model = TripDamage::findOrFail($id);

        $validated = $request->validate([
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'program_id' => 'nullable|exists:mst_program,id',
            'trip_id' => 'required|exists:tbl_trip,id',
            'driver_id' => 'nullable|exists:tbl_driver,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/trip-damage/{id}",
     *      operationId="deleteTripDamage",
     *      tags={"TripDamage"},
     *      summary="Delete existing TripDamage",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripDamage id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy($id)
    {
        TripDamage::destroy($id);
        return response()->json(null, 204);
    }
}
