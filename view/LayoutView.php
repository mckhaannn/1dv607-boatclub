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

    public function getVariablesToLayoutView($memberView, $listOfMemberView, $addBoatView, $selectedViews, $updateMember, $updateBoat)
    {
        $this->memberView = $memberView;
        $this->listOfMemberView = $listOfMemberView;
        $this->addBoatView = $addBoatView;
        $this->selectedViews = $selectedViews;
        $this->updateMember = $updateMember;
        $this->updateBoat = $updateBoat;
    }

    public function showLayout() {
        $html = "";
         if (isset($_POST['edit'])) {
            $html .= $this->selectedViews->render();
            $html .=$this->addBoatView->generateBoatForm();
        } else if (isset($_POST['updateUser'])) {
            $html = $this->updateMember->renderEditHtml();
        } else if (isset($_POST['editBoat'])) {
            $html = $this->updateBoat->renderEditHtml();
        } else {
            $html .= $this->memberView->renderAddNewMemberForm();
            $html .= $this->listOfMemberView->renderListOfMembers();
        }
        return $html;
    }



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
