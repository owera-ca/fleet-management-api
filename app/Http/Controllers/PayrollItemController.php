<?php

namespace App\Http\Controllers;

use App\Models\PayrollItem;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="PayrollItem",
 *     description="API Endpoints of PayrollItem"
 * )
 */
class PayrollItemController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/payroll-item",
     *      operationId="getPayrollItemList",
     *      tags={"PayrollItem"},
     *      summary="Get list of PayrollItem",
     *      description="Returns list of PayrollItem",
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
        return PayrollItem::all();
    }

    /**
     * @OA\Post(
     *      path="/api/payroll-item",
     *      operationId="storePayrollItem",
     *      tags={"PayrollItem"},
     *      summary="Store new PayrollItem",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"payroll_id"},
     *              @OA\Property(property="payroll_id", type="integer", example=1),
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
            'amount' => 'nullable|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'payroll_id' => 'required|exists:tbl_payroll,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        return PayrollItem::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/payroll-item/{id}",
     *      operationId="getPayrollItemById",
     *      tags={"PayrollItem"},
     *      summary="Get information about PayrollItem",
     *      description="Returns PayrollItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="PayrollItem id",
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
        return PayrollItem::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/payroll-item/{id}",
     *      operationId="updatePayrollItem",
     *      tags={"PayrollItem"},
     *      summary="Update existing PayrollItem",
     *      description="Returns updated PayrollItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="PayrollItem id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"payroll_id"},
     *              @OA\Property(property="payroll_id", type="integer", example=1),
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
        $model = PayrollItem::findOrFail($id);

        $validated = $request->validate([
            'amount' => 'nullable|numeric',
            'program_id' => 'nullable|exists:mst_program,id',
            'payroll_id' => 'required|exists:tbl_payroll,id',
            'mst_line_item_id' => 'nullable|exists:mst_line_item,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/payroll-item/{id}",
     *      operationId="deletePayrollItem",
     *      tags={"PayrollItem"},
     *      summary="Delete existing PayrollItem",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="PayrollItem id",
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
        PayrollItem::destroy($id);
        return response()->json(null, 204);
    }
}
