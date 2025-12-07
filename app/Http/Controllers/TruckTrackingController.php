<?php

namespace App\Http\Controllers;

use App\Models\TruckTracking;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="TruckTracking",
 *     description="API Endpoints of TruckTracking"
 * )
 */
class TruckTrackingController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/truck-tracking",
     *      operationId="getTruckTrackingList",
     *      tags={"TruckTracking"},
     *      summary="Get list of TruckTracking",
     *      description="Returns list of TruckTracking",
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
        return TruckTracking::all();
    }

    /**
     * @OA\Post(
     *      path="/api/truck-tracking",
     *      operationId="storeTruckTracking",
     *      tags={"TruckTracking"},
     *      summary="Store new TruckTracking",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"truck_id","lat","lng"},
     *              @OA\Property(property="truck_id", type="integer", example=1),
     *              @OA\Property(property="lat", type="number", example=40.7128),
     *              @OA\Property(property="lng", type="number", example=-74.0060),
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
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'truck_id' => 'required|exists:tbl_truck,id',
        ]);

        return TruckTracking::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/truck-tracking/{id}",
     *      operationId="getTruckTrackingById",
     *      tags={"TruckTracking"},
     *      summary="Get information about TruckTracking",
     *      description="Returns TruckTracking data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckTracking id",
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
        return TruckTracking::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/truck-tracking/{id}",
     *      operationId="updateTruckTracking",
     *      tags={"TruckTracking"},
     *      summary="Update existing TruckTracking",
     *      description="Returns updated TruckTracking data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckTracking id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"truck_id","lat","lng"},
     *              @OA\Property(property="truck_id", type="integer", example=1),
     *              @OA\Property(property="lat", type="number", example=40.7128),
     *              @OA\Property(property="lng", type="number", example=-74.0060),
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
        $model = TruckTracking::findOrFail($id);

        $validated = $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'truck_id' => 'required|exists:tbl_truck,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/truck-tracking/{id}",
     *      operationId="deleteTruckTracking",
     *      tags={"TruckTracking"},
     *      summary="Delete existing TruckTracking",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckTracking id",
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
        TruckTracking::destroy($id);
        return response()->json(null, 204);
    }
}
