<?php
/**
 * @file
 */

namespace App;

use GuzzleHttp\Client;

class FeedParseTask {

  public static function run() {
    $feeds = Feed::get();
    foreach ($feeds as $feed) {
      $client = new Client();
      $response = $client->get($feed->url);
      $body = (string) $response->getBody();

      $xml = simplexml_load_string($body);
      foreach ($xml->channel->item as $item) {
        $link = (string) $item->link;

        $content = Content::where('url', $link)->first();

        if (!$content) {
          $content = new Content();
          $content->feed_id = $feed->id;
          $content->url = $link;
          $content->is_parsed = FALSE;
          $content->save();
        }
      }
    }
  }

}
