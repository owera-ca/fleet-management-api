<?php

namespace App\Http\Controllers;

use App\Models\TruckMaintenanceItem;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="TruckMaintenanceItem",
 *     description="API Endpoints of TruckMaintenanceItem"
 * )
 */
class TruckMaintenanceItemController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/truck-maintenance-item",
     *      operationId="getTruckMaintenanceItemList",
     *      tags={"TruckMaintenanceItem"},
     *      summary="Get list of TruckMaintenanceItem",
     *      description="Returns list of TruckMaintenanceItem",
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
        return TruckMaintenanceItem::all();
    }

    /**
     * @OA\Post(
     *      path="/api/truck-maintenance-item",
     *      operationId="storeTruckMaintenanceItem",
     *      tags={"TruckMaintenanceItem"},
     *      summary="Store new TruckMaintenanceItem",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"truck_maintenance_id"},
     *              @OA\Property(property="truck_maintenance_id", type="integer", example=1),
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
            'price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'composite_price' => 'nullable|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'truck_maintenance_id' => 'required|exists:tbl_truck_maintenance,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        return TruckMaintenanceItem::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/truck-maintenance-item/{id}",
     *      operationId="getTruckMaintenanceItemById",
     *      tags={"TruckMaintenanceItem"},
     *      summary="Get information about TruckMaintenanceItem",
     *      description="Returns TruckMaintenanceItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckMaintenanceItem id",
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
        return TruckMaintenanceItem::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/truck-maintenance-item/{id}",
     *      operationId="updateTruckMaintenanceItem",
     *      tags={"TruckMaintenanceItem"},
     *      summary="Update existing TruckMaintenanceItem",
     *      description="Returns updated TruckMaintenanceItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckMaintenanceItem id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"truck_maintenance_id"},
     *              @OA\Property(property="truck_maintenance_id", type="integer", example=1),
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
        $model = TruckMaintenanceItem::findOrFail($id);

        $validated = $request->validate([
            'price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'composite_price' => 'nullable|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'truck_maintenance_id' => 'required|exists:tbl_truck_maintenance,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/truck-maintenance-item/{id}",
     *      operationId="deleteTruckMaintenanceItem",
     *      tags={"TruckMaintenanceItem"},
     *      summary="Delete existing TruckMaintenanceItem",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="TruckMaintenanceItem id",
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
        TruckMaintenanceItem::destroy($id);
        return response()->json(null, 204);
    }
}
