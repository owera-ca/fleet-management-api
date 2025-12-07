<?php

namespace App\Http\Controllers;

use App\Models\MetadataField;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="MetadataField",
 *     description="API Endpoints of MetadataField"
 * )
 */
class MetadataFieldController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/metadata-field",
     *      operationId="getMetadataFieldList",
     *      tags={"MetadataField"},
     *      summary="Get list of MetadataField",
     *      description="Returns list of MetadataField",
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
        return MetadataField::all();
    }

    /**
     * @OA\Post(
     *      path="/api/metadata-field",
     *      operationId="storeMetadataField",
     *      tags={"MetadataField"},
     *      summary="Store new MetadataField",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Color"),
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
            'entity_id' => 'nullable|exists:mst_entity,id',
        ]);

        return MetadataField::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/metadata-field/{id}",
     *      operationId="getMetadataFieldById",
     *      tags={"MetadataField"},
     *      summary="Get information about MetadataField",
     *      description="Returns MetadataField data",
     *      @OA\Parameter(
     *          name="id",
     *          description="MetadataField id",
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
        return MetadataField::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/metadata-field/{id}",
     *      operationId="updateMetadataField",
     *      tags={"MetadataField"},
     *      summary="Update existing MetadataField",
     *      description="Returns updated MetadataField data",
     *      @OA\Parameter(
     *          name="id",
     *          description="MetadataField id",
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
     *              @OA\Property(property="name", type="string", example="Color"),
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
        $model = MetadataField::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'entity_id' => 'nullable|exists:mst_entity,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/metadata-field/{id}",
     *      operationId="deleteMetadataField",
     *      tags={"MetadataField"},
     *      summary="Delete existing MetadataField",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="MetadataField id",
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
        MetadataField::destroy($id);
        return response()->json(null, 204);
    }
}
