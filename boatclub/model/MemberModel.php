<?php 

namespace model;

require_once('model/firebase.php');
require_once('model/Member.php');

class MemberModel
{

  private const NUMBER_SMALL = 1;
  private const NUMBER_BIG = 999;

  private $member;

  /**
   * initialize the database
   */
  public function __construct()
  {
    $this->server = new \model\Server();
    $this->firebase = $this->server->firebase();
    $this->meberList = array();
  }

  /*
   * retrives data to use in other modules
   */
  public function reciveMemberData($member)
  {
    $this->name = $member;
  }

  /**
   * adds a member to the database
   */
  public function addNewMemberToDatabase($member)
  {
    $memberInformation = array(
      "Name" => $member->getName(),
      "SocialSecurity" => $member->getSocialSecurity(),
      "ID" => $member->getId()
    );
    $this->firebase->update('/users' . '/' . $member->getId(), $memberInformation);
  }

  /**
   * updates a members information in the database
   */
  public function updateMemberData($member)
  {
    $memberInformation = array(
      "Name" => $member->getName(),
      "SocialSecurity" => $member->getSocialSecurity(),
    );
    $this->firebase->update('/users' . '/' . $member->getId(), $memberInformation);
  }

  /**
   * deletes a member from the database
   */
  public function deleteMember($id)
  {
    if ($id != null) {
      $this->firebase->delete('/users' . '/' . $id);
    }
  }

  public function getMemberList()
  {
    $this->createMemberlist();

    return $this->memberList;
  }

  public function createMemberlist()
  {
    $this->clearMemberList();
    $memberData = json_decode($this->fetchData());
    if (!$this->checkNull($memberData)) {
      foreach ($memberData as $key) {
        $member = new Member($key->Name, $key->SocialSecurity, $key->ID);
        array_push($this->memberList, $member);
      }
    }
  }

  /**
   * fetch all data from the database
   */

  public function fetchData()
  {
    $value = $this->firebase->get('/users', array());

    return $value;
  }

  private function clearMemberList()
  {
    $this->memberList = array();
  }

  private function checkNull($value)
  {
    if ($value == null) {

      return true;
    }

    return false;
  }

  public function generateMemberId()
  {
    return md5(rand(self::NUMBER_SMALL, self::NUMBER_BIG) . rand(self::NUMBER_SMALL, self::NUMBER_BIG) . rand(self::NUMBER_SMALL, self::NUMBER_BIG));
  }
}