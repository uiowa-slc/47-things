<?php
class ThingSubmissionFormPage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);
	
	

}
class ThingSubmissionFormPage_Controller extends Page_Controller {

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
	


	public function Form() {
		
		//$recaptchaField = new RecaptchaField('MyCaptcha');
		//$recaptchaField->jsOptions = array('theme' => 'clean'); // optional
		
		$member = Member::currentUser();
		
		$thingID = intval($this->request->getVar('thing')); 
		//$thing = DataObject::get_by_id("Thing", $thingID);
		
		//print_r($thing);
		
		$thingsList = DataObject::get("Thing");
		$thingsMap = $thingsList->map("ID", "FullTitle", "Please Select");
		
		if($thingID){
			$thingsDropdown =  new DropdownField('Thing', 'Which thing did you do?', $thingsMap, $thingID);
		}else {
			$thingsDropdown =  new DropdownField('Thing', 'Which thing did you do?', $thingsMap);
		}


		if($member){
			$nameLabel = new LiteralField("MemberName", "First Name: ".$member->FirstName);
		}else{
			$nameLabel = new LiteralField("MemberName", "First Name: Unknown");
		}
		
		$termsLabel = new LiteralField("Terms", '<p>Before submitting your photo, please read our <a href="/terms-and-rules/" target="_blank">terms & rules for the contest</a>. Any inappropriate photos will be deleted. The University of Iowa is not accountable for the offending images.</p>');


		
		$captionField = new TextareaField("Caption", 'Caption this photo!');
		
		$submitterGradeList = array ("Freshmen" => "Freshmen", "Sophomore" => "Sophomore", "Junior"=>"Junior", "Senior"=>"Senior", "Transfer Student" => "Transfer Student", ""=>"Not Applicable / Rather not say");
		$submitterGradeDropdown = new DropdownField("SubmitterGrade", "What year are you?", $submitterGradeList);
		
		$submitterEmailBox = new EmailField("SubmitterUiowaEmail", "Your @uiowa.edu email address. This is for prize verification purposes.");
		
		
		$uploadField = new FileField('Image');
      //  $uploadField->uploadFolder = 'submissions';
        //$uploadField->setAspectRatio(4/3);
		
		return new Form($this, "Form", new FieldSet(
 
			// List your fields here
	
			/*new TextField("FirstName", "First name"),
			new TextField("LastName", "Last Name"),
			new EmailField("Email", "Email address"),*/
			$nameLabel,
			$submitterGradeDropdown,
			$submitterEmailBox,
			$thingsDropdown,
			$uploadField,
			//new SimpleImageField("Image", "Upload a photo of you doing this below!"),
			$captionField,
			$termsLabel
			
			
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
		
		$form->saveInto($entry);
		
		$entry->setParent($data['Thing']);
		
		
		$entry->Title = "47 Thing Submission";
		$entry->MenuTitle = "47 Thing Submission";
		$entry->MemberID = $member->ID;
		$entry->ThingID = $data['Thing'];
		
		
 		//print_r($form->fields);
		// Write it to the database.
		$entry->writeToStage("Stage");
		$entry->publish("Stage","Live");
		
		Session::set('ActionStatus', 'success'); 
		Session::set('ActionMessage', '<p>Thanks for submitting your 47 thing! Check this site to see your 47 thing soon!</p>'); 
		
		if($entry){
			//Director::redirectBack();
			Director::redirect($entry->Link()."CropImage");
			//echo "<script>parent.document.location.href ='http://47things.uiowa.edu/".$entry->Link()."cropImage'</script>";
			//echo "<script>parent.jQuery.fancybox.close();</script>";
		}else{
			//Director::redirectBack();

		}
		
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

}