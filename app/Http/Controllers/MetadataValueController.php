<?php

namespace App\Http\Controllers;

use App\Models\MetadataValue;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="MetadataValue",
 *     description="API Endpoints of MetadataValue"
 * )
 */
class MetadataValueController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/metadata-value",
     *      operationId="getMetadataValueList",
     *      tags={"MetadataValue"},
     *      summary="Get list of MetadataValue",
     *      description="Returns list of MetadataValue",
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
        return MetadataValue::all();
    }

    /**
     * @OA\Post(
     *      path="/api/metadata-value",
     *      operationId="storeMetadataValue",
     *      tags={"MetadataValue"},
     *      summary="Store new MetadataValue",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"value"},
     *              @OA\Property(property="value", type="string", example="Red"),
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
            'value' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'metadata_field_id' => 'nullable|exists:mst_metadata,id',
            'entity_id' => 'nullable|exists:mst_entity,id',
        ]);

        return MetadataValue::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/metadata-value/{id}",
     *      operationId="getMetadataValueById",
     *      tags={"MetadataValue"},
     *      summary="Get information about MetadataValue",
     *      description="Returns MetadataValue data",
     *      @OA\Parameter(
     *          name="id",
     *          description="MetadataValue id",
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
        return MetadataValue::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/metadata-value/{id}",
     *      operationId="updateMetadataValue",
     *      tags={"MetadataValue"},
     *      summary="Update existing MetadataValue",
     *      description="Returns updated MetadataValue data",
     *      @OA\Parameter(
     *          name="id",
     *          description="MetadataValue id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"value"},
     *              @OA\Property(property="value", type="string", example="Red"),
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
        $model = MetadataValue::findOrFail($id);

        $validated = $request->validate([
            'value' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'metadata_field_id' => 'nullable|exists:mst_metadata,id',
            'entity_id' => 'nullable|exists:mst_entity,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/metadata-value/{id}",
     *      operationId="deleteMetadataValue",
     *      tags={"MetadataValue"},
     *      summary="Delete existing MetadataValue",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="MetadataValue id",
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
        MetadataValue::destroy($id);
        return response()->json(null, 204);
    }
}
