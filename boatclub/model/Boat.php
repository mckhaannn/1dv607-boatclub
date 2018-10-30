<?php

namespace model;

class Boat
{
  private $type;
  private $length;
  private $id;

  public function __construct($type, $length, $id)
  {
    $this->type = $type;
    $this->length = $length;
    $this->id = $id;
  }

  public function getBoatType()
  {
    return $this->type;
  }

  public function getBoatLength()
  {
    return $this->length;
  }
  
  public function getId()
  {
    return $this->id;
  }
}                                                                                                                                                            