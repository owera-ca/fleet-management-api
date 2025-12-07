<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="OrderItem",
 *     description="API Endpoints of OrderItem"
 * )
 */
class OrderItemController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/order-item",
     *      operationId="getOrderItemList",
     *      tags={"OrderItem"},
     *      summary="Get list of OrderItem",
     *      description="Returns list of OrderItem",
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
        return OrderItem::all();
    }

    /**
     * @OA\Post(
     *      path="/api/order-item",
     *      operationId="storeOrderItem",
     *      tags={"OrderItem"},
     *      summary="Store new OrderItem",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"order_id"},
     *              @OA\Property(property="order_id", type="integer", example=1),
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
            'program_id' => 'nullable|exists:mst_program,id',
            'order_id' => 'required|exists:tbl_order,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        return OrderItem::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/order-item/{id}",
     *      operationId="getOrderItemById",
     *      tags={"OrderItem"},
     *      summary="Get information about OrderItem",
     *      description="Returns OrderItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrderItem id",
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
        return OrderItem::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/order-item/{id}",
     *      operationId="updateOrderItem",
     *      tags={"OrderItem"},
     *      summary="Update existing OrderItem",
     *      description="Returns updated OrderItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrderItem id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"order_id"},
     *              @OA\Property(property="order_id", type="integer", example=1),
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
        $model = OrderItem::findOrFail($id);

        $validated = $request->validate([
            'price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'order_id' => 'required|exists:tbl_order,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/order-item/{id}",
     *      operationId="deleteOrderItem",
     *      tags={"OrderItem"},
     *      summary="Delete existing OrderItem",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrderItem id",
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
        OrderItem::destroy($id);
        return response()->json(null, 204);
    }
}
