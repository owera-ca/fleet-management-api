<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Dispatch",
 *     description="API Endpoints of Dispatch"
 * )
 */
class DispatchController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/dispatch",
     *      operationId="getDispatchList",
     *      tags={"Dispatch"},
     *      summary="Get list of Dispatch",
     *      description="Returns list of Dispatch",
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
        return Dispatch::all();
    }

    /**
     * @OA\Post(
     *      path="/api/dispatch",
     *      operationId="storeDispatch",
     *      tags={"Dispatch"},
     *      summary="Store new Dispatch",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Dispatch 1"),
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
            'user_id' => 'nullable|exists:users,id',
        ]);

        return Dispatch::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/dispatch/{id}",
     *      operationId="getDispatchById",
     *      tags={"Dispatch"},
     *      summary="Get information about Dispatch",
     *      description="Returns Dispatch data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Dispatch id",
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
        return Dispatch::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/dispatch/{id}",
     *      operationId="updateDispatch",
     *      tags={"Dispatch"},
     *      summary="Update existing Dispatch",
     *      description="Returns updated Dispatch data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Dispatch id",
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
     *              @OA\Property(property="name", type="string", example="Dispatch 1"),
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
        $model = Dispatch::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/dispatch/{id}",
     *      operationId="deleteDispatch",
     *      tags={"Dispatch"},
     *      summary="Delete existing Dispatch",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Dispatch id",
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
        Dispatch::destroy($id);
        return response()->json(null, 204);
    }
}
