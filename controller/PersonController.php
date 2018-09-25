<?php

namespace controller;

class PersonController {

  private $memberView;
  private $personModel;

  public function __construct(\view\AddNewMemberView $memberView, \model\PersonModel $personModel)
  { 
    $this->memberView = $memberView;
    $this->personModel = $personModel;
  }

  public function controller() {
    $this->personModel->recivePersonData($this->memberView->getName(), $this->memberView->getSocialSecurity());
    $this->personModel->addNewPersonToDatabase();

  }
}