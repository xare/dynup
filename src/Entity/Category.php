<?php 

namespace App\Entity;

use App\Exception\FilesCategoriesException;
use App\Exception\NotMixingException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */

class Category 
{
  /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
  /**
   * @var Collection;
   * @ORM\OneToMany(targetEntity="App\Entity\Files", mappedBy="category", cascade={"persist"})
   */
  private ?Collection $files;

  /**
   * @var Collection|Security[]
   * @ORM\OneToMany(targetEntity="App\Entity\Security", mappedBy="category", cascade={"persist"})
   */
  private $securities;

  public function __construct( bool $withBasicSecurity = false )
  {
    $this->files = new ArrayCollection();
    $this->securities = new ArrayCollection();
    if($withBasicSecurity) {
      $this->addSecurity(new Security('Fence', true, $this));
    }
  }

  public function getFiles(): Collection
  {
    return $this->files;
  }

  public function addFile(Files $file){
    if(!$this->canAddFile($file)) {
      throw new NotMixingException();
    }

    if(!$this->isSecurityActive()) {
      throw new FilesCategoriesException('Are you crazy?');
    }
    $this->files[] = $file;

  }

  public function addSecurity(Security $security) 
  {
    $this->securities[] = $security;
  }
  
  public function isSecurityActive(): bool
  {
    foreach ($this->securities as $security) {
      if ($security->getIsActive()) {
        return true;
      }
    }

    return false;
  }

  private function canAddFile(Files $file): bool
  {
    return count($this->files) === 0 
            || $this->files->first()->getIsImage() === $file->getIsImage();
  }
  public function getSecurities(): Collection
  {
      return $this->securities;
  }
}