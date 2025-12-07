<?php

namespace App\Http\Controllers;

use App\Models\CarrierDispatch;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="CarrierDispatch",
 *     description="API Endpoints of CarrierDispatch"
 * )
 */
class CarrierDispatchController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/carrier-dispatch",
     *      operationId="getCarrierDispatchList",
     *      tags={"CarrierDispatch"},
     *      summary="Get list of CarrierDispatch",
     *      description="Returns list of CarrierDispatch",
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
        return CarrierDispatch::all();
    }

    /**
     * @OA\Post(
     *      path="/api/carrier-dispatch",
     *      operationId="storeCarrierDispatch",
     *      tags={"CarrierDispatch"},
     *      summary="Store new CarrierDispatch",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"carrier_id"},
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
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'carrier_id' => 'required|exists:mst_entity,id', // Assuming Carrier is Entity
            'dispatch_id' => 'nullable|exists:tbl_dispatch,id',
        ]);

        return CarrierDispatch::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/carrier-dispatch/{id}",
     *      operationId="getCarrierDispatchById",
     *      tags={"CarrierDispatch"},
     *      summary="Get information about CarrierDispatch",
     *      description="Returns CarrierDispatch data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CarrierDispatch id",
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
        return CarrierDispatch::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/carrier-dispatch/{id}",
     *      operationId="updateCarrierDispatch",
     *      tags={"CarrierDispatch"},
     *      summary="Update existing CarrierDispatch",
     *      description="Returns updated CarrierDispatch data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CarrierDispatch id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"carrier_id"},
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
        $model = CarrierDispatch::findOrFail($id);

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'carrier_id' => 'required|exists:mst_entity,id',
            'dispatch_id' => 'nullable|exists:tbl_dispatch,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/carrier-dispatch/{id}",
     *      operationId="deleteCarrierDispatch",
     *      tags={"CarrierDispatch"},
     *      summary="Delete existing CarrierDispatch",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="CarrierDispatch id",
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
        CarrierDispatch::destroy($id);
        return response()->json(null, 204);
    }
}
