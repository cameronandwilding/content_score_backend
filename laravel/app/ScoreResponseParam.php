<?php
/**
 * @file
 */

namespace App;

class ScoreResponseParam {

  public $keyword;
  public $weight;

  /**
   * ScoreResponseParam constructor.
   *
   * @param string $keyword
   * @param int $weight
   */
  public function __construct($keyword, $weight) {
    $this->keyword = $keyword;
    $this->weight = $weight;
  }

}
