<?php

namespace controller;

class MainController
{
    private $personController;
    private $layoutView;
    private $memberView;
    private $listView;

    public function __construct(\controller\PersonController $personController, \view\LayoutView $layoutView, \view\AddNewMemberView $memberView, \view\ListOfMemberView $listView)
    {

        $this->personController = $personController;
        $this->layoutView = $layoutView;
        $this->memberView = $memberView;
        $this->listView = $listView;

    }
    public function render()
    {
        $this->layoutView->renderLayoutView(
            $this->memberView,
            $this->listView
        );
        if($this->memberView->lookForPost()) {
            $this->personController->controller();
        }
    }
 
}