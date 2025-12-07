<?php

namespace App\Http\Controllers;

use App\Models\TripLogbook;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="TripLogbook",
 *     description="API Endpoints of TripLogbook"
 * )
 */
class TripLogbookController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/trip-logbook",
     *      operationId="getTripLogbookList",
     *      tags={"TripLogbook"},
     *      summary="Get list of TripLogbook",
     *      description="Returns list of TripLogbook",
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
        return TripLogbook::all();
    }

    /**
     * @OA\Post(
     *      path="/api/trip-logbook",
     *      operationId="storeTripLogbook",
     *      tags={"TripLogbook"},
     *      summary="Store new TripLogbook",
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
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
            'reason_stop' => 'nullable|string|max:255',
            'program_id' => 'nullable|exists:mst_program,id',
            'trip_id' => 'required|exists:tbl_trip,id',
            'driver_id' => 'nullable|exists:tbl_driver,id',
        ]);

        return TripLogbook::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/trip-logbook/{id}",
     *      operationId="getTripLogbookById",
     *      tags={"TripLogbook"},
     *      summary="Get information about TripLogbook",
     *      description="Returns TripLogbook data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripLogbook id",
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
        return TripLogbook::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/trip-logbook/{id}",
     *      operationId="updateTripLogbook",
     *      tags={"TripLogbook"},
     *      summary="Update existing TripLogbook",
     *      description="Returns updated TripLogbook data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripLogbook id",
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
        $model = TripLogbook::findOrFail($id);

        $validated = $request->validate([
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
            'reason_stop' => 'nullable|string|max:255',
            'program_id' => 'nullable|exists:mst_program,id',
            'trip_id' => 'required|exists:tbl_trip,id',
            'driver_id' => 'nullable|exists:tbl_driver,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/trip-logbook/{id}",
     *      operationId="deleteTripLogbook",
     *      tags={"TripLogbook"},
     *      summary="Delete existing TripLogbook",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="TripLogbook id",
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
        TripLogbook::destroy($id);
        return response()->json(null, 204);
    }
}
