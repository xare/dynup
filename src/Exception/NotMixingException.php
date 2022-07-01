<?php 
namespace App\Exception;

class NotMixingException extends \Exception
{
  protected $message = "Please do not mix the private and the public files. It is wrong!";
}