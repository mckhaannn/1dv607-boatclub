<?php

namespace controller;

class BoatController {

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
    )
  {
    $this->addBoatView = $addBoatView;
    $this->boatListView = $boatListView;
    $this->updateBoatView = $updateBoatView;
    $this->selectedMemberView = $selectedMemberView;
    $this->boatModel = $boatModel;
  }

  public function addBoat() {
    // var_dump($this->addBoatView->getBoatType(), $this->addBoatView->getLength(), $this->addBoatView->getMemberId());
    // $this->boatModel->reciveBoatData();
    // $this->boatModel->test();
    $this->boatModel->reciveBoatData($this->addBoatView->getBoatType(), $this->addBoatView->getLength(), $this->addBoatView->getMemberId());
    $this->boatModel->addBoatToMember();
  }

  public function editBoat() {
    var_dump($this->updateBoatView->MemberId());
    $this->boatModel->updateBoatData($this->updateBoatView->getUpdatedType(),$this->updateBoatView->getUpdatedLength(), $this->updateBoatView->getBoatId(), $this->updateBoatView->MemberId());
  }
  
  public function deleteBoat() {
    $this->boatModel->deleteBoat($this->selectedMemberView->getId(), $this->selectedMemberView->boatId());
  }

}