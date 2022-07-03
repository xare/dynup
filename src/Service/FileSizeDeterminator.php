<?php

namespace App\Service;

use App\Entity\Files;

class FileSizeDeterminator 
{
  public function getSizeFromSpecification(string $specification): int
  {
    $availableSizes = [
      'huge' => ['min' => Files::HUGE, 'max' => 20000],
      'omg' =>  ['min' => Files::HUGE, 'max' => 20000],
      '?' => ['min' => Files::HUGE, 'max' => 20000],
      'large' => ['min' => Files::LARGE, 'max' => Files::HUGE - 1]
    ];
    $minSize = 1;
    $maxSize = Files::LARGE - 1;

    foreach ( explode(' ', $specification) as $keyword ) {
      $keyword = strtolower($keyword);
      if(array_key_exists($keyword, $availableSizes)){
        $minSize = $availableSizes[$keyword]['min'];
        $maxSize = $availableSizes[$keyword]['max'];
        break;
      }
    }
    return random_int( $minSize , $maxSize );
  }
}