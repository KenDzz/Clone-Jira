<?php

namespace Tests\Unit\Trait;

use App\Traits\JsonImageUploadResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;

class JsonImageUploadResponseTraitTest extends TestCase
{

    use JsonImageUploadResponseTrait;

    public function test_json_response_trait_returns_susscess()
    {
        $fileName = fake()->regexify('[A-Za-z0-9]{' . mt_rand(4, 20) . '}') . ".jpg";
        $url = "kendzz/hi/" . $fileName;
        $status = Response::HTTP_OK;
        $statusUpload = 1;
        $response = $this->result($fileName, $statusUpload, $url, $status);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $responseData = $response->getData(true);
        $this->assertEquals($fileName, $responseData['fileName']);
        $this->assertEquals($statusUpload, $responseData['uploaded']);
        $this->assertEquals($url, $responseData['url']);
        $this->assertEquals($status, $response->getStatusCode());
    }
}
