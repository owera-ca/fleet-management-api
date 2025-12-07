<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Email",
 *     description="API Endpoints of Email"
 * )
 */
class EmailController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/email",
     *      operationId="getEmailList",
     *      tags={"Email"},
     *      summary="Get list of Email",
     *      description="Returns list of Email",
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
        return Email::all();
    }

    /**
     * @OA\Post(
     *      path="/api/email",
     *      operationId="storeEmail",
     *      tags={"Email"},
     *      summary="Store new Email",
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
            'body_text' => 'nullable|string',
            'sender' => 'nullable|string',
            'recipient' => 'nullable|string',
            'cc' => 'nullable|string',
            'bcc' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'email_template_id' => 'nullable|exists:mst_email_template,id',
        ]);

        return Email::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/email/{id}",
     *      operationId="getEmailById",
     *      tags={"Email"},
     *      summary="Get information about Email",
     *      description="Returns Email data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Email id",
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
        return Email::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/email/{id}",
     *      operationId="updateEmail",
     *      tags={"Email"},
     *      summary="Update existing Email",
     *      description="Returns updated Email data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Email id",
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
        $model = Email::findOrFail($id);

        $validated = $request->validate([
            'subject_line' => 'nullable|string',
            'body_text' => 'nullable|string',
            'sender' => 'nullable|string',
            'recipient' => 'nullable|string',
            'cc' => 'nullable|string',
            'bcc' => 'nullable|string',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'email_template_id' => 'nullable|exists:mst_email_template,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/email/{id}",
     *      operationId="deleteEmail",
     *      tags={"Email"},
     *      summary="Delete existing Email",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Email id",
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
        Email::destroy($id);
        return response()->json(null, 204);
    }
}
