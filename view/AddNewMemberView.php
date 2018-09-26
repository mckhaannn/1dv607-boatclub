<?php

namespace view;

class AddNewMemberView
{
    private static $add = 'AddNewMemberView::Add';
    private static $name = 'AddNewMemberView::UserName';
    private static $socialSecurity = 'AddNewMemberView::SocialSecurity';
    private static $message = '';

    public function __construct()
    {

    }
    public function renderAddNewMemberForm()
    {
       // self::$message = '';

        if (!empty($_POST)) {
            self::$message = 'Done!';
        } else {
            self::$message = 'Please fill in the form';
        }

        $response = $this->generateAddNewMemberFormHTML(self::$message);

        return $response;
    }

    private function generateAddNewMemberFormHTML($message)
    {
        return '
        <form method="post">
        <div class="form-group">
        <small id="' . self::$message . '" class="form-text text-muted">' . self::$message . '</small>
            <label for="' . self::$name . '">Member Name</label>
            <input type="text" class="form-control"  id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getName() . '" aria-describedby="nameHelp" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label for="' . self::$socialSecurity . '">Social Security Number</label>
            <input type="text" class="form-control"  id="' . self::$socialSecurity . '" name="' . self::$socialSecurity . '" placeholder="xxxxxxxx-xxxx">
        </div>
        <input type="submit" name="' . self::$add . '" value="Add new member" class="btn btn-success ml-2" />
    </form>
		';
    }



    public function lookForPost() : bool
    {
    
        if(!empty($_POST[self::$add])){
            // echo $this->getName();
        }
    
        return !empty($_POST[self::$add]);

    
    }

    public function validNameAndSocialSecurity() {
        return !empty($_POST[self::$name]) && !empty($_POST[self::$socialSecurity]);
    }

    public function getName() {
        if(isset($_POST[self::$name])) {
            return $_POST[self::$name];
        }
    }
    public function getSocialSecurity() {   
        if(isset($_POST[self::$socialSecurity])) {
         return $_POST[self::$socialSecurity];
    
        }
    }

}