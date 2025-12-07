<?php

namespace App\Http\Controllers;

use App\Models\EntityTransition;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="EntityTransition",
 *     description="API Endpoints of EntityTransition"
 * )
 */
class EntityTransitionController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/entity-transition",
     *      operationId="getEntityTransitionList",
     *      tags={"EntityTransition"},
     *      summary="Get list of EntityTransition",
     *      description="Returns list of EntityTransition",
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
        return EntityTransition::all();
    }

    /**
     * @OA\Post(
     *      path="/api/entity-transition",
     *      operationId="storeEntityTransition",
     *      tags={"EntityTransition"},
     *      summary="Store new EntityTransition",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"entity_id","entity_transition_definition_id"},
     *              @OA\Property(property="entity_id", type="integer", example=1),
     *              @OA\Property(property="entity_transition_definition_id", type="integer", example=1),
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
            'entity_transition_definition_id' => 'required|exists:def_entity_transition,id',
        ]);

        return EntityTransition::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/entity-transition/{id}",
     *      operationId="getEntityTransitionById",
     *      tags={"EntityTransition"},
     *      summary="Get information about EntityTransition",
     *      description="Returns EntityTransition data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransition id",
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
        return EntityTransition::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/entity-transition/{id}",
     *      operationId="updateEntityTransition",
     *      tags={"EntityTransition"},
     *      summary="Update existing EntityTransition",
     *      description="Returns updated EntityTransition data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransition id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"entity_id","entity_transition_definition_id"},
     *              @OA\Property(property="entity_id", type="integer", example=1),
     *              @OA\Property(property="entity_transition_definition_id", type="integer", example=1),
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
        $model = EntityTransition::findOrFail($id);

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'entity_id' => 'required|exists:mst_entity,id',
            'entity_transition_definition_id' => 'required|exists:def_entity_transition,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/entity-transition/{id}",
     *      operationId="deleteEntityTransition",
     *      tags={"EntityTransition"},
     *      summary="Delete existing EntityTransition",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="EntityTransition id",
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
        EntityTransition::destroy($id);
        return response()->json(null, 204);
    }
}
