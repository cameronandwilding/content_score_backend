<?php
/**
 * @file
 */

namespace App;

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
    return [
      new ScoreResponseParam('foo', 3),
      new ScoreResponseParam('bar', 8),
    ];
  }


}
