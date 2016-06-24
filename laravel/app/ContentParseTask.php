<?php
/**
 * @file
 */

namespace App;

use GuzzleHttp\Client;

class ContentParseTask {

  public static function run() {
    $contents = Content::where('is_parsed', 0)
      ->orderBy('created_at', 'desc')
      ->take(10)
      ->get();

    foreach ($contents as $content) {
      $keywordScores = self::parse($content->url);
      foreach ($keywordScores as $keywordScore) {
        $score = new Score();
        $score->content_id = $content->id;
        $score->keyword = $keywordScore->keyword;
        $score->weight = $keywordScore->weight;
        $score->save();
      }

      $content->is_parsed = TRUE;
      $content->save();
    }
  }

  /**
   * @param $url
   * @return ScoreResponseParam[]
   */
  public static function parse($url) {
    // @todo replace once G is ready.
    $result = [];
    try {
      $client = new Client();
      $response = $client->request('POST', 'http://edcc3ece.ngrok.io/', ['form_params' => ['url' => $url]]);
      $body = (string) $response->getBody();

      $json = \GuzzleHttp\json_decode($body);
      foreach ($json as $keyword) {
        $result[] = new ScoreResponseParam($keyword, 1);
      }
    }
    catch (\Exception $e) { }
    return $result;
  }


}
