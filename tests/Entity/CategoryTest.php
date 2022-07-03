<?php
namespace Tests\Category;

use App\Entity\Category;
use App\Entity\Files;
use App\Exception\FilesCategoriesException;
use App\Exception\NotMixingException;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
  public function testItHasNoFilesByDefault() {

    $category = new Category();
    $this->assertEmpty($category->getFiles());
  }

  public function testAddsFiles()
  {
    $category = new Category(true);

    $category->addFile(new Files());
    $category->addFile(new Files());

    $this->assertCount(2,$category->getFiles());

  }

  /**
   * @expectedException \App\Exception\NotMixingException
   */
  public function testItDoesNotAllowPdfToMixWithImage() {
    $category = new Category(true);
    
    $category->addFile(new Files());  

    $this->expectException( NotMixingException::class );
    $category->addFile(new Files('image', true));
  }

   /**
   * @expectedException \App\Exception\NotMixingException
   */
 public function testItDoesNotAllowNonImageToMixWithImage() {
    $category = new Category(true);
    $category->addFile(new Files('image', false, false));
    $category->addFile(new Files());  
  }

  public function testItDoesNotAllowPrivateFilesInUnsecureCategory() {
    $category = new Category();

    $this->expectException(FilesCategoriesException::class);
    $this->expectExceptionMessage('Are you crazy?');

    $category->addFile(new Files());
  }
}