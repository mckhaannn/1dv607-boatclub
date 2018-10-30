<?php

namespace view;

class AddNewMemberView
{
    private static $add = 'AddNewMemberView::Add';
    private static $name = 'AddNewMemberView::UserName';
    private static $socialSecurity = 'AddNewMemberView::SocialSecurity';
    private static $message = 'AddNewMemberView::Message';


    private const SOCIALSECURITY_IS_NAN_MESSAGE = 'Social security must be a number!';
    private const SOCIALSECURTY_LENGTH_NOT_VALID_MESSAGE = 'Social security must be 12 digits';
    private const SOCIALSECURITY_LENGTH = 12;
    private const EMPTY_STRING = '';
    private const VALUE_ZERO = 0;


    public function generateAddNewMemberForm()
    {
        $message = $this->getMessage();
        $response = $this->render($message);
        return $response;
    }

    public function getMessage()
    {
        $message = self::EMPTY_STRING;
        if (isset($_POST[self::$add])) {
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
     * creates a form to add a new member
     * 
     * @return String
     */
    public function render($message)
    {
        return '
        <form method="post">
            <div class="form-group">
                <label for="' . self::$name . '">Member Name</label>
                <input type="text" class="form-control"  id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getName() . '" aria-describedby="nameHelp" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label class="form-text text-muted" for="' . self::$socialSecurity . '">Social Security Number</label>
                <input type="text" class="form-control"  id="' . self::$socialSecurity . '" name="' . self::$socialSecurity . '" placeholder="xxxxxxxx-xxxx">
                <small id="' . self::$message . '" class="form-text text-muted">' . $message . '</small>
            </div>
            <input type="submit" name="' . self::$add . '" value="Add new member" class="btn btn-success ml-2" />
        </form>';
    }


    /**
     * check for post on add
     * 
     * @return Bool 
     */
    public function lookForPost() : bool
    {
        return !empty($_POST[self::$add]);
    }

    /**
     * validates the entered credentials
     * 
     * @return Bool
     */
    public function validNameAndSocialSecurity() : bool
    {
        return !empty($_POST[self::$name]) && !empty($_POST[self::$socialSecurity]);
    }

    /**
     * return the name 
     * 
     * @return String
     */
    public function getName()
    {
        if (isset($_POST[self::$name])) {
            return $_POST[self::$name];
        }
    }

    /**
     * return the socialSecurity number
     * 
     * @return Int
     */
    public function getSocialSecurity()
    {
        if (isset($_POST[self::$socialSecurity])) {
            return $_POST[self::$socialSecurity];

        }
    }

    /**
     * return true if social security only contains number
     */
    public function isSocialSecurityValid()
    {
        $value = $_POST[self::$socialSecurity];
        if (is_numeric($value) && $value > 0 && $value == round($value, self::VALUE_ZERO)) {
            return true;
        }
    }

    /**
     * social security must be 12 numbers
     * 
     * @return bool
     */
    public function checkSocialSecurityLength() : bool
    {
        return strlen($_POST[self::$socialSecurity]) == self::SOCIALSECURITY_LENGTH;
    }

    public function getCreatedMember($id)
    {
        return new \model\Member($this->getName(), $this->getSocialSecurity(), $id);
    }

}