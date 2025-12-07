<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Trip",
 *     description="API Endpoints of Trip"
 * )
 */
class TripController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/trip",
     *      operationId="getTripList",
     *      tags={"Trip"},
     *      summary="Get list of Trip",
     *      description="Returns list of Trip",
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
        return Trip::all();
    }

    /**
     * @OA\Post(
     *      path="/api/trip",
     *      operationId="storeTrip",
     *      tags={"Trip"},
     *      summary="Store new Trip",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"driver_id"},
     *              @OA\Property(property="driver_id", type="integer", example=1),
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
            'program_id' => 'nullable|exists:mst_program,id',
            'driver_id' => 'required|exists:tbl_driver,id',
        ]);

        return Trip::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/trip/{id}",
     *      operationId="getTripById",
     *      tags={"Trip"},
     *      summary="Get information about Trip",
     *      description="Returns Trip data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Trip id",
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
        return Trip::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/trip/{id}",
     *      operationId="updateTrip",
     *      tags={"Trip"},
     *      summary="Update existing Trip",
     *      description="Returns updated Trip data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Trip id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"driver_id"},
     *              @OA\Property(property="driver_id", type="integer", example=1),
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
        $model = Trip::findOrFail($id);

        $validated = $request->validate([
            'program_id' => 'nullable|exists:mst_program,id',
            'driver_id' => 'required|exists:tbl_driver,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/trip/{id}",
     *      operationId="deleteTrip",
     *      tags={"Trip"},
     *      summary="Delete existing Trip",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Trip id",
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
        Trip::destroy($id);
        return response()->json(null, 204);
    }
}
