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

        $response = $this->generateListHTML();

        return $response;
    }

    private function generateListOfPersons()
    {
        $values = $this->personModel->fetchData();
        $userData = json_decode($values, true);

        $html = "";

        foreach ($userData as $key) {
            $this->name = $key['Name'];
            $this->ID = $key['ID'];
            $this->socialSecurity = $key['SocialSecurity'];
            $numberOfBoats = $this->boatModel->countBoats($this->boatModel->fetchBoatData($key['ID']));
            $html .= $this->createMemberListObject($this->name, $this->ID, $this->socialSecurity, $numberOfBoats);
        };
        return $html;
    }
    
    /*
    Foreach member in DB return listObject
     */


    public function createMemberListObject($name, $id, $socialSecurity, $numberOfBoats)
    {
      return '
          <form method="post">
          <tr>
          <td><input type="checkbox" class="checkthis" /></td>
          <td value="' . $name . '">' . $name . '</td>
          <td>' . $id . '</td>
          <td class="text-center">' . $numberOfBoats . '</td>
          <td></td>
          <td>
          <input type="hidden" name="name" value="' . $name . '">
          <input type="hidden" name="id" value="' . $id . '">
          <input type="hidden" name="socialSecurity" value="' . $socialSecurity . '">
          <input  class="btn btn-primary btn-xs " type="submit" name="edit" value="edit" />
          </td>
          <td>
          <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$delete . '" value="delete" />
          </td>
      </tr>
      </form>
          ';
    }
   
    private function generateListHTML()
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
      <a class="dropdown-item" href="#">Compact List</a>
      <a class="dropdown-item" href="#">Verbose List</a>
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
                                  <th><input type="checkbox" id="checkall" /></th>
                                  <th>Name</th>
                                  <th>ID</th>
                                  <th class="text-center">Number of boats</th>
                                  <th></th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </thead>
                              <tbody>
                              ' . $this->generateListOfPersons() . '
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

