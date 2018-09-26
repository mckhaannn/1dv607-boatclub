<?php

namespace view;

class LayoutView
{
    public function __construct()
    {   
        
    }   
    
    public function renderLayoutView($newMemberView, $listOfMemberView, $addBoatView, $selectedViews, $updateMemeber)
    {
        

        $boatView = null;
        $selectedView = null;
        $updateMemeberView = null;
        $createMember = $newMemberView->renderAddNewMemberForm();
        $showMemberList = $listOfMemberView->renderListOfMembers();
        
        if(isset($_POST['edit'])) {
            $createMember = null;
            $showMemberList = null;
            
            $selectedView = $selectedViews->generateSelectedMemberL();
            $boatView = $addBoatView->generateBoatForm();
            
        }
        if(isset($_POST['updateUser'])) {
            echo'dsad';
            $boatView = null;
            $selectedView = null;
            $createMember = null;
            $showMemberList = null;
            // $createMember = $newMemberView->renderAddNewMemberForm();
            $updateMemeberView = $updateMemeber->renderEditHtml();

        }

    //     if(isset($_POST['addBoat'])) {
    //         $boatView = $addBoatView->generateBoatForm();
    //    }

        /**if(isset($_POST['delete'])){
            echo 'deleteTest';
        }**/
        


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
                  ' . $createMember . '

                  <br/>
                  <br/>

                  ' . $showMemberList . '
                  <br/>
                    '  . $selectedView .  '

                    '  . $boatView .  '

                    '  . $updateMemeberView .  '

              </div>
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
                </body>
      </html>
  ';
    }   
}
