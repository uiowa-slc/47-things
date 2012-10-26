<?php
class ThingSubmissionImage extends Image {

	public static $db = array(
	
		"CroppedX" => "Int",
		"CroppedY" => "Int",
		"CroppedW" => "Int",
		"CroppedH" => "Int",
		"Rotation" => "Int"
	
	);
	
	
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

		
	public function generateRotated(GD $gd, $degrees) {
        return $gd->rotate($degrees);
    }

}