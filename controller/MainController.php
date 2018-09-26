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

    public function __construct(\controller\PersonController $personController, \view\LayoutView $layoutView, \view\AddNewMemberView $memberView, \view\ListOfMemberView $listView, \view\AddBoatView $boatView, \view\SelectedMemberView $selectedView)
    {

        $this->personController = $personController;
        $this->layoutView = $layoutView;
        $this->memberView = $memberView;
        $this->listView = $listView;
        $this->boatView = $boatView;
        $this->selectedView = $selectedView;

    }
    public function render()
    {
        $this->layoutView->renderLayoutView(
            $this->memberView,
            $this->listView,
            $this->boatView,
            $this->selectedView
        );
        if($this->memberView->lookForPost()) {
            $this->personController->controller();
        }
        if($this->boatView->lookForPost()) {
            $this->personController->addBoat();
        }
    }
 
}