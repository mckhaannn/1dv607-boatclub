<?php 

namespace view;

class SelectedMemberView
{

  
  private static $goBack = 'SelectedMemberView::goBack';
  private static $edit = 'selectedMemberView::updateUser';
  private static $delete = 'selectedMemberView::delete';
  private static $editBoat = 'selectedMemberView::editBoat';
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

  public function render()
  {

      $response = $this->generateSelectedMemberL();

      return $response;
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
          <input type="hidden" name="name" value="' . self::$name . '">
          <input type="hidden" name="id" value="' . self::$id . '">
          <input type="hidden" name="socialSecurity" value="' . self::$socialSecurity . '">
          <input type="hidden" name="userId" value="' . self::$id . '">
          <input  class="btn btn-primary" type="submit" name="updateUser" value="Update" />
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$goBack . '" value="back" />
          </div>
      </form>

      ' . $this->generateBoatList() . '

      ';
  }


  public function generateBoatList() {
    return '
      <div class="container">
      <br>

      <h5>Boats</h5>
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
      <br>

    ';
  }
  
  private function getBoatList() {
    $html = "";
    $boatData = $this->boatModel->fetchBoatData($this->getId());
    $decodedBoatData =  json_decode($boatData, true);
    foreach ($decodedBoatData as $key) {
      $type = $key['Type'];
      $length = $key['Length'];
      $id = $key['ID'];
      $html .= $this->createBoatList($type, $length, $id, $this->getId());
    }
    return $html;
  }

  public function createBoatList($type, $length, $id, $personId)
  {
      return '
        <form method="post">
        <tr>
        <td>' . $id . '</td>
        <td value="' . $type . '">' . $type . '</td>
        <td>' . $length . '</td>
        <td></td>
        <td>
        <input type="hidden" name="type" value="' . $type . '">
        <input type="hidden" name="boatId" value="' . $id . '">
        <input type="hidden" name="length" value="' . $length . '">
        <input type="hidden" name="personId" value="' . $personId . '">
        <button  class="btn btn-primary btn-xs " type="submit" name="editBoat" value="' . self::$id . '" >edit</button>
        </td>
        <td>
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$delete . '" value="delete" />
        </td>
    </tr>
    </form>
        ';
  }

  public function getId() {
    if(isset(self::$id)) {
      return $_POST['id'];
    }
  }

  public function userID() {
    if(isset($_POST['userId'])) {
      return $_POST['userId'];
    }
  }
}