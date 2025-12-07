<?php

namespace App\Http\Controllers;

use App\Models\MasterTruckMaintenance;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="MasterTruckMaintenance",
 *     description="API Endpoints of MasterTruckMaintenance"
 * )
 */
class MasterTruckMaintenanceController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/master-truck-maintenance",
     *      operationId="getMasterTruckMaintenanceList",
     *      tags={"MasterTruckMaintenance"},
     *      summary="Get list of MasterTruckMaintenance",
     *      description="Returns list of MasterTruckMaintenance",
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
        return MasterTruckMaintenance::all();
    }

    /**
     * @OA\Post(
     *      path="/api/master-truck-maintenance",
     *      operationId="storeMasterTruckMaintenance",
     *      tags={"MasterTruckMaintenance"},
     *      summary="Store new MasterTruckMaintenance",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"schedule_days"},
     *              @OA\Property(property="schedule_days", type="integer", example=90),
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
            'schedule_days' => 'nullable|integer',
            'schedule_km' => 'nullable|integer',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'mst_line_item' => 'nullable|exists:mst_line_item,id',
        ]);

        return MasterTruckMaintenance::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/master-truck-maintenance/{id}",
     *      operationId="getMasterTruckMaintenanceById",
     *      tags={"MasterTruckMaintenance"},
     *      summary="Get information about MasterTruckMaintenance",
     *      description="Returns MasterTruckMaintenance data",
     *      @OA\Parameter(
     *          name="id",
     *          description="MasterTruckMaintenance id",
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
        return MasterTruckMaintenance::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/master-truck-maintenance/{id}",
     *      operationId="updateMasterTruckMaintenance",
     *      tags={"MasterTruckMaintenance"},
     *      summary="Update existing MasterTruckMaintenance",
     *      description="Returns updated MasterTruckMaintenance data",
     *      @OA\Parameter(
     *          name="id",
     *          description="MasterTruckMaintenance id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"schedule_days"},
     *              @OA\Property(property="schedule_days", type="integer", example=90),
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
        $model = MasterTruckMaintenance::findOrFail($id);

        $validated = $request->validate([
            'schedule_days' => 'nullable|integer',
            'schedule_km' => 'nullable|integer',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'mst_line_item' => 'nullable|exists:mst_line_item,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/master-truck-maintenance/{id}",
     *      operationId="deleteMasterTruckMaintenance",
     *      tags={"MasterTruckMaintenance"},
     *      summary="Delete existing MasterTruckMaintenance",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="MasterTruckMaintenance id",
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
        MasterTruckMaintenance::destroy($id);
        return response()->json(null, 204);
    }
}
