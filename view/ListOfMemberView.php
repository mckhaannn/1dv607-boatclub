<?php

namespace view;

class ListOfMemberView
{
    private static $delete = 'ListOfMemberView::delete';
    private static $edit = 'ListOfMemberView::edit';


    private $memberModel;
    private $boatModel;
    
    public function __construct(\model\MemberModel $memberModel, \model\boatModel $boatModel)
    {
        $this->memberModel = $memberModel;
        $this->boatModel = $boatModel;
    }

    /**
     * 
     * fetch member information and creates a list depending on what setting you have chosen.
     * 
     * @return String
     */
    private function generateMemberInfoList()
    {
        $values = $this->memberModel->fetchData();
        $memberData = json_decode($values, true);

        $html = "";
        foreach ($memberData as $key) {
            $this->member = $key['Name'];
            $this->memberId = $key['ID'];
            $this->socialSecurity = $key['SocialSecurity'];
            $numberOfBoats = $this->boatModel->countBoats($this->boatModel->fetchBoatData($key['ID']));
                        
            if (isset($_GET['verbose'])) {
                $html .= $this->generateMemberListVerbose($this->member, $this->memberId, $this->socialSecurity, $this->fetchBoatInformation($this->memberId));
            } else {
                $html .= $this->generateMemberListCompact($this->member, $this->memberId, $this->socialSecurity, $numberOfBoats);
            }
        };
        return $html;
    }
    
    /**
     * 
     * fetch boat information for every member, only used on verbose list
     * 
     * @return String
     */    
    private function fetchBoatInformation($MemberId)
    {
        $html = "";
        $boatInfo = $this->boatModel->fetchBoatData($MemberId);
        $decodedBoatInfo = json_decode($boatInfo, true);
        if ($decodedBoatInfo != null) {
            foreach ($decodedBoatInfo as $key) {
                $type = $key['Type'];
                $length = $key['Length'];
                $boatId = $key['ID'];
                $html .= $this->boatInfoBox($type, $length, $boatId);
            }
            return $html;
        }
    }

    /**
     * 
     * Creates a inforamtion box on fetched boat info
     * 
     * @return String
     */
    
    private function boatInfoBox($type, $length, $boatId)
    {
        return '
        <div class="list-group">
        <br>
            <a href="#" class="list-group-item list-group-item-action ">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Boat</h5>
          </div>
          <p class="mb-1">Type: ' . $type . '</p>
          <p class="mb-1">length: ' . $length . '</p>
          <small>ID: ' . $boatId . '</small>
        </a>
      </div>
        ';
    }

    /**
     * 
     * generate diffrent table names depending on settings
     * 
     * @return String
     */
    
    public function renderListTable()
    {
        if (isset($_GET['verbose'])) {
            return '
            <th>Name</th>
            <th>Social Security</th>
            <th>ID</th>
            <th></th>
            <th>Boats</th>
            <th></th>
            <th>Edit</th>
            <th>Delete</th>
            ';
        } else {
            return '
            <th>Name</th>
            <th>ID</th>
            <th> Number of boats</th>
            <th></th>
            <th>Edit</th>
            <th>Delete</th>
            ';

        }
    }


    /**
     * 
     * creates a compact list
     * 
     * @return String
     */
    
    public function generateMemberListCompact($member, $memberId, $socialSecurity, $numberOfBoats)
    {
        return '
          <form method="post">
          <tr>
          <td value="' . $member . '">' . $member . '</td>
          <td>' . $memberId . '</td>
          <td class="text-center">' . $numberOfBoats . '</td>
          <td></td>
          <td>
          <input type="hidden" name="member" value="' . $member . '">
          <input type="hidden" name="memberId" value="' . $memberId . '">
          <input type="hidden" name="socialSecurity" value="' . $socialSecurity . '">
          <input  class="btn btn-primary btn-xs " type="submit" name="edit" value="edit"
          </td>
          <td>
          <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$delete . '" value="delete" />
          </td>
      </tr>
      </form>
          ';
    }


    /**
     * 
     * creates a verbose list
     * 
     * @return String
     */
    
    public function generateMemberListVerbose($member, $memberId, $socialSecurity, $boatList)
    {
        return '
        <form method="post">
        <tr>
        <td value="' . $member . '">' . $member . '</td>
        <td>' . $socialSecurity . '</td>
        <td>' . $memberId . '</td>
        <td></td>
        <td>' . $boatList . '</td>
        <td>
        <input type="hidden" name="member" value="' . $member . '">
        <input type="hidden" name="memberId" value="' . $memberId . '">
        <input type="hidden" name="socialSecurity" value="' . $socialSecurity . '">
         </td>
        <td>
        <input  class="btn btn-primary btn-xs " type="submit" name="edit" value="edit"/>     
        </td>
        <td>
        <input  class="btn btn-danger btn-xs" type="submit" name="' . self::$delete . '" value="delete" />
        </td>
    </tr>
    </form>';
    }


    /**
     * 
     * Container for all the lists.
     * 
     * @return String
     */
    public function generateInfoListHTML()
    {
        return '
  <div class=container>
  <div class=row>        
          <h3>List of members</h3>
          <div class="dropdown show mb-3 ml-3">
    <a class="btn btn-secondary dropdown-toggle btn-xs" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Select List
    </a>
   
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <form method="post">
     <a name="compact" class="dropdown-item" href="?compact">Compact List</a>
     <a name="verbose" class="dropdown-item" href="?verbose">Verbose List</a>
    </form> 
    </div>
  </div>
  </div>
  </div>
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="table-responsive">
                          <table id="mytable" class="table table-bordred table-striped">
                              <thead>
                                ' . $this->renderListTable() . '
                              <td>
                            </thead>

                              <tbody>
                              ' . $this->generateMemberInfoList() . '
                              </tbody>
                              
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          ';
    }


    /**
     * check if member wants to delete
     * 
     * @return Bool
     */
    
    public function lookForPost() : bool
    {
        return !empty($_POST[self::$delete]);
    }
}

