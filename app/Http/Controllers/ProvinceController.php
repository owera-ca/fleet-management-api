<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Province",
 *     description="API Endpoints of Province"
 * )
 */
class ProvinceController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/province",
     *      operationId="getProvinceList",
     *      tags={"Province"},
     *      summary="Get list of Province",
     *      description="Returns list of Province",
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
        return Province::all();
    }

    /**
     * @OA\Post(
     *      path="/api/province",
     *      operationId="storeProvince",
     *      tags={"Province"},
     *      summary="Store new Province",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="California"),
     *              @OA\Property(property="iso3_code", type="string", example="CA"),
     *              @OA\Property(property="country_id", type="integer", example=1),
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
            'iso3_code' => 'nullable|string|max:3',
            'country_id' => 'nullable|exists:mst_country,id',
        ]);

        return Province::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/province/{id}",
     *      operationId="getProvinceById",
     *      tags={"Province"},
     *      summary="Get information about Province",
     *      description="Returns Province data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Province id",
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
        return Province::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/province/{id}",
     *      operationId="updateProvince",
     *      tags={"Province"},
     *      summary="Update existing Province",
     *      description="Returns updated Province data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Province id",
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
     *              @OA\Property(property="name", type="string", example="California"),
     *              @OA\Property(property="iso3_code", type="string", example="CA"),
     *              @OA\Property(property="country_id", type="integer", example=1),
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
        $model = Province::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'iso3_code' => 'nullable|string|max:3',
            'country_id' => 'nullable|exists:mst_country,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/province/{id}",
     *      operationId="deleteProvince",
     *      tags={"Province"},
     *      summary="Delete existing Province",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Province id",
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
        Province::destroy($id);
        return response()->json(null, 204);
    }
}
