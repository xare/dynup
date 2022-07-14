<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Security;
use App\Factory\FileFactory;
use Doctrine\ORM\EntityManagerInterface;

class CategoryBuilderService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FileFactory
     */
    private $fileFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        FileFactory $fileFactory
    )
    {
        $this->entityManager = $entityManager;
        $this->fileFactory = $fileFactory;
    }

    public function buildCategory(
        int $numberOfSecuritySystems = 1,
        int $numberOfFiles = 3
    ): Category
    {
        $category = new Category();
        $this->addSecuritySystems($numberOfSecuritySystems, $category);
        $this->addFiles($numberOfFiles, $category);
        $this->entityManager->persist($category);
        $this->entityManager->flush();
        return $category;
    }

    private function addSecuritySystems(int $numberOfSecuritySystems, Category $category)
    {
        $securityNames = ['Images', 'Documents', 'Others'];
        for ($i = 0; $i < $numberOfSecuritySystems; $i++) {
            $securityName = $securityNames[array_rand($securityNames)];
            $security = new Security($securityName, true, $category);
            $category->addSecurity($security);
        }
    }

    private function addFiles(int $numberOfFiles, Category $category)
    {
        $lengths = ['small', 'large', 'huge'];
        $types = ['image', 'pdf'];
        // We should not mix herbivore and carnivorous together,
        // so use the same diet for every dinosaur.
        $type = $types[array_rand($types)];
        for ($i = 0; $i < $numberOfFiles; $i++)
        {
            $length = $lengths[array_rand($lengths)];
            $specification = "{$length} {$type} file";
            $file = $this->fileFactory->createFileFromSpecification($specification);

            $category->addFile($file);
        }
    }
}
