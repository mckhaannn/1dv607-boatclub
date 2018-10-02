<?php

namespace controller;

class BoatController
{

  private $addBoatView;
  private $boatListView;
  private $updateBoatView;
  private $selectedMemberView;
  private $boatModel;

  public function __construct(
    \view\AddBoatView $addBoatView,
    \model\BoatModel $boatModel,
    \view\BoatListView $boatListView,
    \view\UpdateBoatView $updateBoatView,
    \view\SelectedMemberView $selectedMemberView
  ) {
    $this->addBoatView = $addBoatView;
    $this->boatListView = $boatListView;
    $this->updateBoatView = $updateBoatView;
    $this->selectedMemberView = $selectedMemberView;
    $this->boatModel = $boatModel;
  }

  /**
   * 
   * adds a boat to a selected user
   */
  
  public function addBoat()
  {
    $this->boatModel->reciveBoatData($this->addBoatView->getBoatType(), $this->addBoatView->getLength(), $this->addBoatView->getMemberId());
    $this->boatModel->addBoatToMember();
  }

  /**
   * 
   * edit boat on a selected user
   */
  
  public function editBoat()
  {
    $this->boatModel->updateBoatData($this->updateBoatView->getUpdatedType(), $this->updateBoatView->getUpdatedLength(), $this->updateBoatView->getBoatId(), $this->updateBoatView->MemberId());
  }


  /**
   * delete boat from a selected user
   */

  public function deleteBoat()
  {
    $this->boatModel->deleteBoat($this->boatListView->getMemberId(), $this->boatListView->getBoatId());
  }
}