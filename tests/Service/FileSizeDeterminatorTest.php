<?php

namespace Tests\Service;

use App\Entity\Files;
use App\Service\FileSizeDeterminator;
use PHPUnit\Framework\TestCase;

class FileSizeDeterminatorTest extends TestCase
{
  /**
   * @dataProvider getSpecSizeTests
   */
  public function testReturnsCorrectSizeRange( string $spec, int $minExpectedSize, int $maxExpectedSize )
  {
    $determinator = new FileSizeDeterminator();
    $actualSize = $determinator->getSizeFromSpecification($spec);
    $this->assertGreaterThanOrEqual($minExpectedSize, $actualSize);
    $this->assertLessThanOrEqual($maxExpectedSize, $actualSize);
  }

  
  public function getSpecSizeTests()
  {
    return [
      //specification, minsize, maxsize
      ['large Private Image File', Files::LARGE, Files::HUGE - 1],
      ['give me all the cookies', 0, Files::LARGE -1],
      ['Large private Pdf', Files::LARGE, Files::HUGE - 1],
      ['huge file', Files::HUGE, 20000],
      ['huge pdf', Files::HUGE, 20000],
      ['OMG', Files::HUGE, 20000],
      ['?', Files::HUGE, 20000]

    ];
  }
}