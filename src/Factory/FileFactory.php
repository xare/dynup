<?php 

namespace App\Factory;

use App\Entity\Files;

class FileFactory
{
  public function createFileFromSpecification(string $specification): Files {
    $fileName = 'File-' . random_int(1, 99999);
    $size = $this->getSizeFromSpecification($specification);
    $isImage = false;
    $isPrivate = false;
    if (stripos($specification, 'image') !== false){
      $isImage = true;
    }
    if (stripos($specification, 'private') !== false){
      $isPrivate = true;
    }
    return $this->createFile($fileName, $isImage, $size, $isPrivate);
}
  private function createFile(string $name, bool $isImage, int $size, bool $isPrivate)
  {
    $file = new Files();
    
    $file->setIsImage($isImage);
    $file->setIsPrivate($isPrivate);
    $file->setName($name);
    $file->setSize($size);

    return $file;
  }

  private function getSizeFromSpecification(string $specification): int
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
  public function createInforme(int $size)
  {
    $file = new Files();
    
    $file->setName('Informe');
    $file->setSize($size);

    return $file;
  }

  
  
  
}