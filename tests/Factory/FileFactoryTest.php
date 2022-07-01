<?php 
namespace Tests\FileFactory;

use App\Entity\Files;
use App\Factory\FileFactory;
use PHPUnit\Framework\TestCase;

class FileFactoryTest extends TestCase 
{
  /**
   * @var FileFactory
   */
private $factory;

public function setUp(): void{
  $this->factory = new FileFactory();
}

  public function testItCreatesAFile()
  {
    $this->factory = new FileFactory();
    $file = $this->factory->createInforme(1000);

    $this->assertInstanceOf(Files::class, $file);
    $this->assertIsString($file->getName());
    $this->assertSame('Informe', $file->getName());
    $this->assertSame(1000, $file->getSize());

  }
  
  public function testItCreatesAPdf(){
    $this->markTestIncomplete("Waiting for confirmation from dynup");
  }

  public function testItCreatesASmallFile(){
    if (!class_exists('Pdf')) {
      $this->markTestSkipped('There is no class to create pdf files');
    }
    $file = $this->factory->createFile('filename',1000);
    $this->assertSame(1000, $file->getSize());
  }
  
  /**
   * @dataProvider getSpecificationTests
   */
  public function testItCreatesAFileFromSpecification(string $spec, bool $expectedIsLarge, bool $expectedIsImage)
  {
    $file = $this->factory->createFileFromSpecification($spec);
    
    if ($expectedIsLarge)
    {
      $this->assertGreaterThanOrEqual(Files::LARGE, $file->getSize());
    } else {
      $this->assertLessThan(Files::LARGE, $file->getSize());
    }
    $this->assertSame($expectedIsImage, $file->getIsImage());
    
    //$this->assertTrue($file->getIsImage(),'File types do not match');
  }

  public function getSpecificationTests()
  {
    return [
      //specification is large and is an image
      ['large Private Image File', true, true, true],
      ['give me all the cookies', false, false, false],
      ['Large private Pdf', true, false, true],
    ];
  }
  /**
   * @dataProvider getHugeFileSpecTests
   */
  public function testItCreatesAHugeFile(string $specification)
  {
    $file=$this->factory->createFileFromSpecification($specification);
    $this->assertGreaterThanOrEqual(Files::HUGE, $file->getSize());
  }

  public function getHugeFileSpecTests()
  {
      return [
          ['huge files'],
          ['huge file'],
          ['huge'],
          ['OMG'],
          ['?'],
      ];
  }
}