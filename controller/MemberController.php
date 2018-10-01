<?php

namespace controller;

class MemberController {

  private $memberView;
  private $memberModel;
  private $addBoatView;
  private $boatModel;
  private $selectedMemberView;
  private $updateMember;
  private $updateBoatView;

  public function __construct(\view\AddNewMemberView $memberView, \model\MemberModel $memberModel, \model\BoatModel $boatModel, \view\AddBoatView $addBoatView, \view\SelectedMemberView $selectedMemberView, \view\UpdateMemberView $updateMember,  \view\UpdateBoatView $updateBoatView)
  { 
    $this->memberView = $memberView;
    $this->memberModel = $memberModel;
    $this->addBoatView = $addBoatView;
    $this->boatModel = $boatModel;
    $this->selectedMemberView = $selectedMemberView;
    $this->updateMember = $updateMember;
    $this->updateBoatView = $updateBoatView;
  }

  public function controller() {
      $this->memberModel->reciveMemberData($this->memberView->getName(), $this->memberView->getSocialSecurity());
      $this->memberModel->addNewMemberToDatabase();
      $this->memberModel->fetchData(); 
  }
  
  public function addBoat() {
    $this->boatModel->reciveBoatData($this->addBoatView->getBoatType(), $this->addBoatView->getLength(), $this->addBoatView->getMemberId());
    $this->boatModel->addBoatToMember();
  }

  public function deleteMember() {
    $this->memberModel->deleteMember($this->selectedMemberView->getMemberId());
  }

  public function editMember() {
    $this->memberModel->updateMemberData($this->updateMember->getUpdatedName(), $this->updateMember->getUpdatedSocialSecurity(), $this->updateMember->getMemberId());
  }

  public function editBoat() {
    $this->boatModel->updateBoatData($this->updateBoat->getUpdatedType(),$this->updateBoat->getUpdatedLength(), $this->updateBoat->getBoatId(), $this->updateBoat->MemberId());
  }
  
   public function deleteBoat() {
     $this->boatModel->deleteBoat($this->selectedMemberView->getId(), $this->selectedMemberView->boatId());
   }
}