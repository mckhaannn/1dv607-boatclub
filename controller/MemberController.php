<?php

namespace controller;

class MemberController {

  private $memberView;
  private $memberModel;
  private $selectedMemberView;
  private $updateMember;

  public function __construct(
    \view\AddNewMemberView $memberView, 
    \model\MemberModel $memberModel, 
    \view\SelectedMemberView $selectedMemberView, 
    \view\UpdateMemberView $updateMember)
  { 
    $this->memberView = $memberView;
    $this->memberModel = $memberModel;
    $this->selectedMemberView = $selectedMemberView;
    $this->updateMember = $updateMember;
  }

  public function addMember() {
      $this->memberModel->reciveMemberData($this->memberView->getName(), $this->memberView->getSocialSecurity());
      $this->memberModel->addNewMemberToDatabase();
      $this->memberModel->fetchData(); 
  }
  
  public function deleteMember() {
    $this->memberModel->deleteMember($this->selectedMemberView->getMemberId());
  }

  public function editMember() {
    $this->memberModel->updateMemberData($this->updateMember->getUpdatedName(), $this->updateMember->getUpdatedSocialSecurity(), $this->updateMember->getMemberId());
  }
}