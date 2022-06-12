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
   * @ORM\Column(type="integer")
   */

   private $length = 0;

  public function getLength(): int
  {
    return $this->length;
  }

  public function setLength(int $length)
  {
    $this->length = $length;
  }

 }