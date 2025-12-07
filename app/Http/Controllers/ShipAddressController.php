<?php

namespace App\Http\Controllers;

use App\Models\ShipAddress;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="ShipAddress",
 *     description="API Endpoints of ShipAddress"
 * )
 */
class ShipAddressController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/ship-address",
     *      operationId="getShipAddressList",
     *      tags={"ShipAddress"},
     *      summary="Get list of ShipAddress",
     *      description="Returns list of ShipAddress",
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
        return ShipAddress::all();
    }

    /**
     * @OA\Post(
     *      path="/api/ship-address",
     *      operationId="storeShipAddress",
     *      tags={"ShipAddress"},
     *      summary="Store new ShipAddress",
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
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipper_id' => 'required|exists:mst_entity,id', // Assuming Shipper is Entity
            'address_id' => 'nullable|exists:tbl_address,id',
        ]);

        return ShipAddress::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/ship-address/{id}",
     *      operationId="getShipAddressById",
     *      tags={"ShipAddress"},
     *      summary="Get information about ShipAddress",
     *      description="Returns ShipAddress data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShipAddress id",
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
        return ShipAddress::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/ship-address/{id}",
     *      operationId="updateShipAddress",
     *      tags={"ShipAddress"},
     *      summary="Update existing ShipAddress",
     *      description="Returns updated ShipAddress data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShipAddress id",
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
        $model = ShipAddress::findOrFail($id);

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipper_id' => 'required|exists:mst_entity,id',
            'address_id' => 'nullable|exists:tbl_address,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/ship-address/{id}",
     *      operationId="deleteShipAddress",
     *      tags={"ShipAddress"},
     *      summary="Delete existing ShipAddress",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShipAddress id",
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
        ShipAddress::destroy($id);
        return response()->json(null, 204);
    }
}
