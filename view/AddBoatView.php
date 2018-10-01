<?php

namespace view;

class AddBoatView
{
  private static $length = 'AddBoatView::length';
  private static $addBoat = 'AddBoatView::addBoat';


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
  
  public function lookForPost() : bool
  {
    return isset($_POST[self::$addBoat]);
  }

  /**
   *  
   * return the chosen boat type option
   * 
   * @return String
   */
  
  public function getBoatType() : string
  {
    if (isset($_POST['option'])) {
      return $_POST['option'];
    }
  }
  /**
   * return the length of a boat
   * 
   * @return Int
   */
  
  public function getLength() : int
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
  
  public function getMemberId() : string
  {
    return $_POST['memberId'];
  }
  
}