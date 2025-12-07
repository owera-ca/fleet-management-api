<?php

namespace App\Http\Controllers;

use App\Models\SmsTemplate;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="SmsTemplate",
 *     description="API Endpoints of SmsTemplate"
 * )
 */
class SmsTemplateController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/sms-template",
     *      operationId="getSmsTemplateList",
     *      tags={"SmsTemplate"},
     *      summary="Get list of SmsTemplate",
     *      description="Returns list of SmsTemplate",
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
        return SmsTemplate::all();
    }

    /**
     * @OA\Post(
     *      path="/api/sms-template",
     *      operationId="storeSmsTemplate",
     *      tags={"SmsTemplate"},
     *      summary="Store new SmsTemplate",
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
            'sms_body_params' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
        ]);

        return SmsTemplate::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/sms-template/{id}",
     *      operationId="getSmsTemplateById",
     *      tags={"SmsTemplate"},
     *      summary="Get information about SmsTemplate",
     *      description="Returns SmsTemplate data",
     *      @OA\Parameter(
     *          name="id",
     *          description="SmsTemplate id",
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
        return SmsTemplate::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/sms-template/{id}",
     *      operationId="updateSmsTemplate",
     *      tags={"SmsTemplate"},
     *      summary="Update existing SmsTemplate",
     *      description="Returns updated SmsTemplate data",
     *      @OA\Parameter(
     *          name="id",
     *          description="SmsTemplate id",
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
        $model = SmsTemplate::findOrFail($id);

        $validated = $request->validate([
            'sms_body_text' => 'nullable|string',
            'sms_body_params' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/sms-template/{id}",
     *      operationId="deleteSmsTemplate",
     *      tags={"SmsTemplate"},
     *      summary="Delete existing SmsTemplate",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="SmsTemplate id",
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
        SmsTemplate::destroy($id);
        return response()->json(null, 204);
    }
}
