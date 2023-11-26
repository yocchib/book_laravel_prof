<?php

namespace App\MyClasses;

class MyCustomClass
{
  // クラスの定義
  protected $number;

  public function __construct($number = 0)
  {
    $this->number = $number ;
  }

  public function getNumber()
  {
    return $this->number ;
  }
}