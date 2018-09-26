<?php

namespace controller;

class PersonController {

  private $memberView;
  private $personModel;
  private $boatView;
  private $boatModel;
  private $selectedMemberView;

  public function __construct(\view\AddNewMemberView $memberView, \model\PersonModel $personModel, \model\BoatModel $boatModel, \view\AddBoatView $boatView, \view\SelectedMemberView $selectedMemberView)
  { 
    $this->memberView = $memberView;
    $this->personModel = $personModel;
    $this->boatView = $boatView;
    $this->boatModel = $boatModel;
    $this->selectedMemberView = $selectedMemberView;
  }

  public function controller() {
      $this->personModel->recivePersonData($this->memberView->getName(), $this->memberView->getSocialSecurity());
      $this->personModel->addNewPersonToDatabase();
      $this->personModel->fetchData();
  }
  
  public function addBoat() {
    $this->boatModel->reciveBoatData($this->boatView->getType(), $this->boatView->getLength(), $this->boatView->getName());
    $this->boatModel->addBoatToPerson();
  }
}