<?php
class ThingSubmissionImage extends Image {

	public static $db = array(
	
		"CroppedX" => "Int",
		"CroppedY" => "Int",
		"CroppedW" => "Int",
		"CroppedH" => "Int",
		"Rotation" => "Int"
	
	);
	
	public static $allowed_actions =
		array( 
			"generateRotated",
			"hasCroppingInfo",
			"hasRotationInfo",
			"hasRotationOrCroppingInfo"
			
		);
	
		
	public function generateRotated(GD $gd) {
		//print_r("DFAADSFDSFA");
		$degrees = $this->Rotation;
		//print_r($degrees);

		$rotatedImage = $gd->resizeByWidth(400);
		$rotatedImage = $rotatedImage->rotate($degrees);
        return $rotatedImage;
    }	
    
	public function generateCroppedVersion(GD $gd){
	
		$croppedWidthImage = $gd->resizeByWidth(400);
		
		if($this->hasRotationInfo()){
			$croppedWidthImage = $croppedWidthImage->rotate($this->Rotation);
		}
		
		if($this->hasCroppingInfo()){
			
			$croppedWidthImage = $croppedWidthImage->crop($this->CroppedY, $this->CroppedX, $this->CroppedW, $this->CroppedH);
			
			//print_r("rotation:");
			//print_r($this->Rotation);
			//return $croppedWidthImage->crop($this->CroppedY, $this->CroppedX, $this->CroppedW, $this->CroppedH);
			
		}
		
		

		
			return $croppedWidthImage;
	}
	
	public function hasCroppingInfo(){
	
		if(($this->CroppedX!=0)&&($this->CroppedY!=0)&&($this->CroppedW!=0)){
			return true;
		}else{
			return false;
			
		}
	}
	
	public function hasRotationInfo(){
		
		if(($this->Rotation)&&($this->Rotation!=0)){
			return true;
		}else{
			return false;
			
		}
			
	}
	
	public function hasRotationOrCroppingInfo(){
		if($this->hasRotationInfo() || $this->hasCroppingInfo()){
			return true;
		}else{
			return false;
			
		}
		
		
	}



}