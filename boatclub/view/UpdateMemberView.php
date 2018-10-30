<?php 

namespace view;

class UpdateMemberView
{

    private static $goBack = 'UpdateMember::back';
    private static $update = 'UpdateMember::Update';
    private static $newName = 'UpdateMember::newUserName';
    private static $newSocialSecurity = 'UpdateMember::newSocialSecurity';
    private static $message = 'UpdateMember::Message';
    private static $newId = 'UpdateMember::newId';
    private static $namePost = 'name';
    private static $idPost = 'id';
    private static $socialSecurityPost = 'socialSecurity';

    private const SOCIALSECURITY_IS_NAN_MESSAGE = 'Social security must be a number!';
    private const SOCIALSECURTY_LENGTH_NOT_VALID_MESSAGE = 'Social security must be 12 digits';
    private const EMPTY_STRING = '';
    private const SOCIALSECURITY_LENGTH = 12;
    private const VALUE_ZERO = 0;

    private static $name;
    private static $id;
    private static $socialSecurity;



    public function renderUpdateMemberForm()
    {
        $message = $this->getMessage();
        $response = $this->render($message);
        return $response;
    }

    public function getMessage()
    {
        $message = self::EMPTY_STRING;
        if (isset($_POST[self::$update])) {
            if (!$this->checkSocialSecurityLength()) {
                $message = self::SOCIALSECURTY_LENGTH_NOT_VALID_MESSAGE;
            } else if (!$this->isSocialSecurityValid()) {
                $message = self::SOCIALSECURITY_IS_NAN_MESSAGE;
            } else {
                $message = self::EMPTY_STRING;
            }
        }
        return $message;
    }


    /**
     * creates a form
     * 
     * @return String
     */
    public function render($message)
    {

        self::$name = $_POST[self::$namePost];
        self::$id = $_POST[self::$idPost];
        self::$socialSecurity = $_POST[self::$socialSecurityPost];

        return '
        <form method="post">
            <div class="form-group">
                <label class="form-text text-muted" ></label>Member Name</label>
                <input  class="form-control"   id="' . self::$newName . '" name="' . self::$newName . '" value="' . self::$name . '">
            </div>
            <div class="form-group">
                <label class="form-text text-muted" ></label>Social Security Number</label>
                <input  class="form-control" id="' . self::$newSocialSecurity . '" name="' . self::$newSocialSecurity . '" value="' . self::$socialSecurity . '">
                <small id="' . self::$message . '" class="form-text text-muted">' . $message . '</small>
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

    /**
     * return true if social security only contains numbers
     * @return bool
     */
    public function isSocialSecurityValid()
    {
        $value = $_POST[self::$newSocialSecurity];
        if (is_numeric($value) && $value > self::VALUE_ZERO && $value == round($value, self::VALUE_ZERO)) {
            return true;
        }
    }

    /**
     * social security must be 12 numbers
     * 
     * @return bool
     */
    public function checkSocialSecurityLength()
    {
        return strlen($_POST[self::$newSocialSecurity]) == self::SOCIALSECURITY_LENGTH;
    }

    public function getUpdatedMember()
    {
        return new \model\Member($this->getUpdatedName(), $this->getUpdatedSocialSecurity(), $this->getMemberId());
    }


}


