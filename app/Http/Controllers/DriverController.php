<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Driver",
 *     description="API Endpoints of Driver"
 * )
 */
class DriverController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/driver",
     *      operationId="getDriverList",
     *      tags={"Driver"},
     *      summary="Get list of Driver",
     *      description="Returns list of Driver",
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
        return Driver::all();
    }

    /**
     * @OA\Post(
     *      path="/api/driver",
     *      operationId="storeDriver",
     *      tags={"Driver"},
     *      summary="Store new Driver",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"license_number"},
     *              @OA\Property(property="license_number", type="string", example="DL123456"),
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
            'license_number' => 'required|string|max:255',
            'license_expiry' => 'nullable|date',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        return Driver::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/driver/{id}",
     *      operationId="getDriverById",
     *      tags={"Driver"},
     *      summary="Get information about Driver",
     *      description="Returns Driver data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Driver id",
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
        return Driver::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/driver/{id}",
     *      operationId="updateDriver",
     *      tags={"Driver"},
     *      summary="Update existing Driver",
     *      description="Returns updated Driver data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Driver id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"license_number"},
     *              @OA\Property(property="license_number", type="string", example="DL123456"),
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
        $model = Driver::findOrFail($id);

        $validated = $request->validate([
            'license_number' => 'required|string|max:255',
            'license_expiry' => 'nullable|date',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/driver/{id}",
     *      operationId="deleteDriver",
     *      tags={"Driver"},
     *      summary="Delete existing Driver",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Driver id",
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
        Driver::destroy($id);
        return response()->json(null, 204);
    }
}
