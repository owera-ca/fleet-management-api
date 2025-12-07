<?php

namespace App\Http\Controllers;

use App\Models\OrgNode;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="OrgNode",
 *     description="API Endpoints of OrgNode"
 * )
 */
class OrgNodeController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/org-node",
     *      operationId="getOrgNodeList",
     *      tags={"OrgNode"},
     *      summary="Get list of OrgNode",
     *      description="Returns list of OrgNode",
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
        return OrgNode::all();
    }

    /**
     * @OA\Post(
     *      path="/api/org-node",
     *      operationId="storeOrgNode",
     *      tags={"OrgNode"},
     *      summary="Store new OrgNode",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Headquarters"),
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
            'parent_id' => 'nullable|exists:mst_orgnode,id',
        ]);

        return OrgNode::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/org-node/{id}",
     *      operationId="getOrgNodeById",
     *      tags={"OrgNode"},
     *      summary="Get information about OrgNode",
     *      description="Returns OrgNode data",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrgNode id",
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
        return OrgNode::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/org-node/{id}",
     *      operationId="updateOrgNode",
     *      tags={"OrgNode"},
     *      summary="Update existing OrgNode",
     *      description="Returns updated OrgNode data",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrgNode id",
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
     *              @OA\Property(property="name", type="string", example="Headquarters"),
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
        $model = OrgNode::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'parent_id' => 'nullable|exists:mst_orgnode,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/org-node/{id}",
     *      operationId="deleteOrgNode",
     *      tags={"OrgNode"},
     *      summary="Delete existing OrgNode",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrgNode id",
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
        OrgNode::destroy($id);
        return response()->json(null, 204);
    }
}
