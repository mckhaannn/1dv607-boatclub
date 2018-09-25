<?php

namespace view;

class ListOfMemberView
{
    private static $delete = 'AddNewMemberView::delete';
    private static $edit = 'AddNewMemberView::edit';
    private static $back = 'AddNewMemberView::back';

    private $name = 'Marc Larzon';
    private $personalNumber = '19930917-8037';
    private $id = '1';

    public function renderListOfMembers()
    {

        if (!empty($_REQUEST[self::$edit])) {

            $response = $this->generateSelectedMemberL();

        }else{
            $response = $this->generateListHTML();

        }


        return $response;
    }

    /*
    Foreach member in DB return listObject
     */

    public function createMemberListObject()
    {
        return '
        <form method="post">
        <tr>
        <td><input type="checkbox" class="checkthis" /></td>
        <td>' . $this->name . '</td>
        <td>' . $this->id . '</td>
        <td></td>
        <td>' . $this->personalNumber . '</td>
        <td>
        <input  class="btn btn-primary btn-xs " type="submit" name="' . self::$edit . '" value="edit" />
        </td>
        <td>
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$delete . '" value="delete" />
        </td>
    </tr>
    </form>
        ';
    }

    private function generateListHTML()
    {
        return '
        <h3>List of members</h3>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th><input type="checkbox" id="checkall" /></th>
                                <th>Name</th>
                                <th>ID</th>
                                <th></th>
                                <th>Social Security Number</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                            ' . $this->createMemberListObject() . '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


		';
    }

    private function generateSelectedMemberL()
    {
        return '
        <div class="card">
        <img src=""  style="width:100%">
        <h3>' . $this->name . '</h3>
        <h4 class="title"> ID : ' . $this->id . '</h4>
        <p>' . $this->personalNumber . '</p>
        <p>Boats : 0</p>
        <p><button class="btn btn-success btn-xs ml-2">Add Boat</button></p>
        <p><button class="btn btn-primary btn-xs ml-2">Back</button></p>

      </div>

		';
    }

}

// <tr>
// <td><input type="checkbox" class="checkthis" /></td>
// <td> Josef</td>
// <td>2</td>
// <td></td>
// <td>1993093-2222</td>
// <td>
//     <input class="btn btn-primary" btn-xs" type="submit" name="Edit" value="Edit" />
// </td>
// <td>
//     <input class="btn btn-danger btn-xs" type="submit" name="Delete" value="Delete" />
//     </p>
// </td>
// </tr>
