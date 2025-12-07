<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Expense",
 *     description="API Endpoints of Expense"
 * )
 */
class ExpenseController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/expense",
     *      operationId="getExpenseList",
     *      tags={"Expense"},
     *      summary="Get list of Expense",
     *      description="Returns list of Expense",
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
        return Expense::all();
    }

    /**
     * @OA\Post(
     *      path="/api/expense",
     *      operationId="storeExpense",
     *      tags={"Expense"},
     *      summary="Store new Expense",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"driver_id"},
     *              @OA\Property(property="driver_id", type="integer", example=1),
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
            'description' => 'nullable|string',
            'subtotal' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipment_id' => 'nullable|exists:tbl_shipment,id',
            'driver_id' => 'nullable|exists:tbl_driver,id',
        ]);

        return Expense::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/expense/{id}",
     *      operationId="getExpenseById",
     *      tags={"Expense"},
     *      summary="Get information about Expense",
     *      description="Returns Expense data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Expense id",
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
        return Expense::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/expense/{id}",
     *      operationId="updateExpense",
     *      tags={"Expense"},
     *      summary="Update existing Expense",
     *      description="Returns updated Expense data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Expense id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"driver_id"},
     *              @OA\Property(property="driver_id", type="integer", example=1),
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
        $model = Expense::findOrFail($id);

        $validated = $request->validate([
            'description' => 'nullable|string',
            'subtotal' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'program_id' => 'nullable|exists:mst_program,id',
            'shipment_id' => 'nullable|exists:tbl_shipment,id',
            'driver_id' => 'nullable|exists:tbl_driver,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/expense/{id}",
     *      operationId="deleteExpense",
     *      tags={"Expense"},
     *      summary="Delete existing Expense",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Expense id",
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
        Expense::destroy($id);
        return response()->json(null, 204);
    }
}
