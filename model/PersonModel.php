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
    include('database/firebase.php');
    $hash = md5($this->name);
    $personInformation = array(
      "Name" => $this->name,
      "SocialSecurity" => $this->socialSecurity,
      "ID" => $hash
    );
    $firebase->update('/users' . '/' . $this->name, $personInformation);
  }

  public function updatePersonData() {
    include('database/firebase.php');
    $personInformation = array(
      "Name" => $this->name,
      "SocialSecurity" => $this->socialSecurity,
      "ID" => 7
    );
    $firebase->update('/users' . '/' . $this->name, $personInformation);
  }

  public function fetchData() {
    include('database/firebase.php');
    $value = $firebase->get('/users', array());

      return $value;
  }
}