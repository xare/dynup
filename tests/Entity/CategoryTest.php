<?php
namespace Tests\Category;

use App\Entity\Category;
use App\Entity\Files;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
  public function testItHasNoFilesByDefault() {

    $category = new Category();
    $this->assertEmpty($category->getFiles());
  }

  public function testAddsFiles()
  {
    $category = new Category();

    $category->addFile(new Files());
    $category->addFile(new Files());

    $this->assertCount(2,$category->getFiles());

  }
}