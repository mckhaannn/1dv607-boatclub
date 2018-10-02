<?php

namespace view;

class BoatListView {

  private static $deleteBoat = 'selectedMemberView::deleteBoat';
  // private static $editBoat = 'selectedMemberView::editBoat';
  private $boatModel;
  
  public function __construct(\model\BoatModel $boatModel)
  {
    $this->boatModel = $boatModel;    
  }


  /**
   * Creates a table with a list of boats
   * 
   * @return String
   */
  public function generateBoatTable() {
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
                         ' . $this->fetchBoatInforamtion() . '
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <br>

    ';
  }
  
  /**
   * 
   * Fetch boat information and creates a list of boats
   * 
   * @return String
   */
  private function fetchBoatInforamtion() {
    $html = "";
    $boatData = $this->boatModel->fetchBoatData($this->getMemberId());
    $decodedBoatData =  json_decode($boatData, true);
    foreach ($decodedBoatData as $key) {
      $type = $key['Type'];
      $length = $key['Length'];
      $id = $key['ID'];
      $html .= $this->generateBoatList($type, $length, $id, $this->getMemberId());
    }
    return $html;
  }


  /**
   * 
   * creates a list of boats
   * 
   * @return String
   */
  public function generateBoatList($type, $length, $id, $memberId)
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
        <input type="hidden" name="memberId" value="' . $memberId . '">
        <button  class="btn btn-primary btn-xs " type="submit" name="editBoat">edit</button>
        </td>
        <td>
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$deleteBoat . '" value="deleteBoat" />
        </td>
    </tr>
    </form>
        ';
  }

  /**
   * returns member id
   * 
   * @return String
   */
  public function getMemberId() {    
    if(isset($_POST['memberId'])) {
      return $_POST['memberId'];
    }
  }
  public function getBoatId() {
    return $_POST['boatId'];
  }
  
  /*
  * check if member wants to delete
  *
  * @return 
  */

  public function lookForDeletePost() : bool
  {
      return isset($_POST[self::$deleteBoat]);
  }

}