<?php

namespace Tests\Unit\Http\Controller\API\Auth;

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;


class AuthTest extends TestCase
{

    use JsonResponseTrait;

    private $authController;

    private $userRepository;

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

        $response = $this->withHeaders([
            'X-LOCALIZATION' => 'vi',
        ])->post('/api/auth/login', $loginData);
        $responseData = $response->getData(true);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertTrue($responseData['status']);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'access_token',
                'token_type',
                'expires_in',
                'name',
                'id',
                'role' => [
                    'id',
                    'name'
                ]
            ],
            'code'
        ]);
    }

    public function test_login_with_invalid_credentials_returns_unauthorized()
    {
        $loginData = [
            'email' => fake()->email,
            'password' => '123456',
        ];

        $response = $this->withHeaders([
            'X-LOCALIZATION' => 'vi',
        ])->post('/api/auth/login', $loginData);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson(['data' => __('auth.login.fail')]);
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
