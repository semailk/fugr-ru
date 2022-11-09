<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotebookStoreRequest;
use App\Http\Requests\NotebookUpdateRequest;
use App\Http\Resources\V1\NotebookAllResource;
use App\Http\Resources\V1\NotebookOneResource;
use App\Models\Notebook;
use App\Services\NotebookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MyController extends Controller
{

    /**
     * @var NotebookService
     */
    private NotebookService $notebookService;

    public function __construct(NotebookService $notebookService)
    {
        $this->notebookService = $notebookService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/notebooks",
     *      operationId="getNotebooksList",
     *      tags={"Notebooks"},
     *      summary="Get list of notebooks",
     *      description="Returns list of notebooks",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     )
     */
    public function index(): NotebookAllResource
    {
        $allNotebook = Notebook::all();

        return new NotebookAllResource($allNotebook);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/notebooks/{id}",
     *      operationId="getNotebookShow",
     *      tags={"Notebook Show"},
     *      summary="Get list of notebook",
     *      description="Returns list of notebook",
     *      @OA\Parameter(
     *          name="id",
     *          description="Notebook id",
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
     *     )
     */
    public function show($id): JsonResponse|NotebookOneResource
    {
        $notebook = Notebook::query()->find($id);
        if (empty($notebook)) {
            return response()->json(['errors' => 'Not found given notebook!'], Response::HTTP_BAD_REQUEST);
        }
        return new NotebookOneResource($notebook);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/notebooks",
     *      operationId="storeNotebook",
     *      tags={"Notebook Store"},
     *      summary="Store new notebook",
     *      description="Returns notebook data",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={
     *                      "full_name", "email", "phone"
     *                  },
     *                 @OA\Property(property="full_name", type="string", example="Name"),
     *                 @OA\Property(property="company", type="string", example="Company Name"),
     *                 @OA\Property(property="email", type="email", example="admin@gmail.com"),
     *                 @OA\Property(property="phone", type="string", example="+7979797979"),
     *                 @OA\Property(property="date_of_birth", type="date", example="2022-11-11"),
     *                 @OA\Property(property="photo",type="file",format="string"),
     *             ),
     *          ),
     *      ),
     *  @OA\Response(
     *     response=200,
     *     description="Success",
     *  ),
     *       @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *     )
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->input(), NotebookStoreRequest::rules());

        if ($validator->fails()) {
            return \response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        return \response()->json(new NotebookOneResource($this->notebookService->notebookStoreService($request)), Response::HTTP_CREATED);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/notebooks/{id}",
     *      operationId="updateNotebook",
     *      tags={"Notebook Update"},
     *      summary="Update existing notebook",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  required={
     *                      "full_name", "email", "phone"
     *                  },
     *                 @OA\Property(property="full_name", type="string", example="Name"),
     *                 @OA\Property(property="company", type="string", example="Company Name"),
     *                 @OA\Property(property="email", type="email", example="admin@gmail.com"),
     *                 @OA\Property(property="phone", type="string", example="+7979797979"),
     *                 @OA\Property(property="photo",type="file",format="string"),
     *             ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * )
     */
    public function update($id, Request $request)
    {
        $notebook = Notebook::query()->find($id);
        $validator = Validator::make($request->input(), NotebookUpdateRequest::rules());

        if (empty($notebook)) {
            return response()->json(['errors' => 'Not found given notebook!'], Response::HTTP_BAD_REQUEST);
        }

        if ($validator->fails()) {
            return \response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        return \response()->json(new NotebookOneResource($this->notebookService->notebookUpdateService($notebook, $request)), Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/notebooks/{id}",
     *      operationId="getNotebookDelete",
     *      tags={"Notebook Delete"},
     *      summary="Delete list of notebook",
     *      description="Delete of notebook",
     *      @OA\Parameter(
     *          name="id",
     *          description="Notebook id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     )
     */
    public function delete($id)
    {
        $notebook = Notebook::query()->find($id);

        if (empty($notebook)) {
            return response()->json(['errors' => 'Not found given notebook!'], Response::HTTP_BAD_REQUEST);
        }

        $notebook->delete();

        return \response()->json(['success' => 'Notebook deleted!'], Response::HTTP_OK);
    }
}
