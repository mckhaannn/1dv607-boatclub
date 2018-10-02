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


  /**
   * get information on member and redirect it to the model
   */
  public function addMember() {
      $this->memberModel->reciveMemberData($this->memberView->getName(), $this->memberView->getSocialSecurity());
      $this->memberModel->addNewMemberToDatabase();
      $this->memberModel->fetchData(); 
  }
  
  /**
   * send member info to model and delete the selected member
   */
  public function deleteMember() {
    $this->memberModel->deleteMember($this->selectedMemberView->getMemberId());
  }

  /**
   * 
   * gives model information to update a selected member
   */
  public function editMember() {
    $this->memberModel->updateMemberData($this->updateMember->getUpdatedName(), $this->updateMember->getUpdatedSocialSecurity(), $this->updateMember->getMemberId());
  }
}