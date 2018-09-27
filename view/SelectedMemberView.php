<?php 

namespace view;

class SelectedMemberView
{

  
  private static $goBack = 'SelectedMemberView::goBack';
  private static $edit = 'selectedMemberView::updateUser';
  // private static $newId = 'selectedMemberView::newId';
  private static $name;
  private static $id;
  private static $socialSecurity;
  private $names;
  private $boatModel;
  
  public function __construct(\model\BoatModel $boatModel)
  { 
    $this->boatModel = $boatModel;
  }

  public function generateSelectedMemberL()
  {
    self::$name = $_POST['name'];
    self::$id = $_POST['id'];
    self::$socialSecurity = $_POST['socialSecurity'];

    return '
      <form method="post">
        <div class="card">
          <h3 id="' . self::$name . '" name="' . self::$name . '" value="' . self::$name . '" >' . self::$name . '</h3>
          <h4 class="title"> ID : ' . self::$id . '</h4>
          <p>' . self::$socialSecurity . '</p>
          <p>Boats : 0</p>
          <input type="hidden" name="name" value="' . self::$name . '">
          <input type="hidden" name="id" value="' . self::$id . '">
          <input type="hidden" name="socialSecurity" value="' . self::$socialSecurity . '">
        </div>
        <input  class="btn btn-primary" type="submit" name="updateUser" value="Update" />
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$goBack . '" value="back" />
      </form>
      ';
  }

  public function generateBoatList() {
    return '
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
                              <th>ID</th>
                              <th>Type</th>
                              <th>Length</th>
                              <th></th>
                              <th>Edit</th>
                              <th>Delete</th>
                              </thead>
                              <tbody>
                              ' . $this->getBoatList() . '
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
    ';
  }
  private function getBoatList() {
    $html = "";
    $boatData = $this->$this->boatModel->fetchBoatData(self::$id);
    $decodedBoatData =  json_decode($boatData, true);
    foreach ($decodedBoatData as $key) {
      $type = $key['Type'];
      $length = $key['Lenght'];
      $id = $key['ID'];
      $html .= $this->createBoatList($type, $length, $id);
    }
    return $html;
  }

  public function createBoatList($type, $length, $id)
  {
      return '
        <form method="post">
        <tr>
        <td value="' . $type . '">' . $type . '</td>
        <td>' . $length . '</td>
        <td class="text-center">' . $id . '</td>
        <td></td>
        <td>
        <input type="hidden" name="name" value="' . $type . '">
        <input type="hidden" name="id" value="' . $id . '">
        <input type="hidden" name="socialSecurity" value="' . $length . '">
        <input  class="btn btn-primary btn-xs " type="submit" name="edit" value="edit" />
        </td>
        <td>
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$delete . '" value="delete" />
        </td>
    </tr>
    </form>
        ';
  }

  public function getId() {
    if(isset($_POST['id'])) {
      return $_POST['id'];
    }
  }

  

}