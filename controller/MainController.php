<?php

namespace controller;

class MainController
{
    private $memberController;
    private $layoutView;
    private $addNewaddNewMemberView;
    private $listView;
    private $boatView;
    private $selectedView;
    private $updateMember;
    private $updateBoat;
    private $boatListView;

    public function __construct(\controller\MemberController $memberController, \view\LayoutView $layoutView, \view\AddNewMemberView $addNewMemberView, \view\ListOfMemberView $listView, \view\AddBoatView $boatView, \view\SelectedMemberView $selectedView, \view\UpdateMemberView $updateMember, \view\UpdateBoatView $updateBoat, \view\BoatListView $boatListView)
    {

        $this->memberController = $memberController;
        $this->layoutView = $layoutView;
        $this->addNewMemberView = $addNewMemberView;
        $this->listView = $listView;
        $this->boatView = $boatView;
        $this->selectedView = $selectedView;
        $this->updateMember = $updateMember;
        $this->updateBoat = $updateBoat;
        $this->boatListView = $boatListView;

    }
    public function render()
    {
        $this->layoutView->getVariablesToLayoutView(
            $this->addNewMemberView,
            $this->listView,
            $this->boatView,
            $this->selectedView,
            $this->updateMember,
            $this->updateBoat,
            $this->boatListView
        );

        if($this->addNewMemberView->lookForPost()) {
            $this->memberController->controller();
        }

        if($this->boatView->lookForPost()) {
            $this->memberController->addBoat();
        }

        if($this->updateMember->lookForPost()) {
            $this->memberController->editMember();
        }

        if($this->listView->lookForPost()) {
            $this->memberController->deleteMember();
        }

        if($this->updateBoat->lookForPost()) {
            $this->memberController->editBoat();
        }

        if($this->updateBoat->lookForDeletePost()) {
            $this->memberController->deleteBoat();
        }
        
        $this->layoutView->renderLayoutView();    
    }
 
}