<?php

namespace App\Http\Controllers;

use App\Models\ExpenseItem;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="ExpenseItem",
 *     description="API Endpoints of ExpenseItem"
 * )
 */
class ExpenseItemController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/expense-item",
     *      operationId="getExpenseItemList",
     *      tags={"ExpenseItem"},
     *      summary="Get list of ExpenseItem",
     *      description="Returns list of ExpenseItem",
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
        return ExpenseItem::all();
    }

    /**
     * @OA\Post(
     *      path="/api/expense-item",
     *      operationId="storeExpenseItem",
     *      tags={"ExpenseItem"},
     *      summary="Store new ExpenseItem",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"expense_id"},
     *              @OA\Property(property="expense_id", type="integer", example=1),
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
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'expense_id' => 'required|exists:tbl_expense,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        return ExpenseItem::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/expense-item/{id}",
     *      operationId="getExpenseItemById",
     *      tags={"ExpenseItem"},
     *      summary="Get information about ExpenseItem",
     *      description="Returns ExpenseItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ExpenseItem id",
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
        return ExpenseItem::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/expense-item/{id}",
     *      operationId="updateExpenseItem",
     *      tags={"ExpenseItem"},
     *      summary="Update existing ExpenseItem",
     *      description="Returns updated ExpenseItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ExpenseItem id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"expense_id"},
     *              @OA\Property(property="expense_id", type="integer", example=1),
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
        $model = ExpenseItem::findOrFail($id);

        $validated = $request->validate([
            'price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'composite_price' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'expense_id' => 'required|exists:tbl_expense,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/expense-item/{id}",
     *      operationId="deleteExpenseItem",
     *      tags={"ExpenseItem"},
     *      summary="Delete existing ExpenseItem",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="ExpenseItem id",
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
        ExpenseItem::destroy($id);
        return response()->json(null, 204);
    }
}
