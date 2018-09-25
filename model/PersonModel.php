<?php 

namespace model;

class PersonModel {

  private $name;
  private $socialSecurity;

  public function recivePersonData($name, $socialSecurity) {
    $this->name = $name;
    $this->socialSecurity = $socialSecurity;

  }

  public function addNewPersonToDatabase() {
    $hash = md5($this->name);
    include('database/firebase.php');
    $personInformation = array(
      "Name" => $this->name,
      "Social Security" => $this->socialSecurity,
      "ID" => $hash
    );
    $firebase->update('/users' . '/' . $this->name, $personInformation);
  }

  public function updatePersonData() {
    include('database/firebase.php');
    $personInformation = array(
      "Name" => $this->name,
      "Social Security" => $this->socialSecurity,
      "ID" => 7
    );
    $firebase->update('/users' . '/' . $this->name, $personInformation);
  }
}