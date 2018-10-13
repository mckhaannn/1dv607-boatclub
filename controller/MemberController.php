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
  
  public function routeToAddMember() {
    if($this->memberView->isSocialSecurityValid() && $this->memberView->checkSocialSecurityLength()) {
      $this->memberModel->reciveMemberData($this->memberView->getName(), $this->memberView->getSocialSecurity());
      $this->memberModel->addNewMemberToDatabase();
    }
  }
  
  /**
   * send member info to model and delete the selected member
   */

  public function routeToDeleteMember() {
    $this->memberModel->deleteMember($this->selectedMemberView->getMemberId());
  }
  
  /**
   * gives model information to update a selected member
   */
  
  public function routeToEditMember() {
    if($this->updateMember->isSocialSecurityValid() && $this->updateMember->checkSocialSecurityLength()) {
      $this->memberModel->updateMemberData($this->updateMember->getUpdatedName(), $this->updateMember->getUpdatedSocialSecurity(), $this->updateMember->getMemberId());
    }
  }
}