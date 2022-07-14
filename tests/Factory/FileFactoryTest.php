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

/**
 * Undocumented variable
 *
 * @var \PHPUnit_Framework_MockObject_MockObject
 */
private $sizeDeterminator;

public function setUp(): void{
  $this->sizeDeterminator = $this->createMock(FileSizeDeterminator::class);
  $this->factory = new FileFactory($this->sizeDeterminator);
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

    $this->sizeDeterminator
      ->expects($this->once())
      ->method('getSizeFromSpecification')
      ->with($spec)
      ->willReturn(20000);
    $file = $this->factory->createFileFromSpecification($spec);
    
    $this->assertSame($expectedIsImage, $file->getIsImage());
    $this->assertSame(20000, $file->getSize());
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