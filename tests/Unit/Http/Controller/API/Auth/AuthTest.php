<?php

namespace Tests\Unit\Http\Controller\API\Auth;

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthTest extends TestCase
{

    use JsonResponseTrait;

    private $authController;

    private $userRepository;

    private $USER_ID_TEST = 2;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = Mockery::mock(UserRepositoryInterface::class);

        $this->authController = new AuthController($this->userRepository);
    }

    public function test_login_success()
    {
        $loginData = [
            'email' => 'vvqua.2x@gmail.com',
            'password' => '123456',
        ];

        $this->userRepository->shouldReceive('attemptLogin')
        ->with($loginData)
        ->once()
        ->andReturn(true);

        $response = $this->authController->login(new LoginRequest($loginData));

        $this->assertInstanceOf(JsonResponse::class, $response);
        $responseData = $response->getData(true);
        $this->assertTrue($responseData['status']);
        $this->assertArrayHasKey('access_token', $responseData['data']);
        $this->assertEquals('bearer', $responseData['data']['token_type']);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function test_login_with_invalid_credentials_returns_unauthorized()
    {

        $loginData = [
            'email' => fake()->email,
            'password' => '123456',
        ];


        $user = Mockery::mock(UserRepositoryInterface::class);
        $user->shouldReceive('attemptLogin')
            ->with($loginData)
            ->once()
            ->andReturn(false);

        $request = new LoginRequest($loginData);

        $controller = new AuthController($user);
        $response = $controller->login($request);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson(['message' => __('auth.login.fail')]);
    }

    public function test_logout_success()
    {
        $user = User::where('email', "vvqua.2x@gmail.com")->first(); //test
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'X-LOCALIZATION' => 'vi',
            'Authorization' => 'Bearer '.  $token ,
        ])->post('/api/auth/logout');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['data' => __('auth.logout.success')]);
    }

    public function test_register_user_normal_returns_success()
    {
        $inputs = [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => fake()->password,
            'permission_id' => 2,
        ];

        $requestRegisterUser = Mockery::mock(RegisterRequest::class);
        $requestRegisterUser->shouldReceive('all')->andReturn($inputs);

        $this->userRepository->shouldReceive('CreateUser')
            ->with($inputs)
            ->andReturn(true);

        $response = $this->authController->register($requestRegisterUser);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $responseData = $response->getData(true);
        $this->assertTrue($responseData['status']);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
