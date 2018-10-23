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

        /**
         * redirect on post to add memeber
         */

        if($this->addNewMemberView->lookForPost()) {
            $this->memberController->routeToAddMember();
        }

        /**
         * redirect on post to add boat
         */

        if($this->addBoatView->lookForPost()) {
            $this->boatController->routeToAddBoat();
        }

        /**
         * redirect on post to delete member
         */

        if($this->updateMemberView->lookForPost()) {
            $this->memberController->routeToEditMember();
        }

        /**
         * redirect on post to delete member
         */

        if($this->listOfMemberView->lookForPost()) {
            $this->memberController->routeToDeleteMember();
        }

        /**
         * redirect on post to edit boat
         */

        if($this->updateBoatView->lookForPost()) {
            $this->boatController->routeToEditBoat();
        }

        /**
         * redirect on post to delete boat
         */

        if($this->boatListView->lookForDeletePost()) {
            $this->boatController->routeToDeleteBoat();
        }

        /**
         * render start page view
         */

        $this->layoutView->renderLayoutView(); 
        
    }
 
}