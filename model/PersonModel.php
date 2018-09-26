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
    $firebase->update('/users' . '/' . $hash, $personInformation);
  }
  
  public function updatePersonData($name, $socialSecurity, $id) {

    include('database/firebase.php');
    $personInformation = array(
      "Name" => $name,
      "SocialSecurity" => $socialSecurity,
    );
    $firebase->update('/users' . '/' . $id, $personInformation);
  }

  public function deletePerson($id) {
    include('database/firebase.php');
    $firebase->delete('/users' . '/' . $id);
  }

  public function fetchData() {
    include('database/firebase.php');
    $value = $firebase->get('/users', array());

      return $value;
  }

}