<?php
class MemberPage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class MemberPage_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	public static $allowed_actions = array (
		"details"
	
	);
	
	public static $url_handlers = array(
            //'tag/$Tag' => 'tag'
            'details/$ID' => 'details'
     );
	
	public function details() {
		$id = intval($this->urlParams['ID']);
 		$member = DataObject::get_one("Member", "ID = '".$id."'");
 		$Data = array(
	      'ViewingMember' => $member
	    );
 		return $this->customise($Data)->renderWith(array('Member_view','Page'));
 	}
	
	public function AllMembers(){
		$members = DataObject::get("Member");
		
		if($members){
			return $members;}
		else{
			return false;}
	
	}
	
	public function init() {

		parent::init();
		
	}
}