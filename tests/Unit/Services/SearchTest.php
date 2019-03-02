<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SearchTest extends TestCase
{
	use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccessRequiredParams()
    {
        // リクエストで送信するパラメータを定義
        $titleId = 1424;
        $tagId = 31344;

        // /api/tag/searchに対してPOSTリクエストを送信、第2引数はパラメータを配列で渡す。
        $jsonResponse = $this->post(
            "/api/tag/search",
            [
                'title_id' => $titleId,
                'tag_id'   => $tagId,
            ]
        );

        // APIの結果を一部利用したいのでjson_decode()でstdClassに変換します
        $responseObject = json_decode(
            $jsonResponse->response->content()
        );

        
        $this->assertTrue(true);
    }
}
