<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="LineItem",
 *     description="API Endpoints of LineItem"
 * )
 */
class LineItemController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/line-item",
     *      operationId="getLineItemList",
     *      tags={"LineItem"},
     *      summary="Get list of LineItem",
     *      description="Returns list of LineItem",
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
        return LineItem::all();
    }

    /**
     * @OA\Post(
     *      path="/api/line-item",
     *      operationId="storeLineItem",
     *      tags={"LineItem"},
     *      summary="Store new LineItem",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Oil Change"),
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
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'parent_id' => 'nullable|exists:mst_line_item,id',
        ]);

        return LineItem::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/line-item/{id}",
     *      operationId="getLineItemById",
     *      tags={"LineItem"},
     *      summary="Get information about LineItem",
     *      description="Returns LineItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="LineItem id",
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
        return LineItem::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/line-item/{id}",
     *      operationId="updateLineItem",
     *      tags={"LineItem"},
     *      summary="Update existing LineItem",
     *      description="Returns updated LineItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="LineItem id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Oil Change"),
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
        $model = LineItem::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'parent_id' => 'nullable|exists:mst_line_item,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/line-item/{id}",
     *      operationId="deleteLineItem",
     *      tags={"LineItem"},
     *      summary="Delete existing LineItem",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="LineItem id",
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
        LineItem::destroy($id);
        return response()->json(null, 204);
    }
}
