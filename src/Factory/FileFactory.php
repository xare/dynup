<?php 

namespace App\Factory;

use App\Entity\Files;

class FileFactory
{
  public function createFileFromSpecification(string $specification): Files {
    $fileName = 'File-' . random_int(1, 99999);
    $size = random_int(1, Files::LARGE - 1);
    $isImage = false;
    if (stripos($specification, 'large') !== false) {
      $size = random_int(Files::LARGE, 2000);
    }
    if (stripos($specification, 'image') !== false){
      $isImage = true;
    }
    return $this->createFile($fileName, $isImage, $size);
}
  private function createFile(string $name, bool $isImage, int $size)
  {
    $file = new Files();
    
    $file->setIsImage($isImage);
    $file->setName($name);
    $file->setSize($size);

    return $file;
  }

  public function createInforme(int $size)
  {
    $file = new Files();
    
    $file->setName('Informe');
    $file->setSize($size);

    return $file;
  }

  
  
  
}