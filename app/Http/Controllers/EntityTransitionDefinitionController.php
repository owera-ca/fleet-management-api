<?php

namespace App\Http\Controllers;

use App\Models\EntityTransitionDefinition;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="EntityTransitionDefinition",
 *     description="API Endpoints of EntityTransitionDefinition"
 * )
 */
class EntityTransitionDefinitionController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/entity-transition-definition",
     *      operationId="getEntityTransitionDefinitionList",
     *      tags={"EntityTransitionDefinition"},
     *      summary="Get list of EntityTransitionDefinition",
     *      description="Returns list of EntityTransitionDefinition",
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
        return EntityTransitionDefinition::all();
    }

    /**
     * @OA\Post(
     *      path="/api/entity-transition-definition",
     *      operationId="storeEntityTransitionDefinition",
     *      tags={"EntityTransitionDefinition"},
     *      summary="Store new EntityTransitionDefinition",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name","from_state","to_state"},
     *              @OA\Property(property="name", type="string", example="Approve"),
     *              @OA\Property(property="from_state", type="string", example="Pending"),
     *              @OA\Property(property="to_state", type="string", example="Approved"),
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
            'from_state' => 'required|string|max:255',
            'to_state' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'entity_id' => 'nullable|exists:mst_entity,id',
        ]);

        return EntityTransitionDefinition::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/entity-transition-definition/{id}",
     *      operationId="getEntityTransitionDefinitionById",
     *      tags={"EntityTransitionDefinition"},
     *      summary="Get information about EntityTransitionDefinition",
     *      description="Returns EntityTransitionDefinition data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransitionDefinition id",
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
        return EntityTransitionDefinition::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/entity-transition-definition/{id}",
     *      operationId="updateEntityTransitionDefinition",
     *      tags={"EntityTransitionDefinition"},
     *      summary="Update existing EntityTransitionDefinition",
     *      description="Returns updated EntityTransitionDefinition data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransitionDefinition id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name","from_state","to_state"},
     *              @OA\Property(property="name", type="string", example="Approve"),
     *              @OA\Property(property="from_state", type="string", example="Pending"),
     *              @OA\Property(property="to_state", type="string", example="Approved"),
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
        $model = EntityTransitionDefinition::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'from_state' => 'required|string|max:255',
            'to_state' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'entity_id' => 'nullable|exists:mst_entity,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/entity-transition-definition/{id}",
     *      operationId="deleteEntityTransitionDefinition",
     *      tags={"EntityTransitionDefinition"},
     *      summary="Delete existing EntityTransitionDefinition",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransitionDefinition id",
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
        EntityTransitionDefinition::destroy($id);
        return response()->json(null, 204);
    }
}
