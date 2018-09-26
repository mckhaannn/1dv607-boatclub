<?php

namespace controller;

class PersonController {

  private $memberView;
  private $personModel;
  private $boatView;
  private $boatModel;
  private $selectedMemberView;
  private $updateMember;

  public function __construct(\view\AddNewMemberView $memberView, \model\PersonModel $personModel, \model\BoatModel $boatModel, \view\AddBoatView $boatView, \view\SelectedMemberView $selectedMemberView, \view\UpdateMember $updateMember)
  { 
    $this->memberView = $memberView;
    $this->personModel = $personModel;
    $this->boatView = $boatView;
    $this->boatModel = $boatModel;
    $this->selectedMemberView = $selectedMemberView;
    $this->updateMember = $updateMember;
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
  public function deleteMember() {
    $this->personModel->deletePerson($this->selectedMemberView->getId());
  }
  public function editMember() {
    $this->personModel->updatePersonData($this->updateMember->getUpdatedName(), $this->updateMember->getUpdatedSocialSecurity(), $this->updateMember->getId());
  }
}