<?php 

namespace view;

class UpdateMemberView
{

    private static $goBack = 'UpdateMember::back';
    private static $update = 'UpdateMember::Update';
    private static $newName = 'UpdateMember::newUserName';
    private static $newSocialSecurity = 'UpdateMember::newSocialSecurity';
    private static $newId = 'UpdateMember::newId';


    private static $name;
    private static $id;
    private static $socialSecurity;


    /**
     * creates a form
     * 
     * @return String
     */
    public function renderUpdateMemberForm()
    {

        self::$name = $_POST['name'];
        self::$id = $_POST['id'];
        self::$socialSecurity = $_POST['socialSecurity'];

        return '
        <form method="post">
            <div class="form-group">
                <label class="form-text text-muted" ></label>Member Name</label>
                <input  class="form-control"   id="' . self::$newName . '" name="' . self::$newName . '" value="' . self::$name . '">
            </div>
            <div class="form-group">
                <label class="form-text text-muted" ></label>Social Security Number</label>
                <input  class="form-control" id="' . self::$newSocialSecurity . '" name="' . self::$newSocialSecurity . '" value="' . self::$socialSecurity . '">
            </div>
            <div class="form-group">
                <label class="form-text text-muted" ></label>ID</label>
                <input  readonly class="form-control" id="' . self::$newId . '" name="' . self::$newId . '" value="' . self::$id . '">
            </div>
            <input  class="btn btn-primary" type="submit" name="' . self::$update . '" value="update" />
            <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$goBack . '" value="back" />
        </form>';
    }

    /**
     * check if member wants to update
     * 
     * @return bool
     */
    public function lookForPost() : bool
    {
        return !empty($_POST[self::$update]);
    }

    /**
     * return the new name
     * 
     * @return String
     */
    public function getUpdatedName()
    {
        if (isset($_POST[self::$newName])) {
            return $_POST[self::$newName];
        }
    }

    /**
     * returns the new social security number
     * 
     * @return String
     */
    public function getUpdatedSocialSecurity()
    {
        if (isset($_POST[self::$newSocialSecurity])) {

            return $_POST[self::$newSocialSecurity];
        }
    }

    /**
     * return the member id
     * 
     * @return String
     */
    public function getMemberId()
    {
        if (isset($_POST[self::$newId])) {

            return $_POST[self::$newId];
        }
    }

}


