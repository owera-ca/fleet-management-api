<?php

namespace App\Http\Controllers;

use App\Models\ShopJobItem;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="ShopJobItem",
 *     description="API Endpoints of ShopJobItem"
 * )
 */
class ShopJobItemController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/shop-job-item",
     *      operationId="getShopJobItemList",
     *      tags={"ShopJobItem"},
     *      summary="Get list of ShopJobItem",
     *      description="Returns list of ShopJobItem",
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
        return ShopJobItem::all();
    }

    /**
     * @OA\Post(
     *      path="/api/shop-job-item",
     *      operationId="storeShopJobItem",
     *      tags={"ShopJobItem"},
     *      summary="Store new ShopJobItem",
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
            'price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'composite_price' => 'nullable|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'shop_job_id' => 'required|exists:tbl_shop_job,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        return ShopJobItem::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/shop-job-item/{id}",
     *      operationId="getShopJobItemById",
     *      tags={"ShopJobItem"},
     *      summary="Get information about ShopJobItem",
     *      description="Returns ShopJobItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJobItem id",
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
        return ShopJobItem::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/shop-job-item/{id}",
     *      operationId="updateShopJobItem",
     *      tags={"ShopJobItem"},
     *      summary="Update existing ShopJobItem",
     *      description="Returns updated ShopJobItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJobItem id",
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
        $model = ShopJobItem::findOrFail($id);

        $validated = $request->validate([
            'price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'composite_price' => 'nullable|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'shop_job_id' => 'required|exists:tbl_shop_job,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/shop-job-item/{id}",
     *      operationId="deleteShopJobItem",
     *      tags={"ShopJobItem"},
     *      summary="Delete existing ShopJobItem",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJobItem id",
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
        ShopJobItem::destroy($id);
        return response()->json(null, 204);
    }
}
