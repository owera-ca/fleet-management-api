<?php

namespace App\Http\Controllers;

use App\Models\Messaging;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Messaging",
 *     description="API Endpoints of Messaging"
 * )
 */
class MessagingController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/messaging",
     *      operationId="getMessagingList",
     *      tags={"Messaging"},
     *      summary="Get list of Messaging",
     *      description="Returns list of Messaging",
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
        return Messaging::all();
    }

    /**
     * @OA\Post(
     *      path="/api/messaging",
     *      operationId="storeMessaging",
     *      tags={"Messaging"},
     *      summary="Store new Messaging",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"message"},
     *              @OA\Property(property="message", type="string", example="Hello"),
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
            'message' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'sender_id' => 'nullable|exists:users,id',
            'recipient_id' => 'nullable|exists:users,id',
        ]);

        return Messaging::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/messaging/{id}",
     *      operationId="getMessagingById",
     *      tags={"Messaging"},
     *      summary="Get information about Messaging",
     *      description="Returns Messaging data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Messaging id",
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
        return Messaging::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/messaging/{id}",
     *      operationId="updateMessaging",
     *      tags={"Messaging"},
     *      summary="Update existing Messaging",
     *      description="Returns updated Messaging data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Messaging id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"message"},
     *              @OA\Property(property="message", type="string", example="Hello"),
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
        $model = Messaging::findOrFail($id);

        $validated = $request->validate([
            'message' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'sender_id' => 'nullable|exists:users,id',
            'recipient_id' => 'nullable|exists:users,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/messaging/{id}",
     *      operationId="deleteMessaging",
     *      tags={"Messaging"},
     *      summary="Delete existing Messaging",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Messaging id",
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
        Messaging::destroy($id);
        return response()->json(null, 204);
    }
}
