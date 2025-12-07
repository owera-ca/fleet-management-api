<?php

namespace App\Http\Controllers;

use App\Models\EntityTransitionRoleDefinition;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="EntityTransitionRoleDefinition",
 *     description="API Endpoints of EntityTransitionRoleDefinition"
 * )
 */
class EntityTransitionRoleDefinitionController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/entity-transition-role-definition",
     *      operationId="getEntityTransitionRoleDefinitionList",
     *      tags={"EntityTransitionRoleDefinition"},
     *      summary="Get list of EntityTransitionRoleDefinition",
     *      description="Returns list of EntityTransitionRoleDefinition",
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
        return EntityTransitionRoleDefinition::all();
    }

    /**
     * @OA\Post(
     *      path="/api/entity-transition-role-definition",
     *      operationId="storeEntityTransitionRoleDefinition",
     *      tags={"EntityTransitionRoleDefinition"},
     *      summary="Store new EntityTransitionRoleDefinition",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"entity_transition_id","role_id"},
     *              @OA\Property(property="entity_transition_id", type="integer", example=1),
     *              @OA\Property(property="role_id", type="integer", example=1),
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
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'entity_transition_id' => 'required|exists:def_entity_transition,id',
            'role_id' => 'required|exists:mst_role,id',
        ]);

        return EntityTransitionRoleDefinition::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/entity-transition-role-definition/{id}",
     *      operationId="getEntityTransitionRoleDefinitionById",
     *      tags={"EntityTransitionRoleDefinition"},
     *      summary="Get information about EntityTransitionRoleDefinition",
     *      description="Returns EntityTransitionRoleDefinition data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransitionRoleDefinition id",
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
        return EntityTransitionRoleDefinition::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/entity-transition-role-definition/{id}",
     *      operationId="updateEntityTransitionRoleDefinition",
     *      tags={"EntityTransitionRoleDefinition"},
     *      summary="Update existing EntityTransitionRoleDefinition",
     *      description="Returns updated EntityTransitionRoleDefinition data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransitionRoleDefinition id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"entity_transition_id","role_id"},
     *              @OA\Property(property="entity_transition_id", type="integer", example=1),
     *              @OA\Property(property="role_id", type="integer", example=1),
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
        $model = EntityTransitionRoleDefinition::findOrFail($id);

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'entity_transition_id' => 'required|exists:def_entity_transition,id',
            'role_id' => 'required|exists:mst_role,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/entity-transition-role-definition/{id}",
     *      operationId="deleteEntityTransitionRoleDefinition",
     *      tags={"EntityTransitionRoleDefinition"},
     *      summary="Delete existing EntityTransitionRoleDefinition",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransitionRoleDefinition id",
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
        EntityTransitionRoleDefinition::destroy($id);
        return response()->json(null, 204);
    }
}
