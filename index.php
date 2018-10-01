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
require_once 'view/UpdateBoatView.php';
require_once 'view/UpdateMember.php';
//MAKE SURE ERRORS ARE SHOWN.sd MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$layoutView = new \view\LayoutView();
$newMemberView = new \view\AddNewMemberView();
$boatModel = new \model\BoatModel();
$UpdateBoatView = new \view\UpdateBoatView();
$selectedView = new \view\SelectedMemberView($boatModel);
$personModel = new \model\PersonModel();
$addBoatView = new \view\AddBoatView();
$updateMember = new \view\UpdateMember();
$listOfMemberView = new \view\ListOfMemberView($personModel, $boatModel);
$personController = new \controller\PersonController($newMemberView, $personModel, $boatModel, $addBoatView, $selectedView, $updateMember, $UpdateBoatView);
$mainController = new \controller\MainController($personController, $layoutView, $newMemberView, $listOfMemberView, $addBoatView, $selectedView, $updateMember, $UpdateBoatView);
$mainController->render();