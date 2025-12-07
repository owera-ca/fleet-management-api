<?php

namespace App\Http\Controllers;

use App\Models\EntityRoleDefinition;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="EntityRoleDefinition",
 *     description="API Endpoints of EntityRoleDefinition"
 * )
 */
class EntityRoleDefinitionController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/entity-role-definition",
     *      operationId="getEntityRoleDefinitionList",
     *      tags={"EntityRoleDefinition"},
     *      summary="Get list of EntityRoleDefinition",
     *      description="Returns list of EntityRoleDefinition",
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
        return EntityRoleDefinition::all();
    }

    /**
     * @OA\Post(
     *      path="/api/entity-role-definition",
     *      operationId="storeEntityRoleDefinition",
     *      tags={"EntityRoleDefinition"},
     *      summary="Store new EntityRoleDefinition",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"entity_id","role_id"},
     *              @OA\Property(property="entity_id", type="integer", example=1),
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
            'entity_id' => 'required|exists:mst_entity,id',
            'role_id' => 'required|exists:mst_role,id',
        ]);

        return EntityRoleDefinition::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/entity-role-definition/{id}",
     *      operationId="getEntityRoleDefinitionById",
     *      tags={"EntityRoleDefinition"},
     *      summary="Get information about EntityRoleDefinition",
     *      description="Returns EntityRoleDefinition data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityRoleDefinition id",
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
        return EntityRoleDefinition::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/entity-role-definition/{id}",
     *      operationId="updateEntityRoleDefinition",
     *      tags={"EntityRoleDefinition"},
     *      summary="Update existing EntityRoleDefinition",
     *      description="Returns updated EntityRoleDefinition data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityRoleDefinition id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"entity_id","role_id"},
     *              @OA\Property(property="entity_id", type="integer", example=1),
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
        $model = EntityRoleDefinition::findOrFail($id);

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'entity_id' => 'required|exists:mst_entity,id',
            'role_id' => 'required|exists:mst_role,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/entity-role-definition/{id}",
     *      operationId="deleteEntityRoleDefinition",
     *      tags={"EntityRoleDefinition"},
     *      summary="Delete existing EntityRoleDefinition",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityRoleDefinition id",
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
        EntityRoleDefinition::destroy($id);
        return response()->json(null, 204);
    }
}
