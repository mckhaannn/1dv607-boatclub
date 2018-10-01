<?php

namespace controller;

class MainController
{
    private $personController;
    private $layoutView;
    private $memberView;
    private $listView;
    private $boatView;
    private $selectedView;
    private $updateMember;
    private $updateBoat;

    public function __construct(\controller\PersonController $personController, \view\LayoutView $layoutView, \view\AddNewMemberView $memberView, \view\ListOfMemberView $listView, \view\AddBoatView $boatView, \view\SelectedMemberView $selectedView, \view\UpdateMember $updateMember, \view\UpdateBoatView $updateBoat)
    {

        $this->personController = $personController;
        $this->layoutView = $layoutView;
        $this->memberView = $memberView;
        $this->listView = $listView;
        $this->boatView = $boatView;
        $this->selectedView = $selectedView;
        $this->updateMember = $updateMember;
        $this->updateBoat = $updateBoat;

    }
    public function render()
    {
        $this->layoutView->getVariablesToLayoutView(
            $this->memberView,
            $this->listView,
            $this->boatView,
            $this->selectedView,
            $this->updateMember,
            $this->updateBoat
        );
        if($this->memberView->lookForPost()) {
            $this->personController->controller();
        }
        if($this->boatView->lookForPost()) {
            $this->personController->addBoat();
        }
        if($this->updateMember->lookForPost()) {
            $this->personController->editMember();
        }
        if($this->listView->lookForPost()) {
            $this->personController->deleteMember();
        }
        if($this->updateBoat->lookForPost()) {
            $this->personController->editBoat();
        }
        $this->layoutView->renderLayoutView();    
    }
 
}