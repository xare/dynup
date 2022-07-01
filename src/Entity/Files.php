<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="files")
 */

 class Files
 {

  /**
   * @var string
   * @ORM|column(type="string")
   */
  private $name;
  
  /** 
   * @var integer
   * @ORM\Column(type="integer")
   */
   private $size = 0;

   /**
   * @var string
   * @ORM\Column(type="string")
   */
  private $mimeType;

  /**
   * @var boolean
   * @ORM\Column(type="boolean")
   */
  private $isImage;

   /**
   * @var boolean
   * @ORM\Column(type="boolean")
   */
  private $isPrivate;

  /**
   * @var Category
   * @ORM\ManyToOne(targetEntity="Category", inversedBy="Files")
   */
  private ?Category $category;

  const LARGE = 1000;
  const HUGE = 10000;

  public function __construct(string $mimeType = 'unknown', bool $isImage = false, bool $isPrivate = false) 
  {
    $this->mimeType = $mimeType;
    $this->isImage = $isImage;
    $this->isPrivate = $isPrivate;
  }

  /**
   * Get the value of name
   *
   * @return  string
   */ 
  public function getName() :string
  {
    return $this->name;
  }

  public function setName(string $name) 
  {
    $this->name = $name;
  }

  public function getSize(): int
  {
    return $this->size;
  }

  public function setSize(int $size)
  {
    $this->size = $size;
  }

  public function getMimetype()
  {
    return $this->mimeType;
  }

  public function getSpecification(){
    return sprintf('This file is %san image and it´s format is %s',
      $this->isImage == true ? '':'not ',
      $this->mimeType
    );
  }

  public function getIsImage(): bool
  {
    return $this->isImage;
  }
  
  public function setIsImage(bool $isImage){
    $this->isImage = $isImage;
    return $this->isImage;
  }

  public function getIsPrivate(): bool
  {
    return $this->isPrivate;
  }
  
  public function setIsPrivate(bool $isPrivate){
    $this->isPrivate = $isPrivate;
    return $this->isPrivate;
  }

  
 }