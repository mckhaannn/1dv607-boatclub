<?php

namespace view;

class UpdateBoatView
{

    private static $goBack = 'UpdateBoatView::back';
    private static $updateBoat = 'UpdateBoatView::updateBoat';
    private static $newType = 'UpdateBoatView::newType';
    private static $newLength = 'UpdateBoatView::newLength';
    private static $deleteBoat = 'UpdateBoatView::deleteBoat';
    private static $newId = 'UpdateBoatView::newId';
    private static $newMemberId = 'UpdateBoatView::newMemberId';

    private static $type;
    private static $length;
    private static $id;
    private static $personId;


    /**
     * Creates a form to update a selected boat
     * 
     * @return String
     */
    
    public function generateUpdateBoatForm()
    {

        self::$type = $_POST['type'];
        self::$length = $_POST['length'];
        self::$id = $_POST['boatId'];

        return '
        <form method="post">
            <div class="form-group">    
                <select name="option" class="form-control">
                    <option value="Sailboat">Sailboat</option>
                    <option value="Motorsailer">Motorsailer</option>
                    <option value="kayak/Canoe">kayak/Canoe</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-text text-muted" ></label>Length</label>
                <input  class="form-control"   id="' . self::$newLength . '" name="' . self::$newLength . '" value="' . self::$length . '">
            </div>
            <div class="form-group">
                <label class="form-text text-muted" ></label>ID</label>
                <input  readonly class="form-control" id="' . self::$newId . '" name="' . self::$newId . '" value="' . self::$id . '">
            </div>
            <input  class="btn btn-primary" type="submit" name="' . self::$updateBoat . '" value="updateBoat" />
            <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$goBack . '" value="back" />
        </form>';
    }


    /**
     * check if member wants to update a boat
     * 
     * @return Bool
     */

    public function lookForPost() : bool
    {
        return !empty($_POST[self::$updateBoat]);
    }

    /**
     * return the chosen boat type option in the form
     * 
     * @return String
     */

    public function getUpdatedType() : string
    {
        if (isset($_POST['option'])) {
            return $_POST['option'];
        }
    }

    /**
     * return the new length of the boat
     * 
     * @return Int
     */

    public function getUpdatedLength() : int
    {
        if (isset($_POST[self::$newLength])) {
            return $_POST[self::$newLength];
        }
    }

    /**
     * return boat id
     * 
     * @return String
     */

    public function getBoatId() : string
    {
        if (isset($_POST[self::$newId])) {
            var_dump(self::$newId);
            return $_POST[self::$newId];
        }
    }
    
    /**
     * return member id
     * 
     * @return String
     */

    public function MemberId() : string
    {
        if (isset($_POST[self::$newMemberId])) {
            return $_POST[self::$newMemberId];
        }
    }

    /*
     * check if member wants to delete
     *
     * @return 
     */

    public function lookForDeletePost() : bool
    {
        return isset($_POST[self::$deleteBoat]);

    }
}