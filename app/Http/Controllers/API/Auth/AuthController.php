<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use JsonResponseTrait;

    private $userRepository;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->userRepository = $user;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"auth"},
     *     summary="Login User",
     *     @OA\Parameter(
     *         name="X-localization",
     *         in="header",
     *         description="Set language parameter (Example: 'vi' or 'en'))",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email": "vvqua.2x@gmail.com", "password": "123456"}
     *             ),
     *
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->all())) {
            return $this->respondUnauthorized(__('auth.login.fail'));
        }

        return $this->result([
            'access_token' => $token,
            'token_type' => 'bearer',
            'name' => auth()->user()->name,
            'id' => auth()->user()->id,
            'role' => auth()->user()->permission,
            'expires_in' => auth()->factory()->getTTL() * 60
        ],  true);
    }


    /**
     * @OA\Post(
     *     path="/auth/register",
     *     tags={"auth"},
     *     summary="Register User",
     *     @OA\Parameter(
     *         name="X-localization",
     *         in="header",
     *         description="Set language parameter (Example: 'vi' or 'en'))",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="permission",
     *                      description="0: Admin , 1: User",
     *                     type="int"
     *                 ),
     *                 example={"name": "KenDzz","email" : "admin@gmail.com", "password": "123456", "permission_id" : "1"}
     *             ),
     *
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function register(RegisterRequest $request) {
        $resultCreateUser = $this->userRepository->createUser($request->all());
        return $this->result($resultCreateUser, true);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
            /**
     * @OA\Get(
     *     path="/auth/me",
     *     tags={"auth"},
     *     summary="Get Info User",
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
    public function me()
    {
        return $this->result(New UserResource(auth()->user()), true);
    }


        /**
     * @OA\Get(
     *     path="/auth/user/normal",
     *     tags={"auth"},
     *     summary="Get User Normal",
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
    public function GetUserNormal()
    {
        return $this->result($this->userRepository->getUserNormal(), true);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
            /**
     * @OA\Get(
     *     path="/auth/logout",
     *     tags={"auth"},
     *     summary="Logout User",
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
    public function logout()
    {

        //auth()->logout();
        return $this->result(__('auth.logout.success'), true);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->result(auth()->refresh(), true);
    }


}
