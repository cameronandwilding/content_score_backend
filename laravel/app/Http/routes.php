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

Route::get('/', function () {
    return redirect('/api/v1/feed');
});

Route::get('/api/v1/feed', function () {
    $feeds = \App\Feed::orderBy('created_at', 'asc')->get();

    return new \Illuminate\Http\JsonResponse(['feeds' => $feeds]);
});

Route::post('/api/v1/feed', function (\Illuminate\Http\Request $request) {
    $feed = new \App\Feed();
    $feed->url = $request->get('url');
    $feed->updated_at = 0;
    $feed->save();

    return redirect('/');
});

Route::get('/api/v1/search/{keyword}', function ($keyword) {
    $scores = \App\Score::where('keyword', $keyword)
      ->orderBy('weight')
      ->take(10)
      ->get();

    $result = [];
    foreach ($scores as $score) {
        $content = \App\Content::find($score->content_id);
        $result[] = (object) [
          'url' => $content->url,
        ];
    }

    return new \Illuminate\Http\JsonResponse(['result' => $result]);
});

Route::get('/api/v1/content/{id}', function ($id) {
    return new \Illuminate\Http\JsonResponse(['result' => []]);
});

Route::get('/cron', function () {
    \App\FeedParseTask::run();
    \App\ContentParseTask::run();
    return new \Illuminate\Http\Response('ok');
});
