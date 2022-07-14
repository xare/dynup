<?php

namespace Tests\Service;

use App\Entity\Files;
use App\Entity\Security;
use App\Service\CategoryBuilderService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryBuilderServiceIntegrationTest extends KernelTestCase
{
  public function testItBuildsCategoryWithDefaultSpecification()
  {
    self::bootKernel();
    $container = static::getContainer();
    $categoryBuilderService = $container
                                ->get('test.'.CategoryBuilderService::class);

    $categoryBuilderService->buildCategory();

    $entityManager = self::$kernel->getContainer()
    ->get('doctrine')
    ->getManager();

    $count = (int) $entityManager->getRepository(Security::class)
    ->createQueryBuilder('s')
    ->select('COUNT(s.id)')
    ->getQuery()
    ->getSingleScalarResult();

    $this->assertSame(1, $count, 'Amount of security systems is not the same');

    $count = (int) $entityManager->getRepository(Files::class)
            ->createQueryBuilder('d')
            ->select('COUNT(d.id)')
            ->getQuery()
            ->getSingleScalarResult();
    
    $this->assertSame(3, $count, 'Amount of dinosaurs is not the same');
  }
}