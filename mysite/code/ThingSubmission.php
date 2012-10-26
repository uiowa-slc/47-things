<?php
class ThingSubmission extends Page {

	public static $db = array(
		"Caption" => "Text",
		"SubmitterGrade" => "Text",
		"SubmitterUiowaEmail" => "Text",
		"CoverImage" => "Boolean"
	);

	public static $has_one = array(
	
		"Member" => "Member",
		"Thing" => "Thing",
		"Image" => "ThingSubmissionImage"
	);
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Content.Main","Content");
		
		$fields->addFieldToTab('Root.Content.Main', new CheckboxField('CoverImage', 'Is this submission allowed to be a cover photo?'));
		
		//$uploadField = new JcropImageUploadField('Image');
       // $uploadField->uploadFolder = 'submissions';
       // $uploadField->setAspectRatio(4/3);
   
      //  $fields->addFieldToTab('Root.Content.Main', $uploadField);
		$fields->addFieldToTab('Root.Content.Main', new ImageField('Image', 'Image'));
		$fields->addFieldToTab('Root.Content.Main', new TextareaField('Caption', 'Caption'));

		return $fields;
	}
}
class ThingSubmission_Controller extends Page_Controller {

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
	
		"FlagSubmission",
		"CropImage",
		"doCrop",
		"doRotateClockwise",
		"doResetCropping",
		"doReplaceImage",
		"ReplaceImageForm"
	
	);
	
	function Flagged(){
		
		$flagged = $this->request->getVar('flagged');
		
		print_r($flagged);
		
		if($flagged == 1){
			return true;
			
		}
		
		
	}
	
	public function CropImage(){
		
		$member = Member::currentUser();
		$submission = DataObject::get_by_id("ThingSubmission", $this->ID);

		if(($member->ID) != ($submission->MemberID)){
			
			return "Bad idea.";
			
		}

		
		return $this->RenderWith(array('ThingSubmission_CropImage'));
		
	}
	
	public function doCrop(){
		$imageID = intval($_POST['imageID']);
		
		
	
		$image = DataObject::get_by_id("ThingSubmissionImage", $imageID);
		
		//print_r($image);
		
		//TODO: Be sure to check image ownership before actually rotating/cropping it.
		
		
		//delete older cached/cropped images
		$image->deleteFormattedImages();

		
		if($image){
		
		$x = intval($_POST['x']);
		$y = intval($_POST['y']);
		$w = intval($_POST['w']);
		$h = intval($_POST['h']);
		
		$image->CroppedX = $x;
		$image->CroppedY = $y;
		$image->CroppedW = $w;
		$image->CroppedH = $h;
		
		$image->write();
		
		Director::redirect($this->Link.'/CropImage/');
		//print_r($imageID);
	
		}else {
			
			echo "no image found";
		}
		

	}
	
	public function doRotateClockwise(){
		
		$imageID = intval($_POST['clockwiseImageID']);
		$image = DataObject::get_by_id("ThingSubmissionImage", $imageID);
		
		//TODO: Be sure to check image ownership before actually rotating/cropping it.
		
		if($image->Rotation){
			$image->Rotation = $image->Rotation+90;
		}else{
			$image->Rotation = 90;
		}
		
		//delete older cached/cropped images
		$image->deleteFormattedImages();
		$image->write();
		//print_r($image);
		Director::redirect($this->Link().'CropImage');
		
	}
	
	public function doResetCropping(){
		
		$imageID = intval($_POST['clockwiseImageID']);
		$image = DataObject::get_by_id("ThingSubmissionImage", $imageID);
		
		$image->CroppedX = 0;
		$image->CroppedY = 0;
		$image->CroppedW = 0;
		$image->CroppedH = 0;
		$image->Rotation = 0;
		
		
		$image->deleteFormattedImages();

		$image->write();
		Director::redirect($this->Link().'CropImage');

	}
	
	public function FlagSubmission(){
				
		$from = "47 Things";
		//$to = "imu-web@uiowa.edu; dustin-quam@uiowa.edu";
		$to = "dustin-quam@uiowa.edu";
		$subject = "A Submission has been flagged";
		$body = 'Someone flagged a 47 Thing submission, <a href="'.$this->AbsoluteLink.'">located here</a>. <a href="http://47things.uiowa.edu/admin/show/'.$this->ID.'">Delete it here.</a>';
			
		$email = new Email($from, $to, $subject, $body);
		
		
		$email->send();
		
		Director::redirect($this->Link.'?flagged=1');
		
		
	}
	
	public function ReplaceImageForm(){
		
		$member = $member = Member::currentUser();
		$uploadField = new FileField('Image', "Replace Your Image with Another");
		
		return new Form($this, "ReplaceImageForm", new FieldSet($uploadField), new FieldSet(
 
		// List the action buttons here
		new FormAction("doReplaceImage", "Replace this Image")
 
		), new RequiredFields(
 
			 "Image"
 
		));
		
	
		
		
	}
	
	
	public function doReplaceImage($data, $form){
	
		//TODO: make sure user owns image before replacement happens
		
		$member = Member::currentUser();
		// Create a new object and load the form data into it
		$entry = DataObject::get_by_id("ThingSubmission", $this->ID);
		//print_r($this);
		$form->saveInto($entry);
		
		$entry->writeToStage("Stage");
		$entry->publish("Stage","Live");

		Director::redirect($this->Link.'/CropImage/');
		
	}
	
	public function CurrentUserOwnsSubmission(){
		
		$member = Member::currentUser();
		//print_r($this->MemberID);

		if($member){
			if($this->MemberID == $member->ID){
				return true;
				
			}else{
				return false;
			}
		}
		
	}
	
	
	public function Submissions() {
		$thing = $this->Thing();
		if($thing){
			$submissions = $thing->ThingSubmissions();
			//$submissions = DataObject::get("ThingSubmission", "ThingID =".$this->ID."");
			//print_r($submissions);
			if($submissions){
				return $submissions;
			}else {
			
			}
		}
	
	
		}
	
	public function init() {

		parent::init();

	}
}