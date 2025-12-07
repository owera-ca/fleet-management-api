<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Shipment",
 *     description="API Endpoints of Shipment"
 * )
 */
class ShipmentController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/shipment",
     *      operationId="getShipmentList",
     *      tags={"Shipment"},
     *      summary="Get list of Shipment",
     *      description="Returns list of Shipment",
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
        return Shipment::all();
    }

    /**
     * @OA\Post(
     *      path="/api/shipment",
     *      operationId="storeShipment",
     *      tags={"Shipment"},
     *      summary="Store new Shipment",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shipper_id"},
     *              @OA\Property(property="shipper_id", type="integer", example=1),
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
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'eta' => 'nullable|date',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipper_id' => 'required|exists:mst_entity,id', // Assuming Shipper is Entity
            'dispatch_id' => 'nullable|exists:tbl_dispatch,id',
        ]);

        return Shipment::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/shipment/{id}",
     *      operationId="getShipmentById",
     *      tags={"Shipment"},
     *      summary="Get information about Shipment",
     *      description="Returns Shipment data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Shipment id",
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
        return Shipment::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/shipment/{id}",
     *      operationId="updateShipment",
     *      tags={"Shipment"},
     *      summary="Update existing Shipment",
     *      description="Returns updated Shipment data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Shipment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shipper_id"},
     *              @OA\Property(property="shipper_id", type="integer", example=1),
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
        $model = Shipment::findOrFail($id);

        $validated = $request->validate([
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'eta' => 'nullable|date',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipper_id' => 'required|exists:mst_entity,id',
            'dispatch_id' => 'nullable|exists:tbl_dispatch,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/shipment/{id}",
     *      operationId="deleteShipment",
     *      tags={"Shipment"},
     *      summary="Delete existing Shipment",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Shipment id",
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
        Shipment::destroy($id);
        return response()->json(null, 204);
    }
}
