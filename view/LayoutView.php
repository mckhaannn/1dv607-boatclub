<?php

namespace view;

class LayoutView
{
    public function __construct()
    {
    }

    public function renderLayoutView($newMemberView, $listOfMemberView)
    {
        $createMember = $newMemberView->renderAddNewMemberForm();
        $showMemberList = $listOfMemberView->renderListOfMembers();

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
                  <hr>
                  ' . $showMemberList . '
              </div>
              
          </body>
      </html>
  ';
    }
}
