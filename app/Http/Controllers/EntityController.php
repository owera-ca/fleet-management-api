<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Entity",
 *     description="API Endpoints of Entity"
 * )
 */
class EntityController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/entity",
     *      operationId="getEntityList",
     *      tags={"Entity"},
     *      summary="Get list of Entity",
     *      description="Returns list of Entity",
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
        return Entity::all();
    }

    /**
     * @OA\Post(
     *      path="/api/entity",
     *      operationId="storeEntity",
     *      tags={"Entity"},
     *      summary="Store new Entity",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Carrier"),
     *              @OA\Property(property="code", type="string", example="CARRIER"),
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
            'code' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'table' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
        ]);

        return Entity::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/entity/{id}",
     *      operationId="getEntityById",
     *      tags={"Entity"},
     *      summary="Get information about Entity",
     *      description="Returns Entity data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Entity id",
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
        return Entity::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/entity/{id}",
     *      operationId="updateEntity",
     *      tags={"Entity"},
     *      summary="Update existing Entity",
     *      description="Returns updated Entity data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Entity id",
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
     *              @OA\Property(property="name", type="string", example="Carrier"),
     *              @OA\Property(property="code", type="string", example="CARRIER"),
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
        $model = Entity::findOrFail($id);

        $validated = $request->validate([
            'code' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'table' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/entity/{id}",
     *      operationId="deleteEntity",
     *      tags={"Entity"},
     *      summary="Delete existing Entity",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Entity id",
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
        Entity::destroy($id);
        return response()->json(null, 204);
    }
}
