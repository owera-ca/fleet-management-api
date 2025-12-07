<?php

namespace App\Http\Controllers;

use App\Models\TripPickupDrop;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="TripPickupDrop",
 *     description="API Endpoints of TripPickupDrop"
 * )
 */
class TripPickupDropController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/trip-pickup-drop",
     *      operationId="getTripPickupDropList",
     *      tags={"TripPickupDrop"},
     *      summary="Get list of TripPickupDrop",
     *      description="Returns list of TripPickupDrop",
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
        return TripPickupDrop::all();
    }

    /**
     * @OA\Post(
     *      path="/api/trip-pickup-drop",
     *      operationId="storeTripPickupDrop",
     *      tags={"TripPickupDrop"},
     *      summary="Store new TripPickupDrop",
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
            'type' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'program_id' => 'nullable|exists:mst_program,id',
            'trip_id' => 'required|exists:tbl_trip,id',
            'cargo_id' => 'nullable|exists:tbl_cargo,id',
            'ship_address_id' => 'nullable|exists:tbl_ship_address,id',
            'representative_address_id' => 'nullable|exists:tbl_address,id',
        ]);

        return TripPickupDrop::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/trip-pickup-drop/{id}",
     *      operationId="getTripPickupDropById",
     *      tags={"TripPickupDrop"},
     *      summary="Get information about TripPickupDrop",
     *      description="Returns TripPickupDrop data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripPickupDrop id",
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
        return TripPickupDrop::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/trip-pickup-drop/{id}",
     *      operationId="updateTripPickupDrop",
     *      tags={"TripPickupDrop"},
     *      summary="Update existing TripPickupDrop",
     *      description="Returns updated TripPickupDrop data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripPickupDrop id",
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
        $model = TripPickupDrop::findOrFail($id);

        $validated = $request->validate([
            'type' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'program_id' => 'nullable|exists:mst_program,id',
            'trip_id' => 'required|exists:tbl_trip,id',
            'cargo_id' => 'nullable|exists:tbl_cargo,id',
            'ship_address_id' => 'nullable|exists:tbl_ship_address,id',
            'representative_address_id' => 'nullable|exists:tbl_address,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/trip-pickup-drop/{id}",
     *      operationId="deleteTripPickupDrop",
     *      tags={"TripPickupDrop"},
     *      summary="Delete existing TripPickupDrop",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripPickupDrop id",
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
        TripPickupDrop::destroy($id);
        return response()->json(null, 204);
    }
}
