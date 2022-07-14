<?php

namespace Tests\Service;

use App\Entity\Category;
use App\Entity\Files;
use App\Factory\FileFactory;
use App\Service\CategoryBuilderService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class CategoryBuilderServiceTest extends TestCase
{
  public function testItBuildsAndPersistsCategory()
  {
    $em = $this->createMock(EntityManagerInterface::class);
    $em->expects($this->once())
      ->method('persist')
      ->with($this->isInstanceOf(Category::class));
    $em->expects($this->atLeastOnce())
      ->method('flush');
    $fileFactory = $this->createMock(FileFactory::class);
    $fileFactory->expects($this->exactly(2))
    ->method('createFileFromSpecification')
    ->willReturn(new Files())
    ->with($this->isType('string'));

    $builder = new CategoryBuilderService($em, $fileFactory);
    $category = $builder->buildCategory(1,2);

    $this->assertCount(1, $category->getSecurities());
    $this->assertCount(2, $category->getFiles());

  }
}