<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    use JsonResponseTrait;

    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface) {
        $this->categoryRepository = $categoryRepositoryInterface;
        $this->middleware('auth:api', ['except' => []]);
    }


        /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
            /**
     * @OA\Get(
     *     path="/category/",
     *     tags={"category"},
     *     summary="Get Info category",
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
    public function GetCategoryInfo() {
        return $this->result(CategoryResource::collection($this->categoryRepository->getAll()),Response::HTTP_OK, true);
    }
}
