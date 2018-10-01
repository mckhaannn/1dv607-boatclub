<?php 

namespace model;

require_once('database/firebase.php');

class PersonModel {

  private $name;
  private $socialSecurity;
  public function __construct()
  {
    $this->server = new \database\Server();
    $this->firebase = $this->server->firebase();
  }

  public function recivePersonData($name, $socialSecurity) {
    $this->name = $name;
    $this->socialSecurity = $socialSecurity;
  }

  public function addNewPersonToDatabase() {
    $hash = md5($this->name);
    $personInformation = array(
      "Name" => $this->name,
      "SocialSecurity" => $this->socialSecurity,
      "ID" => $hash
    );
    $this->firebase->update('/users' . '/' . $hash, $personInformation);
  }
  
  public function updatePersonData($name, $socialSecurity, $id) {

    $personInformation = array(
      "Name" => $name,
      "SocialSecurity" => $socialSecurity,
    );
    $this->firebase->update('/users' . '/' . $id, $personInformation);
  }

  public function deletePerson($id) {
    $this->firebase->delete('/users' . '/' . $id);
  }

  public function fetchData() {
    $value = $this->firebase->get('/users', array());

      return $value;
  }

}