<?php 

namespace view;

class SelectedMemberView
{


  private static $goBack = 'SelectedMemberView::goBack';
  private static $member;
  private static $id;
  private static $socialSecurity;
  private $boatModel;

  public function __construct(\model\BoatModel $boatModel)
  {
    $this->boatModel = $boatModel;
  }

  /**
   * Display information on a selected member
   *  
   * @return String
   */
  public function renderSelectedMember()
  {
    self::$member = $_POST['member'];
    self::$id = $_POST['memberId'];
    self::$socialSecurity = $_POST['socialSecurity'];

    return '
      <form method="post">
        <div class="card">
          <h3 id="' . self::$member . '" name="' . self::$member . '" value="' . self::$member . '" >' . self::$member . '</h3>
          <h4 class="title"> ID : ' . self::$id . '</h4>
          <p>' . self::$socialSecurity . '</p>
          <input type="hidden" name="name" value="' . self::$member . '">
          <input type="hidden" name="id" value="' . self::$id . '">
          <input type="hidden" name="socialSecurity" value="' . self::$socialSecurity . '">
          <input  class="btn btn-primary" type="submit" name="updateUser" value="Update" />
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$goBack . '" value="back" />
          </div>
      </form>

      ';
  }

 /**
  * return member id
  *
  * @return String
  */
  public function getMemberId()
  {
    if (isset($_POST['id'])) {
      return $_POST['id'];
    }
  }

  /**
   * return boat id
   * 
   * @return String
   */
  public function getBoatId()
  {
    if (isset($_POST['boatId'])) {
      return $_POST['boatId'];
    }
  }

  

}