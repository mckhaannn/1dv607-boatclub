<?php

require_once 'controller/MainController.php';
require_once 'controller/PersonController.php';
require_once 'view/AddNewMemberView.php';
require_once 'view/ListOfMemberView.php';
require_once 'view/LayoutView.php';
require_once 'model/PersonModel.php';
require_once 'view/addBoatView.php';
require_once 'view/SelectedMemberView.php';
require_once 'model/BoatModel.php';
//MAKE SURE ERRORS ARE SHOWN.sd MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$layoutView = new \view\LayoutView();
$selectedView = new \view\SelectedMemberView();
$newMemberView = new \view\AddNewMemberView();
$boatModel = new \model\BoatModel();
$personModel = new \model\PersonModel();
$addBoatView = new \view\AddBoatView();
$listOfMemberView = new \view\ListOfMemberView($personModel);
$personController = new \controller\PersonController($newMemberView, $personModel, $boatModel, $addBoatView, $selectedView);
$mainController = new \controller\MainController($personController, $layoutView, $newMemberView, $listOfMemberView, $addBoatView, $selectedView);
$mainController->render();