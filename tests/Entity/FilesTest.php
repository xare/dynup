<?php

namespace Tests\Files;

use PHPUnit\Framework\TestCase;

class FilesTest extends TestCase 
{
  public function testSettingLength()
  {
    $file = new Files();
    $this->assertSame(0, $file->getLength());
    $file->setLength(9);

    $this->assertSame(9, $file->getLength());
  }
}