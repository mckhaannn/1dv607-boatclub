<?php

namespace view;

class LayoutView
{
    private $memberView;
    private $listOfMemberView;
    private $addBoatView;
    private $selectedViews;
    private $updateMember;
    private $updateBoat;
    public function __construct()
    {

    }

    /**
     * retrives values
     * 
     * @return void
     */
    public function getVariablesToLayoutView($memberView, $listOfMemberView, $addBoatView, $selectedViews, $updateMember, $updateBoat,$boatListView)
    {
        $this->memberView = $memberView;
        $this->listOfMemberView = $listOfMemberView;
        $this->addBoatView = $addBoatView;
        $this->selectedViews = $selectedViews;
        $this->updateMember = $updateMember;
        $this->updateBoat = $updateBoat;
        $this->boatListView = $boatListView;
    }

    /**
     * decides what view to be shown
     * 
     * @return String
     */
    public function showLayout() {
        $html = "";
         if (isset($_POST['edit'])) {
            $html .= $this->selectedViews->renderSelectedMember();
            $html .= $this->boatListView->generateBoatTable();
            $html .=$this->addBoatView->generateAddBoatForm();
        } else if (isset($_POST['updateUser'])) {
            $html = $this->updateMember->renderUpdateMemberForm();
        } else if (isset($_POST['editBoat'])) {
            $html = $this->updateBoat->generateUpdateBoatForm();
        } else {
            $html .= $this->memberView->generateAddNewMemberForm();
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
