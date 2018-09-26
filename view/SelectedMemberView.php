<?php 

namespace view;

class SelectedMemberView
{

  private static $goBack = 'SelectedMemberView::goBack';
  private static $edit = 'selectedMemberView::updateUser';
  // private static $newId = 'selectedMemberView::newId';
  private static $name;
  private static $id;
  private static $socialSecurity;
  private $names;
  

  public function generateSelectedMemberL()
  {
    self::$name = $_POST['name'];
    self::$id = $_POST['id'];
    self::$socialSecurity = $_POST['socialSecurity'];

    return '
      <form method="post">
        <div class="card">
          <h3 id="' . self::$name . '" name="' . self::$name . '" value="' . self::$name . '" >' . self::$name . '</h3>
          <h4 class="title"> ID : ' . self::$id . '</h4>
          <p>' . self::$socialSecurity . '</p>
          <p>Boats : 0</p>
          <input type="hidden" name="name" value="' . self::$name . '">
          <input type="hidden" name="id" value="' . self::$id . '">
          <input type="hidden" name="socialSecurity" value="' . self::$socialSecurity . '">
        </div>
        <input  class="btn btn-primary" type="submit" name="updateUser" value="Update" />
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$goBack . '" value="back" />

      </form>';
  }

  public function getId() {
    if(isset($_POST['id'])) {
      return $_POST['id'];
    }
  }

  

}