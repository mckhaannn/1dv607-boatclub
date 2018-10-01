<?php

require_once 'controller/MainController.php';
require_once 'controller/MemberController.php';
require_once 'model/BoatModel.php';
require_once 'model/MemberModel.php';
require_once 'view/AddBoatView.php';
require_once 'view/AddNewMemberView.php';
require_once 'view/BoatListView.php';
require_once 'view/LayoutView.php';
require_once 'view/ListOfMemberView.php';
require_once 'view/SelectedMemberView.php';
require_once 'view/UpdateBoatView.php';
require_once 'view/UpdateMemberView.php';
//MAKE SURE ERRORS ARE SHOWN.sd MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$addNewMemberView = new \view\AddNewMemberView();
$boatModel = new \model\BoatModel();
$boatListView = new \view\BoatListView($boatModel);
$UpdateBoatView = new \view\UpdateBoatView();
$selectedMemberView = new \view\SelectedMemberView($boatModel);
$memberModel = new \model\MemberModel();
$layoutView = new \view\LayoutView();
$addBoatView = new \view\AddBoatView();
$updateMember = new \view\UpdateMemberView();
$listOfMemberView = new \view\ListOfMemberView($memberModel, $boatModel);
$memberController = new \controller\memberController($addNewMemberView, $memberModel, $boatModel, $addBoatView, $selectedMemberView, $updateMember, $UpdateBoatView);
$mainController = new \controller\MainController($memberController, $layoutView, $addNewMemberView, $listOfMemberView, $addBoatView, $selectedMemberView, $updateMember, $UpdateBoatView, $boatListView);
$mainController->render();