<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Address",
 *     description="API Endpoints of Address"
 * )
 */
class AddressController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/address",
     *      operationId="getAddressList",
     *      tags={"Address"},
     *      summary="Get list of Address",
     *      description="Returns list of Address",
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
        return Address::all();
    }

    /**
     * @OA\Post(
     *      path="/api/address",
     *      operationId="storeAddress",
     *      tags={"Address"},
     *      summary="Store new Address",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"addr1"},
     *              @OA\Property(property="addr1", type="string", example="123 Main St"),
     *              @OA\Property(property="city", type="string", example="New York"),
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
            'f_name' => 'nullable|string|max:255',
            'l_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'alt_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'alt_phone' => 'nullable|string|max:255',
            'addr1' => 'nullable|string|max:255',
            'addr2' => 'nullable|string|max:255',
            'postal_zip' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'country_id' => 'nullable|exists:mst_country,id',
            'province_state_id' => 'nullable|exists:mst_province,id',
        ]);

        return Address::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/address/{id}",
     *      operationId="getAddressById",
     *      tags={"Address"},
     *      summary="Get information about Address",
     *      description="Returns Address data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Address id",
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
        return Address::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/address/{id}",
     *      operationId="updateAddress",
     *      tags={"Address"},
     *      summary="Update existing Address",
     *      description="Returns updated Address data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Address id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"addr1"},
     *              @OA\Property(property="addr1", type="string", example="123 Main St"),
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
        $model = Address::findOrFail($id);

        $validated = $request->validate([
            'f_name' => 'nullable|string|max:255',
            'l_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'alt_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'alt_phone' => 'nullable|string|max:255',
            'addr1' => 'nullable|string|max:255',
            'addr2' => 'nullable|string|max:255',
            'postal_zip' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'country_id' => 'nullable|exists:mst_country,id',
            'province_state_id' => 'nullable|exists:mst_province,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/address/{id}",
     *      operationId="deleteAddress",
     *      tags={"Address"},
     *      summary="Delete existing Address",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Address id",
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
        Address::destroy($id);
        return response()->json(null, 204);
    }
}
