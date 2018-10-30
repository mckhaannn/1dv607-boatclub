<?php

namespace model;

class Member {

  private $name;
  private $socialSecurity;
  private $id;

  public function __construct($name, $socialSecurity, $id)
  {
    $this->name = $name;
    $this->socialSecurity = $socialSecurity;
    $this->id = $id;
  }

  public function getName() {
    return $this->name;
  }
  public function getSocialSecurity() {
    return $this->socialSecurity;
  }
  public function getId() {
    return $this->id;
  }
}
