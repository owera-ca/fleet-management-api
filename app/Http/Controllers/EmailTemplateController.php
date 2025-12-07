<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="EmailTemplate",
 *     description="API Endpoints of EmailTemplate"
 * )
 */
class EmailTemplateController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/email-template",
     *      operationId="getEmailTemplateList",
     *      tags={"EmailTemplate"},
     *      summary="Get list of EmailTemplate",
     *      description="Returns list of EmailTemplate",
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
        return EmailTemplate::all();
    }

    /**
     * @OA\Post(
     *      path="/api/email-template",
     *      operationId="storeEmailTemplate",
     *      tags={"EmailTemplate"},
     *      summary="Store new EmailTemplate",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"subject_line"},
     *              @OA\Property(property="subject_line", type="string", example="Welcome"),
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
            'subject_line' => 'nullable|string',
            'subject_params' => 'nullable|string',
            'body_text' => 'nullable|string',
            'body_params' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
        ]);

        return EmailTemplate::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/email-template/{id}",
     *      operationId="getEmailTemplateById",
     *      tags={"EmailTemplate"},
     *      summary="Get information about EmailTemplate",
     *      description="Returns EmailTemplate data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EmailTemplate id",
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
        return EmailTemplate::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/email-template/{id}",
     *      operationId="updateEmailTemplate",
     *      tags={"EmailTemplate"},
     *      summary="Update existing EmailTemplate",
     *      description="Returns updated EmailTemplate data",
     *      @OA\Parameter(
     *          name="id",
     *          description="EmailTemplate id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"subject_line"},
     *              @OA\Property(property="subject_line", type="string", example="Welcome"),
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
        $model = EmailTemplate::findOrFail($id);

        $validated = $request->validate([
            'subject_line' => 'nullable|string',
            'subject_params' => 'nullable|string',
            'body_text' => 'nullable|string',
            'body_params' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/email-template/{id}",
     *      operationId="deleteEmailTemplate",
     *      tags={"EmailTemplate"},
     *      summary="Delete existing EmailTemplate",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="EmailTemplate id",
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
        EmailTemplate::destroy($id);
        return response()->json(null, 204);
    }
}
