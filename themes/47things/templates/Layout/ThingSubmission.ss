<div id="page_content" class="clearfix">


	<div id="Content">

		<h2><% control Thing %><span>Thing #{$Number}:</span>$Title</h2><% end_control %>
		<% if Flagged %>
		<div class="flagged-message">
			<p>Thanks for flagging this submission. We'll check into it soon.</p>
		</div>
		<% end_if %>
		
		<% include MainNavigation %>

	<div class="clear"></div>
				<section id="feature">
				
				<% if Image.hasRotationOrCroppingInfo %>
					$Image.CroppedVersion
				<% else %>
					$Image.CroppedImage(400,400)
				<% end_if %>
					<div id="feature_text" class="individual-submission">
						<% include Caption %>
					<div id="submission-nav">
					<a class="nav-button facebook-nav"href="https://www.facebook.com/sharer.php?u=$Thing.AbsoluteLink&t=$Thing.Title">share this on facebook!</a>
				<% if Flagged %> <% else %><a class="report-button nav-button" href="{$Link}FlagSubmission">flag this as inappropriate</a> <% end_if %>
				
					<% if CurrentUserOwnsSubmission %>
					<a class="report-button nav-button fancybox" href="{$Link}CropImage">crop, rotate, or replace this photo</a>
					<% end_if %>
				</div>

	
					</div>
				</section>
				<div class="clear"></div>
	<% if Submissions %>
		<% include Submissions %>
		

	<% end_if %>
	</div>
</div>