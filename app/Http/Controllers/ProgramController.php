<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Program",
 *     description="API Endpoints of Program"
 * )
 */
class ProgramController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/program",
     *      operationId="getProgramList",
     *      tags={"Program"},
     *      summary="Get list of Program",
     *      description="Returns list of Program",
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
        return Program::all();
    }

    /**
     * @OA\Post(
     *      path="/api/program",
     *      operationId="storeProgram",
     *      tags={"Program"},
     *      summary="Store new Program",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Fleet Program A"),
     *              @OA\Property(property="code", type="string", example="FPA"),
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
            'code' => 'nullable|string|max:255',
            'company_address_id' => 'nullable|exists:tbl_address,id',
            'representative_address_id' => 'nullable|exists:tbl_address,id',
        ]);

        return Program::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/program/{id}",
     *      operationId="getProgramById",
     *      tags={"Program"},
     *      summary="Get information about Program",
     *      description="Returns Program data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Program id",
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
        return Program::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/program/{id}",
     *      operationId="updateProgram",
     *      tags={"Program"},
     *      summary="Update existing Program",
     *      description="Returns updated Program data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Program id",
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
     *              @OA\Property(property="name", type="string", example="Fleet Program A"),
     *              @OA\Property(property="code", type="string", example="FPA"),
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
        $model = Program::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
            'company_address_id' => 'nullable|exists:tbl_address,id',
            'representative_address_id' => 'nullable|exists:tbl_address,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/program/{id}",
     *      operationId="deleteProgram",
     *      tags={"Program"},
     *      summary="Delete existing Program",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Program id",
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
        Program::destroy($id);
        return response()->json(null, 204);
    }
}
