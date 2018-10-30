<?php

namespace controller;

use view\AddBoatView;


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

  public function routeToAddBoat()
  {
    $this->boatModel->addBoatToMember($this->addBoatView->getCreatedBoat($this->boatModel->generateBoatId()), $this->addBoatView->getMemberId());
  }

  /**
   * 
   * edit boat on a selected user
   */

  public function routeToEditBoat()
  {
    $this->boatModel->updateBoatData($this->updateBoatView->getUpdatedBoat(), $this->updateBoatView->MemberId());
  }


  /**
   * delete boat from a selected user
   */

  public function routeToDeleteBoat()
  {
    $this->boatModel->deleteBoat($this->boatListView->getMemberId(), $this->boatListView->getBoatId());
  }
}