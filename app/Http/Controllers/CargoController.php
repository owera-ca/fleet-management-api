<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Cargo",
 *     description="API Endpoints of Cargo"
 * )
 */
class CargoController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/cargo",
     *      operationId="getCargoList",
     *      tags={"Cargo"},
     *      summary="Get list of Cargo",
     *      description="Returns list of Cargo",
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
        return Cargo::all();
    }

    /**
     * @OA\Post(
     *      path="/api/cargo",
     *      operationId="storeCargo",
     *      tags={"Cargo"},
     *      summary="Store new Cargo",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shipment_id"},
     *              @OA\Property(property="shipment_id", type="integer", example=1),
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
            'weight' => 'nullable|numeric',
            'value' => 'nullable|numeric',
            'type' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipment_id' => 'required|exists:tbl_shipment,id',
        ]);

        return Cargo::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/cargo/{id}",
     *      operationId="getCargoById",
     *      tags={"Cargo"},
     *      summary="Get information about Cargo",
     *      description="Returns Cargo data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Cargo id",
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
        return Cargo::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/cargo/{id}",
     *      operationId="updateCargo",
     *      tags={"Cargo"},
     *      summary="Update existing Cargo",
     *      description="Returns updated Cargo data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Cargo id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shipment_id"},
     *              @OA\Property(property="shipment_id", type="integer", example=1),
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
        $model = Cargo::findOrFail($id);

        $validated = $request->validate([
            'weight' => 'nullable|numeric',
            'value' => 'nullable|numeric',
            'type' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipment_id' => 'required|exists:tbl_shipment,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/cargo/{id}",
     *      operationId="deleteCargo",
     *      tags={"Cargo"},
     *      summary="Delete existing Cargo",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Cargo id",
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
        Cargo::destroy($id);
        return response()->json(null, 204);
    }
}
