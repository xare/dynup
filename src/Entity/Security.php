<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="securities")
 */
class Security
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="securities")
     */
    private $category;

    public function __construct(string $name, bool $isActive, Category $category)
    {
        $this->name = $name;
        $this->isActive = $isActive;
        $this->category = $category;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }
}
