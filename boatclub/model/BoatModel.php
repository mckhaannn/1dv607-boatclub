<?php 

namespace model;

require_once('model/firebase.php');
require_once('model/Boat.php');

class BoatModel
{

  private const NUMBER_SMALL = 1;
  private const NUMBER_BIG = 999;
  private const DEFAULT_BOATS = 0;


  private $boat;
  private $person;

  /**
   * initialize the database
   */
  public function __construct()
  {
    $this->server = new \model\Server();
    $this->firebase = $this->server->firebase();
    $this->boatList = array();
  }

  /**
   * retrives data to use in other modules
   */
  public function reciveBoatData($boat, $person)
  {

    $this->boat = $boat;
    $this->person = $person;

  }

  /**
   * adds a boat to a selected member in the database
   */
  public function addBoatToMember($boat, $memberID)
  {
    // $hash = md5($this->type . $this->length . rand(0, 100));
    $boatInfo = array(
      "Type" => $boat->getBoatType(),
      "Length" => $boat->getBoatLength(),
      "ID" => $boat->getId()
    );
    $this->firebase->update('/users' . '/' . $memberID . '/boats' . '/' . $boat->getId(), $boatInfo);
  }

  /**
   * fetch all boat data from a selected member
   */

  public function fetchBoatData($id)
  {
    return $this->firebase->get('/users' . '/' . $id . '/boats', array());
  }

  public function createBoatlist($id)
  {
    $this->clearBoatList();
    $boatData = json_decode($this->fetchBoatData($id));
    if (!$this->checkNull($boatData)) {
      foreach ($boatData as $key) {
        $boat = new Boat($key->Type, $key->Length, $key->ID);
        array_push($this->boatList, $boat);
      }
    }
  }

  public function getBoatList($id)
  {
    $this->createBoatlist($id);
    return $this->boatList;
  }

  private function clearBoatList()
  {
    $this->boatList = array();
  }

  /**
   * deletes a selected boat i a selected member
   */

  public function deleteBoat($id, $boatId)
  {
    $this->firebase->delete('/users' . '/' . $id . '/boats' . '/' . $boatId);
  }

  /**
   * updates a boat in a selected member 
   */

  public function updateBoatData($boat, $id)
  {

    $boatInformation = array(
      "Type" => $boat->getBoatType(),
      "Length" => $boat->getBoatLength(),
    );
    $this->firebase->update('/users' . '/' . $id . '/boats' . '/' . $boat->getId(), $boatInformation);
  }


  /**
   * counts all boats in the selected member, if the member does not have a boat set the the default value to 0
   */

  public function countBoats($id)
  {
    $boatData = $this->fetchBoatData($id);
    if ($this->checkNull($boatData) == false) {

      $boatArray = json_decode($boatData, true);

      if ($this->checkNull($boatArray) == true) {
        $ammounOfBoats = self::DEFAULT_BOATS;
        return $ammounOfBoats;
      }

      $amountOfBoats = count(array_keys($boatArray));
      return $amountOfBoats;
    }
  }

  private function checkNull($value)
  {
    if ($value == null) {
      return true;
    }
    return false;
  }

  public function generateBoatId()
  {
    return md5(rand(self::NUMBER_SMALL, self::NUMBER_BIG) . rand(self::NUMBER_SMALL, self::NUMBER_BIG) . rand(self::NUMBER_SMALL, self::NUMBER_BIG));
  }
}