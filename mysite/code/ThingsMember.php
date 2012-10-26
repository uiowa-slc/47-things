<?php
 
// mysite/code/CustomMember.php
 
class ThingsMember extends DataObjectDecorator {

	function extraStatics() {
	        return array(
	            'has_many' => array(
	                'ThingSubmissions' => 'ThingSubmission',
	            ),
	        );
	    }
	    
	public function DoneThings(){
		$submissions = $this->ThingSubmissions;
		print_r("FDSSFD");
		if($submissions)
			return $submissions;
		else
			return false;
		
	}
	public function updateCMSFields(FieldSet $fields) {
	  /* $fields->push(new TextField('test', 'Position Title'));
	   $fields->push(new ImageField('Image', 'Profile Image'));*/
	}
	
 
}