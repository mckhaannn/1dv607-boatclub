<?php

require_once 'controller/MainController.php';
require_once 'controller/PersonController.php';
require_once 'view/AddNewMemberView.php';
require_once 'view/ListOfMemberView.php';
require_once 'view/LayoutView.php';
require_once 'model/PersonModel.php';
//MAKE SURE ERRORS ARE SHOWN.sd MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$layoutView = new \view\LayoutView();
$newMemberView = new \view\AddNewMemberView();
$listOfMemberView = new \view\ListOfMemberView();
$personModel = new \model\PersonModel();
$personController = new \controller\PersonController($newMemberView, $personModel);
$mainController = new \controller\MainController($personController, $layoutView, $newMemberView, $listOfMemberView);
$mainController->render();