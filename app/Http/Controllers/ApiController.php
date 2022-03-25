<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    const TYPE = 'premium';
    const KEY = '$2y$10$C7juB5QJ.oLLJXb9rbyjYOHlfqPBAkpAk9aDNHQ2M5FpbEkw8LSD.';

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
            sleep(10);
            $data = $this->checkGuid((int)$guideId);
            if (!array_key_exists("errors", $data)) {
                break;
            }
            if ($i == 20) {
                throw new \Error("data not found");
            }
        }

        return redirect()->route('send-content',['id' => $guideId]);
    }

    /**
     * @return Application|Factory|View
     */
    public function sendText()
    {
        return view('sendData');
    }

    /**
     * @return Application|Factory|View
     */
    public function sendContent(Request $request, int $guideId)
    {
        if ($request->method() === "POST") {
            $contentText = $request->contentText;
            $data = $this->checkGuid($guideId, $contentText);
            return view('statistics', ['data' => $data]);
        }
        return view('sendContent');
    }

    /**
     * @param int $guidId
     * @param null $contentText
     * @return mixed
     */
    private function checkGuid(int $guidId, $contentText = null)
    {
        $endpoint = "https://yourtext.guru/api/check/" . $guidId;
        $response = Http::withHeaders([
            'key' => self::KEY,
        ])->post($endpoint, [
            'content' => is_null($contentText) ? 'hello' : $contentText
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data->status) && $data->status === "ok") {
            return $data;
        }

        return $data;
    }
}
