<?php

require_once 'controller/MainController.php';
require_once 'controller/BoatController.php';
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
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$boatModel = new \model\BoatModel();
$memberModel = new \model\MemberModel();

$addNewMemberView = new \view\AddNewMemberView();
$UpdateBoatView = new \view\UpdateBoatView();
$layoutView = new \view\LayoutView();
$addBoatView = new \view\AddBoatView();
$updateMember = new \view\UpdateMemberView();
$boatListView = new \view\BoatListView($boatModel);
$selectedMemberView = new \view\SelectedMemberView($boatModel);
$listOfMemberView = new \view\ListOfMemberView($memberModel, $boatModel);


$boatController = new \controller\BoatController($addBoatView,$boatModel, $boatListView, $UpdateBoatView, $selectedMemberView);
$memberController = new \controller\MemberController($addNewMemberView, $memberModel, $selectedMemberView, $updateMember);


$mainController = new \controller\MainController($memberController,$boatController, $layoutView, $addNewMemberView, $listOfMemberView, $addBoatView, $selectedMemberView, $updateMember, $UpdateBoatView, $boatListView);
$mainController->render();