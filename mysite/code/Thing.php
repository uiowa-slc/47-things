<?php
class Thing extends Page {

	public static $db = array(
	
		"Number" => "Int"
	
	);

	public static $has_one = array(
	
	
	);
	
	public static $has_many = array(
	
		"ThingSubmissions" => "ThingSubmission",

	
	);
	public function FullTitle(){
		
		$fullName = $this->Number.". ".$this->Title;
		
		return $fullName;
		
		
	}
	public function FirstSubmission() {
		$submission = $this->getComponents("ThingSubmissions", $filter = "", $sort = "ID DESC", $limit = 1 );
		//print_r("SFDSDASF");
		
		if($submission){
			return $submission;
		}
		
	}
	public function RandomCover(){
		$submissions = $this->getComponents("ThingSubmissions", $filter = "", $sort = "RAND()");
		if($submissions){
			$randomSubmissionArray = $submissions->toArray();
			
			if(isset($randomSubmissionArray[0]))
	    		return $randomSubmissionArray[0];
	    	else
	    		return false;
		}else{
			return false;
			
			
		}
		
	    }	

	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Content.Main","Content");
		
		
		$fields->addFieldToTab('Root.Content.Main', new TextField('Number', 'Thing Number'));
		$fields->addFieldToTab('Root.Content.Main', new HTMLEditorField('Content', 'Content'));
		
		return $fields;
	}

}
class Thing_Controller extends Page_Controller {

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
	);
	
		public function currentMemberHasThing(){
		
			$member = Member::currentUser();
			
			if($member){
			$components = $member->getComponents("ThingSubmissions");
			$thing = $components->find("ThingID",$this->ID);
			
			//return $components->debug();					
			//print_r($thing);
			
			if($thing){return $thing;} else {return false;}
			}else{
				return false;
				
			}
		
		}
		

	
		
		public function Submissions() {
			$submissions = $this->ThingSubmissions();
			//$submissions = DataObject::get("ThingSubmission", "ThingID =".$this->ID."");
			//print_r($submissions);
			if($submissions){
				return $submissions;
			}else {
			
			
			}
		
		
		}
	
		function Form() {
		
		//$recaptchaField = new RecaptchaField('MyCaptcha');
		//$recaptchaField->jsOptions = array('theme' => 'clean'); // optional
			$things = DataObject::get("Thing");
			$thingsArray = $things->toDropdownMap('ID', 'Title', '(Select one)', true);
			$thingDropdown = new DropdownField('ThingSubmissionID', 'Gallery', $thingsArray);

			return new Form($this, "Form", new FieldSet(
 
			// List your fields here
			

			/*new TextField("FirstName", "First name"),
			new TextField("LastName", "Last Name"),
			new EmailField("Email", "Email address"),*/
			new SimpleImageField("Image", "Upload a photo of you doing this below! If your picture is bigger than 1.5 MB, please make it smaller before submitting it. ")
			
			//, $recaptchaField
					
			/*new OptionsetField("CurrentStudent", "Are you a current student at The University of Iowa?", array("yes"=>"Yes", "no"=>"No"),"yes")*/
 
		), new FieldSet(
 
			// List the action buttons here
			new FormAction("SubmitAction", "Submit yours!")
 
		), new RequiredFields(
 
			 "Image"
 
		));
	}
 
	/**
	* This function is called when the user submits the form.
	*/
	function SubmitAction($data, $form) {
 
		$member = Member::currentUser();
		// Create a new object and load the form data into it
		$entry = new ThingSubmission();
		$entry->setParent($this->ID);
		$form->saveInto($entry);
		
		
		$entry->Title = "47 Thing Submission";
		$entry->MenuTitle = "47 Thing Submission";
		$entry->MemberID = $member->ID;
		$entry->ThingID = $this->ID;
		
		
 		//print_r($form->fields);
		// Write it to the database.
		$entry->writeToStage("Stage");
		$entry->publish("Stage","Live");
		
		Session::set('ActionStatus', 'success'); 
		Session::set('ActionMessage', '<p>Thanks for submitting your 47 thing! Check this site to see your 47 thing soon!</p>');
		
	//Email notification
		/*$image_file = DataObject::get_one("File", "`ID` = '{$entry->ImageID}'");
		
		$from = "Snowflake Submissions";
		//$to = "ann-goff@uiowa.edu, bret-gothe@uiowa.edu, dustin-quam@uiowa.edu";
		//$to = "bret-gothe@uiowa.edu, dustin-quam@uiowa.edu";
		$to = "dustin-quam@uiowa.edu";
		$subject = "New 47 Things Submission";
		$body = '<p>A new snowflake photo has been submitted!</p>

				<p><a href="'.$image_file->getURL().'">This is the image that was submitted.</a> </p>
				
				<p><a href="http://studentlife.uiowa.edu/snowflake/admin/show/'.$entry->ID.'">Approve it (or don\'t) here</a></p>
				';
			
		
		$email = new Email($from, $to, $subject, $body);
		
		
		$email->send();
		
		//print_r($form);*/
		Director::redirectBack();
 
	}
	
	function StatusMessage() { 
	   if(Session::get('ActionMessage')) { 
	      $message = Session::get('ActionMessage'); 
	      $status = Session::get('ActionStatus');
	
	      Session::clear('ActionStatus'); 
	      Session::clear('ActionMessage');
	
	      return new ArrayData(array('Message' => $message, 'Status' => $status)); 
	   }
	
	   return false; 
	}

		
	public function init() {

		parent::init();
		
		//print_r($this->currentMemberHasThing());
		
		$coverImage = $this->currentMemberHasThing();
		//$coverImage = $coverImage->toArray();
		
		
		if($coverImage){
			Director::redirect($coverImage->Link());
		}else{
		
			$coverImage = $this->RandomCover();
			
			if($coverImage){
				Director::redirect($coverImage->Link());
			}
		
		}
		

	}
}