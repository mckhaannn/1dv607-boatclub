<?php

namespace view;

class AddNewMemberView
{
    private static $add = 'AddNewMemberView::Add';
    private static $name = 'AddNewMemberView::UserName';
    private static $socialSecurity = 'AddNewMemberView::SocialSecurity';

    /**
     * creates a form to add a new member
     * 
     * @return String
     */
    public function generateAddNewMemberForm()
    {
        return '
        <form method="post">
            <div class="form-group">
                <label for="' . self::$name . '">Member Name</label>
                <input type="text" class="form-control"  id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getName() . '" aria-describedby="nameHelp" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="' . self::$socialSecurity . '">Social Security Number</label>
                <input type="text" class="form-control"  id="' . self::$socialSecurity . '" name="' . self::$socialSecurity . '" placeholder="xxxxxxxx-xxxx">
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
        if(isset($_POST[self::$name])) {
            return $_POST[self::$name];
        }
    }

    /**
     * return the socialSecurity number
     * 
     * @return Int
     */
    public function getSocialSecurity()  : int
    {   
        if(isset($_POST[self::$socialSecurity])) {
         return $_POST[self::$socialSecurity];
    
        }
    }

}