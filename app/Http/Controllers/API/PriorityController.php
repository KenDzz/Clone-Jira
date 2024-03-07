<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PriorityResource;
use App\Repositories\Interfaces\PriorityRepositoryInterface;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PriorityController extends Controller
{

    use JsonResponseTrait;

    private $priorityRepositorys;

    public function __construct(PriorityRepositoryInterface $priorityRepositoryInterface) {
        $this->priorityRepositorys = $priorityRepositoryInterface;
        $this->middleware('auth:api', ['except' => []]);

    }

     /**
     * @OA\Get(
     *     path="/priority/",
     *     tags={"priority"},
     *     summary="Get Info priority",
     *     @OA\Parameter(
     *         name="X-localization",
     *         in="header",
     *         description="Set language parameter (Example: 'vi' or 'en'))",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function GetPriorityInfo() {
        return $this->result(PriorityResource::collection($this->priorityRepositorys->getAll()),Response::HTTP_OK, true);
    }
}
