<?php 

namespace model;

require_once('database/firebase.php');

class BoatModel {

  private $type;
  private $length;
  private $person;

  public function __construct()
  {
    $this->server = new \database\Server();
    $this->firebase = $this->server->firebase(); 
  }

  public function reciveBoatData($type, $length, $person) {
    
    $this->type = $type;
    $this->length = $length;
    $this->person = $person;
    
  }

  public function addBoatToPerson() {
    $hash = md5($this->type . $this->length . rand(1, 999));
    $boatInfo = array(
      "Type" => $this->type,
      "Length" => $this->length,
      "ID" => $hash
    );
    $this->firebase->update('/users' . '/' . $this->person . '/boats' . '/' . $hash, $boatInfo);
  }

  public function fetchBoatData($id) {
    $value = $this->firebase->get('/users' . '/' . $id . '/boats', array());
    return $value;
  }

  public function updateBoatData($type, $length, $boatId, $id) {

    //var_dump($id);
    $boatInformation = array(
      "Type" => $type,
      "length" => $length,
    );
    $this->firebase->update('/users' . '/' . $id . '/boats' . '/' . $boatId, $boatInformation);
  }



  public function countBoats($boats) {
    if($this->checkNull($boats) == false) {
      $boatArray = json_decode($boats, true);
      if($this->checkNull($boatArray) == true) {
        $boatArray = 0;
        return $boatArray;
      }
      $amountOfBoats = count(array_keys($boatArray));
      return $amountOfBoats;  
    }

  }
  private function checkNull($value) {
     if ($value == null) {
       return true;
     }
    return false;
  }
  
}