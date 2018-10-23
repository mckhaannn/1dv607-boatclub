<?php

namespace view;

class LayoutView
{
    private static $editPost = 'edit';
    private static $updateUserPost = 'updateUser';
    private static $editBoatPost = 'editBoat';

    private const EMPTY_STRING = '';

    private $memberView;
    private $listOfMemberView;
    private $addBoatView;
    private $selectedViews;
    private $updateMember;
    private $updateBoat;

    /**
     * retrives values
     * 
     * @return void
     */
    public function getVariablesToLayoutView($addNewMemberView, $listOfMemberView, $addBoatView, $selectedMemberView, $updateMemberView, $updateBoatView, $boatListView)
    {
        $this->addNewMemberView = $addNewMemberView;
        $this->listOfMemberView = $listOfMemberView;
        $this->selectedMemberView = $selectedMemberView;
        $this->updateMemberView = $updateMemberView;
        $this->updateBoatView = $updateBoatView;
        $this->addBoatView = $addBoatView;
        $this->boatListView = $boatListView;
    }

    /**
     * decides what view to be shown
     * 
     * @return String
     */
    public function showLayout() {
        $html = self::EMPTY_STRING;
         if (isset($_POST[self::$editPost])) {
            $html .= $this->selectedMemberView->renderSelectedMember();
            $html .= $this->boatListView->generateBoatTable();
            $html .= $this->addBoatView->generateAddBoatForm();
        } else if (isset($_POST[self::$updateUserPost])) {
            $html = $this->updateMemberView->renderUpdateMemberForm();
        } else if (isset($_POST[self::$editBoatPost])) {
            $html = $this->updateBoatView->generateUpdateBoatForm();
        } else {
            $html .= $this->addNewMemberView->generateAddNewMemberForm();
            $html .= $this->listOfMemberView->generateInfoListHTML();
        }
        return $html;
    }


    /**
     * The base html of the program
     * 
     * @return echo
     */
    
    public function renderLayoutView()
    {
        echo '<!DOCTYPE html>
        <html>
          <head>
              <meta charset="utf-8">
              <title>The jolly pirate</title>
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
          </head>
          <body>

              <h1 class="text-center">Boat Club</h1>
              <div class="container">

            ' . $this->showLayout() . '                

              </div>
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
                </body>
      </html>
  ';
    }
}
