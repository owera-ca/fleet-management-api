<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Event",
 *     description="API Endpoints of Event"
 * )
 */
class EventController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/event",
     *      operationId="getEventList",
     *      tags={"Event"},
     *      summary="Get list of Event",
     *      description="Returns list of Event",
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
        return Event::all();
    }

    /**
     * @OA\Post(
     *      path="/api/event",
     *      operationId="storeEvent",
     *      tags={"Event"},
     *      summary="Store new Event",
     *      description="Returns model data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"event_name"},
     *              @OA\Property(property="event_name", type="string", example="New Order"),
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
            'event_name' => 'nullable|string|max:255',
            'event_code' => 'nullable|string|max:255',
            'roles' => 'nullable|string',
            'send_email' => 'boolean',
            'send_sms' => 'boolean',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'email_template_id' => 'nullable|exists:mst_email_template,id',
            'sms_template_id' => 'nullable|exists:mst_sms_template,id',
        ]);

        return Event::create($validated);
    }

    /**
     * @OA\Get(
     *      path="/api/event/{id}",
     *      operationId="getEventById",
     *      tags={"Event"},
     *      summary="Get information about Event",
     *      description="Returns Event data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Event id",
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
        return Event::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/api/event/{id}",
     *      operationId="updateEvent",
     *      tags={"Event"},
     *      summary="Update existing Event",
     *      description="Returns updated Event data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Event id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"event_name"},
     *              @OA\Property(property="event_name", type="string", example="New Order"),
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
        $model = Event::findOrFail($id);

        $validated = $request->validate([
            'event_name' => 'nullable|string|max:255',
            'event_code' => 'nullable|string|max:255',
            'roles' => 'nullable|string',
            'send_email' => 'boolean',
            'send_sms' => 'boolean',
            'notes' => 'nullable|string',
            'program_id' => 'nullable|exists:mst_program,id',
            'email_template_id' => 'nullable|exists:mst_email_template,id',
            'sms_template_id' => 'nullable|exists:mst_sms_template,id',
        ]);

        $model->update($validated);
        return $model;
    }

    /**
     * @OA\Delete(
     *      path="/api/event/{id}",
     *      operationId="deleteEvent",
     *      tags={"Event"},
     *      summary="Delete existing Event",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Event id",
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
        Event::destroy($id);
        return response()->json(null, 204);
    }
}
