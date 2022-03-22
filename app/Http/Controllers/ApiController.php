<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    const TYPE = 'oneshot';
    const KEY = '$2y$10$C7juB5QJ.oLLJXb9rbyjYOHlfqPBAkpAk9aDNHQ2M5FpbEkw8LSD.';

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function apiYourtext(Request $request)
    {
        $endpoint = "https://yourtext.guru/api/guide?"
            . "query=" . $request->queryText
            . "&lang=" . $request->country
            . "&type=" . self::TYPE;

        $response = Http::withHeaders([
            'key' => self::KEY,
        ])->post($endpoint);

        $data = json_decode($response->getBody(), true);
        $guideId = $data["guide_id"];

        for ($i = 0; ; $i++) {
            sleep(20);
            $data = $this->checkGuid((int)$guideId);
            if (!array_key_exists("errors", $data)) {
                break;
            }
            if ($i == 20) {
                throw new \Error("data not found");
            }
        }

        return view('statistics', ['data' => $data]);
    }

    /**
     * @return Application|Factory|View
     */
    public function sendText()
    {
        return view('sendData');
    }

    /**
     * @param int $guidId
     * @return mixed
     */
    private function checkGuid(int $guidId)
    {
        $endpoint = "https://yourtext.guru/api/check/" . $guidId;
        $response = Http::withHeaders([
            'key' => self::KEY,
        ])->post($endpoint, [
            'content' => 'hello'
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data->status) && $data->status === "ok") {
            return $data;
        }

        return $data;
    }
}
