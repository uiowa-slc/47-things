<?php
class HomePage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class HomePage_Controller extends Page_Controller {

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
		parent::init();
	 
	}
	
	function RandomThing() { 
	       $randomThings = DataObject::get("Thing", null, "RAND()", null, 1);
	       $randomThingsArray = $randomThings->toArray();
	       
	       return $randomThingsArray[0];
	       //print_r($randomThings->toArray());

	}
	
	function RandomSubmission(){
	       $randomThingSubmissions = DataObject::get("ThingSubmission", "CoverImage = 1", "RAND()", null, 1);
	       $randomThingSubmissionArray = $randomThingSubmissions->toArray();
	       
	       return $randomThingSubmissionArray[0];

		
		
	}
	
	function RecentSubmissions($num=3){
	   return DataObject::get("ThingSubmission", "", "Created DESC", "", $num); 		
	}
	
	public function DoneThings(){
		$member = Member::currentUser();
		
		if($member){
			$submissions = DataObject::get("ThingSubmission", 'MemberID = '.$member->ID);
			
			if($submissions){
				$submissions->removeDuplicates("ThingID");
				return $submissions;
			}else{
				return false;
				
			}
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