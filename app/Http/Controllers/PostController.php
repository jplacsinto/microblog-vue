<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Business logic for the post
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
class PostController extends Controller
{
    const PAGE_LIMIT = 10;

    /**
     * holds the model object
     * @var object
     */
    private $oModel;

    /**
     * main constructor
     * @param PostRepositoryInterface $oModel  - model repository
     */
    public function __construct(PostRepositoryInterface $oModel)
    {
        $this->oModel = $oModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $oRequest
     *
     * App\Http\Resources\PostResource
     */
    public function index(Request $oRequest)
    {
        $iLimit = $oRequest->get('limit', self::PAGE_LIMIT);
        $oCollection = $this->oModel;
        if ($oRequest->has('author') === true) {
            $oCollection = $oCollection->where('user_id', $oRequest->author);
        }
        $oCollection = $oCollection->with('author')
            ->orderBy('created_at', 'desc')
            ->paginate($iLimit);

        return PostResource::collection($oCollection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $oRequest
     * @return \App\Http\Resources\PostResource
     */
    public function store(Request $oRequest)
    {
        $oModel = $this->oModel->create($oRequest->all());

        return (new PostResource($oModel))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $iId
     * @return \App\Http\Resources\PostResource
     */
    public function show(int $iId)
    {
        $oModel = $this->oModel->with('author')
            ->getById($iId);

        return new PostResource($oModel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $oRequest
     * @param  int  $iId
     * @return \App\Http\Resources\PostResource
     */
    public function update(Request $oRequest, int $iId)
    {
        $oModel = $this->oModel->updateById($iId, $oRequest->all());

        return (new PostResource($oModel))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $iId
     * @return \App\Http\Resources\PostResource
     */
    public function destroy($iId)
    {
        $this->oModel->deleteById($iId);

        return response()->json([
            "message" => "Deleted successfully"
        ], 200);
    }
}
