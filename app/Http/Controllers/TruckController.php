<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Truck",
 *     description="API Endpoints of Truck"
 * )
 */
class TruckController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/truck",
     *      operationId="getTruckList",
     *      tags={"Truck"},
     *      summary="Get list of Truck",
     *      description="Returns list of Truck",
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
        return Truck::all();
    }

    /**
     * @OA\Post(
     *      path="/api/truck",
     *      operationId="storeTruck",
     *      tags={"Truck"},
     *      summary="Store new Truck",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"vin","number_plate"},
     *              @OA\Property(property="vin", type="string", example="1HGCM82633A004352"),
     *              @OA\Property(property="number_plate", type="string", example="ABC-1234"),
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
            'vin' => 'required|string|max:255',
            'number_plate' => 'required|string|max:255',
            'registered_at' => 'nullable|date',
            'total_km' => 'nullable|integer',
            'status' => 'nullable|string|max:255',
            'towing_capacity_kg' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'carrier_id' => 'nullable|exists:mst_entity,id', // Assuming Carrier is Entity
        ]);

        return Truck::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/truck/{id}",
     *      operationId="getTruckById",
     *      tags={"Truck"},
     *      summary="Get information about Truck",
     *      description="Returns Truck data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Truck id",
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
        return Truck::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/truck/{id}",
     *      operationId="updateTruck",
     *      tags={"Truck"},
     *      summary="Update existing Truck",
     *      description="Returns updated Truck data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Truck id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"vin","number_plate"},
     *              @OA\Property(property="vin", type="string", example="1HGCM82633A004352"),
     *              @OA\Property(property="number_plate", type="string", example="ABC-1234"),
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
        $model = Truck::findOrFail($id);

        $validated = $request->validate([
            'vin' => 'required|string|max:255',
            'number_plate' => 'required|string|max:255',
            'registered_at' => 'nullable|date',
            'total_km' => 'nullable|integer',
            'status' => 'nullable|string|max:255',
            'towing_capacity_kg' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'carrier_id' => 'nullable|exists:mst_entity,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/truck/{id}",
     *      operationId="deleteTruck",
     *      tags={"Truck"},
     *      summary="Delete existing Truck",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Truck id",
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
        Truck::destroy($id);
        return response()->json(null, 204);
    }
}
