<?php

namespace view;

class AddBoatView
{

  private static $type = 'AddBoatView::type';
  private static $length = 'AddBoatView::length';
  private static $addBoat = 'AddBoatView::addBoat';



  public function generateBoatForm()
  {

    if (!empty($_REQUEST[self::$addBoat])) {
      $this->getType();

    }

    return '
    <form method="post">
      <select name="option" class="form-control">
        <option id="sailBoat" name="sailBoat" value="Sailboat">Sailboat</option>
        <option value="Motorsailer">Motorsailer</option>
        <option value="kayak/Canoe">kayak/Canoe</option>
        <option value="Other">Other</option>
      </select>
      <div class="form-group">
          <input type="hidden" name="selectedName" value="' . $_POST['name'] . '">
          <label for="' . self::$length . '">Enter Length</label>
          <input type="text" class="form-control"  id="' . self::$length . '" name="' . self::$length . '" placeholder="ex. 4m">
      </div>
      <input type="submit" name="' . self::$addBoat . '" value="Add new boat" class="btn btn-success ml-2" />
  </form> ';

  }

  public function lookForPost() {
    
    return !empty($_POST[self::$addBoat]);
  }

  public function getType() {
    if(isset($_POST['option'])) {
      return $_POST['option'];
    }
  }
  public function getLength() {
    if(isset($_POST[self::$length])) {
      return $_POST[self::$length];
    }
  }
  public function getName() {
    return $_POST['selectedName'];
  }
}