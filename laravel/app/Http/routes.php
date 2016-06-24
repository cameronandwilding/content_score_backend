<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Content;
use App\ContentParseTask;
use App\Feed;
use App\FeedParseTask;
use App\Score;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

Route::get('/', function () {
    return redirect('/api/v1/feed');
});

Route::get('/api/v1/feed', function () {
    $feeds = Feed::orderBy('created_at', 'asc')->get();

    return new JsonResponse(['feeds' => $feeds]);
});

Route::post('/api/v1/feed', function (Request $request) {
    $feed = new Feed();
    $feed->url = $request->get('url');
    $feed->updated_at = 0;
    $feed->save();

    return redirect('/');
});

Route::get('/api/v1/search/{keyword}/{count?}', function ($keyword, $count = 10) {
    $scores = Score::where('keyword', 'LIKE', '%' . $keyword . '%')
      ->groupBy('content_id')
      ->orderBy('weight')
      ->take($count)
      ->get();

    $result = [];
    foreach ($scores as $score) {
        $content = Content::find($score->content_id);
        $result[] = $content;
    }

    return new JsonResponse(['result' => $result]);
});

Route::get('/api/v1/content/{id}', function ($id) {
    return new JsonResponse(['result' => []]);
});

Route::get('/cron', function () {
    FeedParseTask::run();
    ContentParseTask::run();
    return new Response('ok');
});
