<!doctype html>
<html lang="en"class="no-js" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<% base_tag %>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>47 Things Submission Form</title>


	<meta name="viewport" content="width=device-width,initial-scale=1">

	<% require themedCSS(ThingSubmissionForm) %>
<link rel="stylesheet" href="{$ThemeDir}/js/jcrop/jquery.Jcrop.min.css" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>

<script src="{$ThemeDir}/js/jcrop/jquery.Jcrop.min.js"
        type="text/javascript"></script>   
        
		<script language="Javascript">

			$(document).ready(function(){


		        // The variable jcrop_api will hold a reference to the
		        // Jcrop API once Jcrop is instantiated.
		        var jcrop_api;
		
		        // In this example, since Jcrop may be attached or detached
		        // at the whim of the user, I've wrapped the call into a function
		        initJcrop();
		        
		        function getDimensions(){
		        	alert( Math.round($('#cropbox').width() / 2));
		        	
				  return [
				    Math.round($('#cropbox').width() / 2),
				    Math.round($('#cropbox').height()/2),
				    Math.round($('#cropbox').width()/ 4),
				    Math.round($('#cropbox').height()/4)
				  ];
				}
			       
				function initJcrop(){
				
					<% if Image.hasCroppingInfo %>
						var x = {$Image.CroppedX};
						var y = {$Image.CroppedY};
						var x2 = {$Image.CroppedX} + {$Image.CroppedW};
						var y2 = {$Image.CroppedY} + {$Image.CroppedH};
					<% else %>
						var x = 0;
						var y = 0;
						var x2 = 400;
						var y2 = 400;					
					
					<% end_if %>

				
					$('#cropbox').Jcrop({
						aspectRatio: 1,
						onSelect: updateCoords,
						setSelect:   [ x, y, x2, y2 ],
						bgOpacity:   0.2,
					});
					
				}
		
				
				
				$('#Form_ReplaceImageForm_action_doReplaceImage').click(function(){
					$('#Form_ReplaceImageForm_Image').click();
				});
				
				$('#close-button').click(function(){
					$('#save-cropped-button').click();
				});


			});
			
		
			
		function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region on your photo then press Crop Image again.');
				return false;
			};
		</script>     
        
</head>


<body>
	<h1>Crop your photo</h1>
	<p>Highlight the area of the photo you'd like to crop. You can also rotate or replace the image using the tools below.</p>
	<div class="image-crop-container">
	<!--
		<% if CurrentUserOwnsSubmission %>
			<p>you own this</p>
		<% else %>
			<p>this isn't your image</p>
		<% end_if %>
		-->

		<% if Image.hasRotationInfo %>
		<% control Image.Rotated %>
			<img src="$URL" id="cropbox" />
		<% end_control %>

	<% else %>
		<% control Image.SetWidth(400) %>
			<img src="$URL" id="cropbox" />
		<% end_control %>
	<% end_if %>
		

		
	</div>
			<div class="clear"></div>
			<div class="crop-info">
			<form action="{$Link}doCrop" method="post" onsubmit="return checkCoords();">
				<input type="hidden" id="x" name="x" />
				<input type="hidden" id="y" name="y" />
				<input type="hidden" id="w" name="w" />
				<input type="hidden" id="h" name="h" />
				<input type="hidden" id="imageID" name="imageID" value="$Image.ID" />
				<input type="submit" id="save-cropped-button" value="Save Cropped Image" onClick="/*parent.$.fancybox.close();*/" />
			</form>
			
			<form action="{$Link}doRotateClockwise" method="post" onsubmit="">
				<input type="hidden" id="clockwiseDegrees" name="clockwiseDegrees" value="90" />
				<input type="hidden" id="clockwiseImageID" name="clockwiseImageID" value="$Image.ID" />
				<input type="submit" class="edit-button" value="Rotate Clockwise" onClick="" />
			</form>
		<div class="replace-image-container">
			$ReplaceImageForm
		</div>	
		<a class="edit-button" id="close-button" href="#" onClick="parent.jQuery.fancybox.close();" >
			Save and Close
		</a>
		<div class="clear"></div>	
		
		<div class="secondary-actions">
			<form action="{$Link}doResetCropping" method="post" onsubmit="">
				<input type="hidden" id="clockwiseImageID" name="clockwiseImageID" value="$Image.ID" />
				<input type="submit" class="edit-button reset-button" value="Reset all cropping/rotation" onClick="" />
			</form>

			<div class="clear"></div>
		</div>
		
	</div>


</body>
</html>