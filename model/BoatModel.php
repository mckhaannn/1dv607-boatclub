<?php 

namespace model;

require_once('database/firebase.php');

class BoatModel {

  private $type;
  private $length;
  private $person;

  /**
  * initialize the database
  */
  public function __construct()
  {
    $this->server = new \database\Server();
    $this->firebase = $this->server->firebase(); 
  }

  /**
   * retrives data to use in other modules
   */
  public function reciveBoatData($type, $length, $person) {
    
    $this->type = $type;
    $this->length = $length;
    $this->person = $person;
    
  }

  /**
   * adds a boat to a selected member in the database
   */
  public function addBoatToMember() {
    $hash = md5($this->type . $this->length . rand(1, 999));
    $boatInfo = array(
      "Type" => $this->type,
      "Length" => $this->length,
      "ID" => $hash
    );
    $this->firebase->update('/users' . '/' . $this->person . '/boats' . '/' . $hash, $boatInfo);
  }
  /**
   * fetch all boat data from a selected member
   */
  public function fetchBoatData($id) {
    $value = $this->firebase->get('/users' . '/' . $id . '/boats', array());
    return $value;
  }

  /**
   * deletes a selected boat i a selected member
   */
  public function deleteBoat($id, $boatId) {
    $this->firebase->delete('/users' . '/' . $id . '/boats' . '/' . $boatId);
  }

  /**
   * updates a boat in a selected member 
   */
  public function updateBoatData($type, $length, $boatId, $id) {
    
    $boatInformation = array(
      "Type" => $type,
      "length" => $length,
    );
    $this->firebase->update('/users' . '/' . $id . '/boats' . '/' . $boatId, $boatInformation);
  }


  /**
   * counts all boats in the selected member, if the member does not have a boat the set the the default value to 0
   * 
   * 
   */
  public function countBoats($boatDataFromMember) {
    if($this->checkNull($boatDataFromMember) == false) {
      
      $boatArray = json_decode($boatDataFromMember, true);
      
      if($this->checkNull($boatArray) == true) {
        $ammounOfBoats = 0;
        return $ammounOfBoats;
      }
      
      $amountOfBoats = count(array_keys($boatArray));
      return $amountOfBoats;  
    }
  }

  /**
   * check if a values is null
   */
  private function checkNull($value) {
     if ($value == null) {
       return true;
     }
    return false;
  }
}