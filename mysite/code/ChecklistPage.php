<?php
class ChecklistPage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class ChecklistPage_Controller extends Page_Controller {

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

	
	public function init() {
	
		if(!(Member::currentUserID())){
			Director::redirect('home');
		}
			parent::init();
		
	}
	
	public function DoneThings(){
		$member = Member::currentUser();
		
		$submissions = DataObject::get("ThingSubmission", 'MemberID = '.$member->ID);
		
		if($submissions){
			$submissions->removeDuplicates("ThingID");
			return $submissions;
		}else{
			return false;
			
			}
	}
	
	public function UndoneThings(){
		$doneThingSubmissions = $this->DoneThings();
		if($doneThingSubmissions){
			$doneThingSubmissions = $doneThingSubmissions->toArray();
			
			$doneThings = new DataObjectSet();
		
			foreach($doneThingSubmissions as $doneThingSubmission){
				$doneThings->push($doneThingSubmission->Thing());
			}
		
			$doneThingIDs = $doneThings->column();
					
			$allThings = DataObject::get("Thing");
			$allThingIDs = $allThings->column();
			$undoneThingIDs = array_diff($allThingIDs,$doneThingIDs);
			
			
			$undoneThings = new DataObjectSet();
			
			foreach($undoneThingIDs as $undoneThingID){
				
				$thing = DataObject::get_by_id("Thing", $undoneThingID);
				$undoneThings->push($thing);
			}
			//print_r($undoneThingIDs);
	
			if($undoneThings)
				return $undoneThings;
		}
	}// end function UndoneThings
	
}