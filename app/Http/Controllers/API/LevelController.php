<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;
use App\Repositories\Interfaces\LevelRepositoryInterface;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LevelController extends Controller
{
    use JsonResponseTrait;

    private $levelRepository;

    public function __construct(LevelRepositoryInterface $levelRepositoryInterface) {
        $this->levelRepository = $levelRepositoryInterface;
        $this->middleware('auth:api', ['except' => []]);

    }

            /**
     * @OA\Get(
     *     path="/levels",
     *     tags={"level"},
     *     summary="Get Info level",
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
    public function index() {
        return $this->result(LevelResource::collection($this->levelRepository->getAll()), true);
    }
}
