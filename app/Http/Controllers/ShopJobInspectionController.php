<?php

namespace App\Http\Controllers;

use App\Models\ShopJobInspection;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="ShopJobInspection",
 *     description="API Endpoints of ShopJobInspection"
 * )
 */
class ShopJobInspectionController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/shop-job-inspection",
     *      operationId="getShopJobInspectionList",
     *      tags={"ShopJobInspection"},
     *      summary="Get list of ShopJobInspection",
     *      description="Returns list of ShopJobInspection",
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
        return ShopJobInspection::all();
    }

    /**
     * @OA\Post(
     *      path="/api/shop-job-inspection",
     *      operationId="storeShopJobInspection",
     *      tags={"ShopJobInspection"},
     *      summary="Store new ShopJobInspection",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shop_job_id"},
     *              @OA\Property(property="shop_job_id", type="integer", example=1),
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
            'shop_job_id' => 'required|exists:tbl_shop_job,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        return ShopJobInspection::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/shop-job-inspection/{id}",
     *      operationId="getShopJobInspectionById",
     *      tags={"ShopJobInspection"},
     *      summary="Get information about ShopJobInspection",
     *      description="Returns ShopJobInspection data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJobInspection id",
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
        return ShopJobInspection::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/shop-job-inspection/{id}",
     *      operationId="updateShopJobInspection",
     *      tags={"ShopJobInspection"},
     *      summary="Update existing ShopJobInspection",
     *      description="Returns updated ShopJobInspection data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJobInspection id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shop_job_id"},
     *              @OA\Property(property="shop_job_id", type="integer", example=1),
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
        $model = ShopJobInspection::findOrFail($id);

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shop_job_id' => 'required|exists:tbl_shop_job,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/shop-job-inspection/{id}",
     *      operationId="deleteShopJobInspection",
     *      tags={"ShopJobInspection"},
     *      summary="Delete existing ShopJobInspection",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJobInspection id",
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
        ShopJobInspection::destroy($id);
        return response()->json(null, 204);
    }
}
