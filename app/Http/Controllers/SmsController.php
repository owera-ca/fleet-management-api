<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Sms",
 *     description="API Endpoints of Sms"
 * )
 */
class SmsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/sms",
     *      operationId="getSmsList",
     *      tags={"Sms"},
     *      summary="Get list of Sms",
     *      description="Returns list of Sms",
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
        return Sms::all();
    }

    /**
     * @OA\Post(
     *      path="/api/sms",
     *      operationId="storeSms",
     *      tags={"Sms"},
     *      summary="Store new Sms",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"sms_body_text"},
     *              @OA\Property(property="sms_body_text", type="string", example="Hello World"),
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
            'sms_body_text' => 'nullable|string',
            'sender' => 'nullable|string',
            'recipient' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'sms_template_id' => 'nullable|exists:mst_sms_template,id',
        ]);

        return Sms::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/sms/{id}",
     *      operationId="getSmsById",
     *      tags={"Sms"},
     *      summary="Get information about Sms",
     *      description="Returns Sms data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Sms id",
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
        return Sms::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/sms/{id}",
     *      operationId="updateSms",
     *      tags={"Sms"},
     *      summary="Update existing Sms",
     *      description="Returns updated Sms data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Sms id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"sms_body_text"},
     *              @OA\Property(property="sms_body_text", type="string", example="Hello World"),
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
        $model = Sms::findOrFail($id);

        $validated = $request->validate([
            'sms_body_text' => 'nullable|string',
            'sender' => 'nullable|string',
            'recipient' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'sms_template_id' => 'nullable|exists:mst_sms_template,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/sms/{id}",
     *      operationId="deleteSms",
     *      tags={"Sms"},
     *      summary="Delete existing Sms",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Sms id",
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
        Sms::destroy($id);
        return response()->json(null, 204);
    }
}
