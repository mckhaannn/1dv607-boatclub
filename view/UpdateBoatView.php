<?php


namespace view;

class UpdateBoatView
{

    private static $goBack = 'UpdateBoatView::back';
    private static $updateBoat = 'UpdateBoatView::updateBoat';
    private static $newType = 'UpdateBoatView::newType';
    private static $newLength = 'UpdateBoatView::newLength';
    private static $newId = 'UpdateBoatView::newId';
    private static $newPersonId = 'UpdateBoatView::newPersonId';

    private static $type;
    private static $length;
    private static $id;
    private static $personId;

    public function renderEditHtml()
    {


        self::$type = $_POST['type'];
        self::$length = $_POST['length'];
        self::$id = $_POST['boatId'];
        self::$personId = $_POST['personId'];

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
        <div class="form-group">
        <label class="form-text text-muted" ></label>ID</label>
        <input  readonly class="form-control" id="' . self::$newPersonId . '" name="' . self::$newPersonId . '" value="' . self::$personId . '">
    </div>
        <input  class="btn btn-primary" type="submit" name="' . self::$updateBoat . '" value="updateBoat" />
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$goBack . '" value="back" />
    </form>';
    }

    public function lookForPost() : bool
    {
        return !empty($_POST[self::$updateBoat]);
    }


    public function getUpdatedType()
    {
        if (isset($_POST['option'])) {
            return $_POST['option'];
        }
    }

    public function getUpdatedLength()
    {
        if (isset($_POST[self::$newLength])) {
            return $_POST[self::$newLength];
        }
    }

    public function getId()
    {
        if (isset($_POST[self::$newId])) {
            return $_POST[self::$newId];
        }
    }

    public function personId()
    {
        var_dump($_POST[self::$newPersonId]);
        if (isset($_POST[self::$newPersonId])) {
            var_dump($_POST[self::$newPersonId]);
            return $_POST[self::$newPersonId];
        }
    }
}