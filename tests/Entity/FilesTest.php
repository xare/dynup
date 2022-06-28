<?php

namespace Tests\Files;

use PHPUnit\Framework\TestCase;
use App\Entity\Files;

class FilesTest extends TestCase 
{

  
  public function testSettingSize()
  {
    $file = new Files();
    $this->assertSame(0, $file->getSize());
    $file->setSize(9);

    $this->assertSame(9, $file->getSize());
  }

  public function testReturnsMimeTypeOfFile()
  {
    $file = new Files();
    $this->assertSame('unknown', $file->getMimetype());
  }

  public function testFullSpecificationOfFile() 
  {
    $file = new Files();
    $this->assertSame('This file is not an image and it´s format is unknown', $file->getSpecification());
  }
}