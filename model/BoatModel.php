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

  public function fetchBoatData($user) {
    include('database/firebase.php');
    $value = $firebase->get('/users' . '/' . $user . '/boats', array());

      return $value;
  }
}