<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="DocumentType",
 *     description="API Endpoints of DocumentType"
 * )
 */
class DocumentTypeController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/document-type",
     *      operationId="getDocumentTypeList",
     *      tags={"DocumentType"},
     *      summary="Get list of DocumentType",
     *      description="Returns list of DocumentType",
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
        return DocumentType::all();
    }

    /**
     * @OA\Post(
     *      path="/api/document-type",
     *      operationId="storeDocumentType",
     *      tags={"DocumentType"},
     *      summary="Store new DocumentType",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Invoice"),
     *              @OA\Property(property="code", type="string", example="INV"),
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
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
        ]);

        return DocumentType::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/document-type/{id}",
     *      operationId="getDocumentTypeById",
     *      tags={"DocumentType"},
     *      summary="Get information about DocumentType",
     *      description="Returns DocumentType data",
     *      @OA\Parameter(
     *          name="id",
     *          description="DocumentType id",
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
        return DocumentType::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/document-type/{id}",
     *      operationId="updateDocumentType",
     *      tags={"DocumentType"},
     *      summary="Update existing DocumentType",
     *      description="Returns updated DocumentType data",
     *      @OA\Parameter(
     *          name="id",
     *          description="DocumentType id",
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
     *              @OA\Property(property="name", type="string", example="Invoice"),
     *              @OA\Property(property="code", type="string", example="INV"),
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
        $model = DocumentType::findOrFail($id);

        $validated = $request->validate([
            'code' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/document-type/{id}",
     *      operationId="deleteDocumentType",
     *      tags={"DocumentType"},
     *      summary="Delete existing DocumentType",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="DocumentType id",
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
        DocumentType::destroy($id);
        return response()->json(null, 204);
    }
}
