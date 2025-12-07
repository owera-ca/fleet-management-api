<?php

namespace App\Http\Controllers;

use App\Models\ShopJob;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="ShopJob",
 *     description="API Endpoints of ShopJob"
 * )
 */
class ShopJobController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/shop-job",
     *      operationId="getShopJobList",
     *      tags={"ShopJob"},
     *      summary="Get list of ShopJob",
     *      description="Returns list of ShopJob",
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
        return ShopJob::all();
    }

    /**
     * @OA\Post(
     *      path="/api/shop-job",
     *      operationId="storeShopJob",
     *      tags={"ShopJob"},
     *      summary="Store new ShopJob",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shop_id","truck_id"},
     *              @OA\Property(property="shop_id", type="integer", example=1),
     *              @OA\Property(property="truck_id", type="integer", example=1),
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
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shop_id' => 'required|exists:tbl_shop,id',
            'truck_id' => 'required|exists:tbl_truck,id',
        ]);

        return ShopJob::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/shop-job/{id}",
     *      operationId="getShopJobById",
     *      tags={"ShopJob"},
     *      summary="Get information about ShopJob",
     *      description="Returns ShopJob data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJob id",
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
        return ShopJob::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/shop-job/{id}",
     *      operationId="updateShopJob",
     *      tags={"ShopJob"},
     *      summary="Update existing ShopJob",
     *      description="Returns updated ShopJob data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJob id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"shop_id","truck_id"},
     *              @OA\Property(property="shop_id", type="integer", example=1),
     *              @OA\Property(property="truck_id", type="integer", example=1),
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
        $model = ShopJob::findOrFail($id);

        $validated = $request->validate([
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'shop_id' => 'required|exists:tbl_shop,id',
            'truck_id' => 'required|exists:tbl_truck,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/shop-job/{id}",
     *      operationId="deleteShopJob",
     *      tags={"ShopJob"},
     *      summary="Delete existing ShopJob",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="ShopJob id",
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
        ShopJob::destroy($id);
        return response()->json(null, 204);
    }
}
