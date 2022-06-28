<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */

class Category 
{
  /**
   * @var Collection;
   * @ORM\OneToMany(targetEntity="Files", mappedBy="category", cascade={"persist"})
   */
  private $files;

  public function __construct()
  {
    $this->files = new ArrayCollection();
    
  }

  public function getFiles(): Collection
  {
    return $this->files;
  }

  public function addFile(Files $file){
    $this->files[] = $file;

  }
}