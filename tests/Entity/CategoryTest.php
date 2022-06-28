<?php
namespace Tests\Category;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
  public function testItHasNoFilesByDefault() {

    $category = new Category();
    $this->assertCount(0, $category->getFiles());
  }
}