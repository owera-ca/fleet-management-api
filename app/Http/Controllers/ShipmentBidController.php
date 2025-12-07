<?php

namespace App\Http\Controllers;

use App\Models\ShipmentBid;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="ShipmentBid",
 *     description="API Endpoints of ShipmentBid"
 * )
 */
class ShipmentBidController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/shipment-bid",
     *      operationId="getShipmentBidList",
     *      tags={"ShipmentBid"},
     *      summary="Get list of ShipmentBid",
     *      description="Returns list of ShipmentBid",
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
        return ShipmentBid::all();
    }

    /**
     * @OA\Post(
     *      path="/api/shipment-bid",
     *      operationId="storeShipmentBid",
     *      tags={"ShipmentBid"},
     *      summary="Store new ShipmentBid",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shipment_id","carrier_id"},
     *              @OA\Property(property="shipment_id", type="integer", example=1),
     *              @OA\Property(property="carrier_id", type="integer", example=1),
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
            'amount' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipment_id' => 'required|exists:tbl_shipment,id',
            'carrier_id' => 'required|exists:mst_entity,id', // Assuming Carrier is Entity
        ]);

        return ShipmentBid::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/shipment-bid/{id}",
     *      operationId="getShipmentBidById",
     *      tags={"ShipmentBid"},
     *      summary="Get information about ShipmentBid",
     *      description="Returns ShipmentBid data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShipmentBid id",
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
        return ShipmentBid::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/shipment-bid/{id}",
     *      operationId="updateShipmentBid",
     *      tags={"ShipmentBid"},
     *      summary="Update existing ShipmentBid",
     *      description="Returns updated ShipmentBid data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShipmentBid id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shipment_id","carrier_id"},
     *              @OA\Property(property="shipment_id", type="integer", example=1),
     *              @OA\Property(property="carrier_id", type="integer", example=1),
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
        $model = ShipmentBid::findOrFail($id);

        $validated = $request->validate([
            'amount' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipment_id' => 'required|exists:tbl_shipment,id',
            'carrier_id' => 'required|exists:mst_entity,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/shipment-bid/{id}",
     *      operationId="deleteShipmentBid",
     *      tags={"ShipmentBid"},
     *      summary="Delete existing ShipmentBid",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShipmentBid id",
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
        ShipmentBid::destroy($id);
        return response()->json(null, 204);
    }
}
