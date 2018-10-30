<?php

namespace view;

require_once('model/Boat.php');

class AddBoatView
{
  private static $length = 'AddBoatView::length';
  private static $addBoat = 'AddBoatView::addBoat';
  private static $optionPost = 'option';
  private static $memberIdPost = 'memberId';

  /**
   * 
   * creates add boat form
   * 
   * @return String
   */
  public function generateAddBoatForm()
  {
    return '
    <form method="post">
      <select name="option" class="form-control">
        <option id="sailBoat" name="sailBoat" value="Sailboat">Sailboat</option>
        <option value="Motorsailer">Motorsailer</option>
        <option value="kayak/Canoe">kayak/Canoe</option>
        <option value="Other">Other</option>
      </select>
      <div class="form-group">
          <input type="hidden" name="memberId" value="' . $_POST['memberId'] . '">
          <label for="' . self::$length . '">Enter Length</label>
          <input type="text" class="form-control"  id="' . self::$length . '" name="' . self::$length . '" placeholder="ex. 4m">
      </div>
      <input type="submit" name="' . self::$addBoat . '" value="Add new boat" class="btn btn-success ml-2" />
  </form> ';

  }

  /**
   * 
   * check if there is a post on addboat
   * 
   * @return Bool
   */

  public function lookForPost()
  {
    return isset($_POST[self::$addBoat]);
  }

  /**
   *  
   * return the chosen boat type option
   * 
   * @return String
   */

  public function getBoatType()
  {
    if (isset($_POST[self::$optionPost])) {
      return $_POST[self::$optionPost];
    }
  }
  /**
   * return the length of a boat
   * 
   * @return 
   */

  public function getLength()
  {
    if (isset($_POST[self::$length])) {
      return $_POST[self::$length];
    }
  }
  /**
   * 
   * return member id
   * 
   * @return String
   */

  public function getMemberId()
  {
    if (isset($_POST[self::$memberIdPost])) {
      return $_POST[self::$memberIdPost];
    }
  }

  public function getCreatedBoat($id)
  {
    return new \model\Boat($this->getBoatType(), $this->getLength(), $id);
  }

}