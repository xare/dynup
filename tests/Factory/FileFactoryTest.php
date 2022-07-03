<?php 
namespace Tests\FileFactory;

use App\Entity\Files;
use App\Factory\FileFactory;
use App\Service\FileSizeDeterminator;
use PHPUnit\Framework\TestCase;

class FileFactoryTest extends TestCase 
{
  /**
   * @var FileFactory
   */
private $factory;

public function setUp(): void{
  $mockSizeDeterminator = $this->createMock(FileSizeDeterminator::class);
  $this->factory = new FileFactory($mockSizeDeterminator);
}

  /* public function testItCreatesAFile()
  {
    $this->factory = new FileFactory();
    $file = $this->factory->createInforme(1000);

    $this->assertInstanceOf(Files::class, $file);
    $this->assertIsString($file->getName());
    $this->assertSame('Informe', $file->getName());
    $this->assertSame(1000, $file->getSize());

  } */
  
  public function testItCreatesAPdf(){
    $this->markTestIncomplete("Waiting for confirmation from dynup");
  }

  /* public function testItCreatesASmallFile(){
    if (!class_exists('Pdf')) {
      $this->markTestSkipped('There is no class to create pdf files');
    }
    $file = $this->factory->createFile('filename', true, 1000, false);
    $this->assertSame(1000, $file->getSize());
  } */
  
  /**
   * @dataProvider getSpecificationTests
   */
  public function testItCreatesAFileFromSpecification(string $spec, bool $expectedIsImage)
  {
    $file = $this->factory->createFileFromSpecification($spec);
    
    $this->assertSame($expectedIsImage, $file->getIsImage());
    
    //$this->assertTrue($file->getIsImage(),'File types do not match');
  }

  public function getSpecificationTests()
  {
    return [
      //specification is large and is an image and is public
      ['large Private Image File', true, true],
      ['give me all the cookies', false, false],
      ['Large private Pdf', false, true],
    ];
  }
  /**
   * @dataProvider getHugeFileSpecTests
   */
  /* public function testItCreatesAHugeFile(string $specification)
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
  } */
}