<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Document",
 *     description="API Endpoints of Document"
 * )
 */
class DocumentController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/document",
     *      operationId="getDocumentList",
     *      tags={"Document"},
     *      summary="Get list of Document",
     *      description="Returns list of Document",
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
        return Document::all();
    }

    /**
     * @OA\Post(
     *      path="/api/document",
     *      operationId="storeDocument",
     *      tags={"Document"},
     *      summary="Store new Document",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Contract.pdf"),
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
            'url' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'document_type_id' => 'nullable|exists:mst_document,id',
        ]);

        return Document::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/document/{id}",
     *      operationId="getDocumentById",
     *      tags={"Document"},
     *      summary="Get information about Document",
     *      description="Returns Document data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Document id",
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
        return Document::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/document/{id}",
     *      operationId="updateDocument",
     *      tags={"Document"},
     *      summary="Update existing Document",
     *      description="Returns updated Document data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Document id",
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
     *              @OA\Property(property="name", type="string", example="Contract.pdf"),
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
        $model = Document::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'document_type_id' => 'nullable|exists:mst_document,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/document/{id}",
     *      operationId="deleteDocument",
     *      tags={"Document"},
     *      summary="Delete existing Document",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Document id",
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
        Document::destroy($id);
        return response()->json(null, 204);
    }
}
