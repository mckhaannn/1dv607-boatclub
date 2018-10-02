<?php

namespace controller;

class MainController
{
    private $memberController;
    private $boatController;
    private $layoutView;
    private $addNewMemberView;
    private $listOfMemberView;
    private $addBoatView;
    private $selectedmemberView;
    private $updateMemberView;
    private $updateBoatView;
    private $boatListView;

    public function __construct(
        \controller\MemberController $memberController, 
        \controller\BoatController $boatController,
        \view\LayoutView $layoutView, 
        \view\AddNewMemberView $addNewMemberView, 
        \view\ListOfMemberView $listOfMemberView, 
        \view\AddBoatView $addBoatView, 
        \view\SelectedMemberView $selectedmemberView, 
        \view\UpdateMemberView $updateMemberView, 
        \view\UpdateBoatView $updateBoatView, 
        \view\BoatListView $boatListView
        )
    {

        $this->memberController = $memberController;
        $this->boatController = $boatController;
        $this->layoutView = $layoutView;
        $this->addNewMemberView = $addNewMemberView;
        $this->listOfMemberView = $listOfMemberView;
        $this->addBoatView = $addBoatView;
        $this->selectedMemberView = $selectedmemberView;
        $this->updateMemberView = $updateMemberView;
        $this->updateBoatView = $updateBoatView;
        $this->boatListView = $boatListView;

    }
    public function render()
    {
        $this->layoutView->getVariablesToLayoutView(
            $this->addNewMemberView,
            $this->listOfMemberView,
            $this->addBoatView,
            $this->selectedMemberView,
            $this->updateMemberView,
            $this->updateBoatView,
            $this->boatListView
        );

        if($this->addNewMemberView->lookForPost()) {
            $this->memberController->addMember();
        }

        if($this->addBoatView->lookForPost()) {
            $this->boatController->addBoat();
        }

        if($this->updateMemberView->lookForPost()) {
            $this->memberController->editMember();
        }

        if($this->listOfMemberView->lookForPost()) {
            $this->memberController->deleteMember();
        }

        if($this->updateBoatView->lookForPost()) {
            $this->boatController->editBoat();
        }

        if($this->updateBoatView->lookForDeletePost()) {
            $this->boatController->deleteBoat();
        }
        
        $this->layoutView->renderLayoutView();    
    }
 
}