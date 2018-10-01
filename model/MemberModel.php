<?php 

namespace model;

require_once('database/firebase.php');

class MemberModel {

  private $member;
  private $socialSecurity;

  /**
   * initialize the database
   */
  public function __construct()
  {
    $this->server = new \database\Server();
    $this->firebase = $this->server->firebase();
  }

  /*
  * retrives data to use in other modules
  */  
  public function reciveMemberData($member, $socialSecurity) {
    $this->name = $member;
    $this->socialSecurity = $socialSecurity;
  }

  /**
   * adds a member to the database
   */
  public function addNewMemberToDatabase() {
    $hash = md5($this->name);
    $memberInformation = array(
      "Name" => $this->name,
      "SocialSecurity" => $this->socialSecurity,
      "ID" => $hash
    );
    $this->firebase->update('/users' . '/' . $hash, $memberInformation);
  }
  
  /**
   * updates a members information in the database
   */
  public function updateMemberData($member, $socialSecurity, $id) {

    $memberInformation = array(
      "Name" => $member,
      "SocialSecurity" => $socialSecurity,
    );
    $this->firebase->update('/users' . '/' . $id, $memberInformation);
  }

  /**
   * deletes a member from the database
   */
  public function deleteMember($id) {
    if($id != null) {
      $this->firebase->delete('/users' . '/' . $id);
    }
  }

  /**
   * fetch all data from the database
   */
  public function fetchData() {
    $value = $this->firebase->get('/users', array());

      return $value;
  }

}