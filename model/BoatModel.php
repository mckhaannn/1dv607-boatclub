<?php 

namespace model;

class BoatModel {

  private $type;
  private $length;
  private $person;

  public function reciveBoatData($type, $lenght, $person) {
    
    $this->type = $type;
    $this->lenght = $lenght;
    $this->person = $person;
    
  }

  public function addBoatToPerson() {
    include('database/firebase.php');
    $boatInfo = array(
      "Type" => $this->type,
      "Lenght" => $this->lenght,
      "ID" => rand(5, 153)
    );
    $firebase->push('/users' . '/' . $this->person . '/boats', $boatInfo);
  }

  public function fetchBoatData($id) {
    include('database/firebase.php');
    $value = $firebase->get('/users' . '/' . $id . '/boats', array());
    return $value;
  }



  public function countBoats($boats) {
    if($boats != null) {
      $boatArray = json_decode($boats, true);
      $amountOfBoats = count(array_keys($boatArray));
      return $amountOfBoats;  
    }

  }

}