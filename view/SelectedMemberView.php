<?php 

namespace view;

class SelectedMemberView
{

  private static $goBack = 'SelectedMemberView::goBack';
  private static $name;
  private $names;
  private static $id;
  private static $socialSecurity;

  public function generateSelectedMemberL()
  {
    self::$name = $_POST['name'];
    self::$id = $_POST['id'];
    self::$socialSecurity = $_POST['socialSecurity'];
    $this->names = self::$name;
    echo $this->names;

    return '
      <form method="post">
      <div class="card">
      <h3 id="' . self::$name . '" name="' . self::$name . '" value="' . self::$name . '" >' . self::$name . '</h3>
      <h4 class="title"> ID : ' . self::$id . '</h4>
      <p>' . self::$socialSecurity . '</p>
      <p>Boats : 0</p>
      </div>

      <input  class="btn btn-primary" type="submit" name="" value="edit" />
      <input  class="btn btn-primary" type="submit" name="addBoat" value="addBoat" />
      <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$goBack . '" value="back" />

      </form>
  ';
  }


}