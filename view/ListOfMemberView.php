<?php

namespace view;

class ListOfMemberView
{
    private static $delete = 'ListOfMemberView::delete';
    private static $edit = 'ListOfMemberView::edit';
    private static $back = 'ListOfMemberView::back';
    private static $username = 'ListOfMemberView::username';
    private static $editPerson = 'ListOfMemberView::editPerson';
    private static $addBoat = 'ListOfMemberView::addBoat';
    private static $goBack = 'ListOfMemberView::goBack';


    private $personModel;
    private $boatModel;

    public function __construct(\model\PersonModel $personModel, \model\boatModel $boatModel)
    {
        $this->personModel = $personModel;
        $this->boatModel = $boatModel;
    }

    public function renderListOfMembers()
    {

        $response = $this->generateListHTMLList();

        return $response;
    }

    
    public function selectView() {
        if (isset($_GET['verbose'])) { 
           return $this->generateListOfPersonsVerbose();
        } else {
           return $this->generateListOfPersonsCompact();
        }        
    }
    private function boatInfoHTML($type, $length, $boatId) {
        return '
        <div class="list-group">
        <br>
    <a href="#" class="list-group-item list-group-item-action flex-coalign-items-start active">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Boat</h5>
          </div>
          <p class="mb-1">Type: ' . $type . '</p>
          <p class="mb-1">Lenght: ' . $length . '</p>
          <small>ID: ' . $boatId . '</small>
        </a>
      </div>
        ';
    }

    private function generateBoatInfoList($id) {
        $html = "";
        $boatInfo =  $this->boatModel->fetchBoatData($id);
        $decodedBoatInfo = json_decode($boatInfo, true);
        foreach ($decodedBoatInfo as $key) {
            $type = $key['Type'];
            $lenght = $key['Lenght'];
            $boatId = $key['ID'];
            $html .= $this->boatInfoHTML($type, $lenght, $boatId);
        }
        return $html;
    }
    private function generateListOfPersonsVerbose()
    {

        $values = $this->personModel->fetchData();
        $userData = json_decode($values, true); 

        $html = "";

        foreach ($userData as $key) {
            $this->name = $key['Name'];
            $this->ID = $key['ID'];
            $this->socialSecurity = $key['SocialSecurity'];   
            $html .= $this->createMemberListVerbose($this->name, $this->ID, $this->socialSecurity, $this->generateBoatInfoList($this->ID));
        };
        return $html;
    }

    private function generateListOfPersonsCompact()
    {
        $values = $this->personModel->fetchData();
        $userData = json_decode($values, true);

        $html = "";

        foreach ($userData as $key) {
            $this->name = $key['Name'];
            $this->ID = $key['ID'];
            $this->socialSecurity = $key['SocialSecurity'];
            $numberOfBoats = $this->boatModel->countBoats($this->boatModel->fetchBoatData($key['ID']));
            $html .= $this->createMemberListCompact($this->name, $this->ID, $this->socialSecurity, $numberOfBoats);
        };
        return $html;
    }
    
    
    /*
    Foreach member in DB return listObject
     */

    public function renderListitems()
    {
        if (isset($_GET['verbose'])) {
            return '
            <th>Name</th>
            <th>Social Security</th>
        <th>ID</th>
        <th></th>
            <th>Boats</th>
            <th></th>
            <th>Edit</th>
            <th>Delete</th>
            ';
        } else  {
            return '
            <th>Name</th>
            <th>ID</th>
            <th> Number of boats</th>
            <th></th>
            <th>Edit</th>
            <th>Delete</th>
            ';

        }
    }


    public function createMemberListCompact($name, $id, $socialSecurity, $numberOfBoats)
    {
        return '
          <form method="post">
          <tr>
          <td value="' . $name . '">' . $name . '</td>
          <td>' . $id . '</td>
          <td class="text-center">' . $numberOfBoats . '</td>
          <td></td>
          <td>
          <input type="hidden" name="name" value="' . $name . '">
          <input type="hidden" name="id" value="' . $id . '">
          <input type="hidden" name="socialSecurity" value="' . $socialSecurity . '">
          <input  class="btn btn-primary btn-xs " type="submit" name="edit" value="edit"
          </td>
          <td>
          <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$delete . '" value="delete" />
          </td>
      </tr>
      </form>
          ';
    }


    public function createMemberListVerbose($name, $id, $socialSecurity, $boatList)
    {
    return '
        <form method="post">
        <tr>
        <td value="' . $name . '">' . $name . '</td>
        <td>' . $socialSecurity . '</td>
        <td>' . $id . '</td>
        <td></td>
        <td>' . $boatList . '</td>
        <td>
        <input type="hidden" name="name" value="' . $name . '">
        <input type="hidden" name="id" value="' . $id . '">
        <input type="hidden" name="socialSecurity" value="' . $socialSecurity . '">
         </td>
        <td>
        <input  class="btn btn-primary btn-xs " type="submit" name="edit" value="edit"/>     
        </td>
        <td>
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$delete . '" value="delete" />
        </td>
    </tr>
    </form>';
    }

    private function generateListHTMLList()
    {
        return '
  <div class=container>
  <div class=row>        
          <h3>List of members</h3>
          <div class="dropdown show mb-3 ml-3">
    <a class="btn btn-secondary dropdown-toggle btn-xs" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Select List
    </a>
   
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <form method="post">
     <a name="compact" class="dropdown-item" href="?compact">Compact List</a>
     <a name="verbose" class="dropdown-item" href="?verbose">Verbose List</a>
    </form> 
    </div>
  </div>
  </div>
  </div>
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="table-responsive">
                          <table id="mytable" class="table table-bordred table-striped">
                              <thead>
                                ' . $this->renderListitems() . '
                              <td>
                            </thead>

                              <tbody>
                              ' . $this->selectView() . '
                              </tbody>
                              
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          ';
    }

    public function lookForPost()
    {
        return !empty($_POST[self::$delete]);
    }

}

