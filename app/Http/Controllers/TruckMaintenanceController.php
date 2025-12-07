<?php

namespace App\Http\Controllers;

use App\Models\TruckMaintenance;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="TruckMaintenance",
 *     description="API Endpoints of TruckMaintenance"
 * )
 */
class TruckMaintenanceController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/truck-maintenance",
     *      operationId="getTruckMaintenanceList",
     *      tags={"TruckMaintenance"},
     *      summary="Get list of TruckMaintenance",
     *      description="Returns list of TruckMaintenance",
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
        return TruckMaintenance::all();
    }

    /**
     * @OA\Post(
     *      path="/api/truck-maintenance",
     *      operationId="storeTruckMaintenance",
     *      tags={"TruckMaintenance"},
     *      summary="Store new TruckMaintenance",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"truck_id"},
     *              @OA\Property(property="truck_id", type="integer", example=1),
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
            'subtotal' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'mst_truck_maintenance_id' => 'nullable|exists:mst_truck_maintenence,id',
            'truck_id' => 'required|exists:tbl_truck,id',
            'shop_id' => 'nullable|exists:tbl_shop,id',
        ]);

        return TruckMaintenance::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/truck-maintenance/{id}",
     *      operationId="getTruckMaintenanceById",
     *      tags={"TruckMaintenance"},
     *      summary="Get information about TruckMaintenance",
     *      description="Returns TruckMaintenance data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckMaintenance id",
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
        return TruckMaintenance::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/truck-maintenance/{id}",
     *      operationId="updateTruckMaintenance",
     *      tags={"TruckMaintenance"},
     *      summary="Update existing TruckMaintenance",
     *      description="Returns updated TruckMaintenance data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckMaintenance id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"truck_id"},
     *              @OA\Property(property="truck_id", type="integer", example=1),
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
        $model = TruckMaintenance::findOrFail($id);

        $validated = $request->validate([
            'subtotal' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'mst_truck_maintenance_id' => 'nullable|exists:mst_truck_maintenence,id',
            'truck_id' => 'required|exists:tbl_truck,id',
            'shop_id' => 'nullable|exists:tbl_shop,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/truck-maintenance/{id}",
     *      operationId="deleteTruckMaintenance",
     *      tags={"TruckMaintenance"},
     *      summary="Delete existing TruckMaintenance",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckMaintenance id",
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
        TruckMaintenance::destroy($id);
        return response()->json(null, 204);
    }
}
