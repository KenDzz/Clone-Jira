<?php

namespace Tests\Unit\Trait;

use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;

class JsonResponseTraitTest extends TestCase
{
    use JsonResponseTrait;

    public function test_json_response_trait_returns_success()
    {
        $data = ['example_data'];
        $status = Response::HTTP_OK;
        $success = true;
        $response = $this->result($data, $status, $success);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $responseData = $response->getData(true);
        $this->assertEquals($success, $responseData['status']);
        $this->assertEquals($data, $responseData['data']);
        $this->assertEquals($status, $response->getStatusCode());
    }

    public function test_json_response_trait_returns_fail_auth()
    {
        $data = ['example_data'];
        $status = Response::HTTP_UNAUTHORIZED;
        $success = false;
        $response = $this->result($data, $status, $success);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $responseData = $response->getData(true);
        $this->assertEquals($success, $responseData['status']);
        $this->assertEquals($data, $responseData['data']);
        $this->assertEquals($status, $response->getStatusCode());
    }
}
