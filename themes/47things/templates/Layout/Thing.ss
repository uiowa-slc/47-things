<div id="page_content" class="clearfix">

	<div id="Content">

	
		<h2><span>Thing #{$Number}:</span> $Title</h2>
		
	<div id="content-nav">
		<ul>
		<li><a href="{$BaseHref}" class="nav-button">home</a></li> 
		<li><a href="http://47things.uiowa.edu/submission-form/?thing={$ID}" class="fancybox nav-button">Enter your photo for a chance to win the new iPad!</a></li>
		</ul>
		<div class="clear"></div>

	</div>
	<div class="clear"></div>
		<% if Submissions %>
			<% control Submissions.First %>
				<section id="feature">
					$Image.CroppedImage(400,400)
					
					
					
					<div id="feature_text">
					<% if Thing.Content %>
						$Thing.Content
						
					<% else %>
				
						
					<% end_if %>
					
					<% include Caption %>
					<div id="submission-nav">
					<a class="nav-button facebook-nav" href="https://www.facebook.com/sharer.php?u=$Thing.AbsoluteLink&t=$Thing.Title" target="_blank">share this on facebook!</a>
				<%-- <a class="report-button nav-button" href="{$Link}/FlagSubmission">flag this as inappropriate</a> --%>
					</div>
					<!--<ul class="more_button">
						<li><a href="http://localhost:8888/secondary.php">More from User</a></li>
						<li><a href="#">More of #15</a></li>
						<li><a href="#">All Recent</a></li>
					</ul>-->
					</div>
				</section>
				<div class="clear"></div>
			<% end_control %>
		<% else %>
			<section id ="feature">
				<img src="{$ThemeDir}/images/blank_photo.png" />
			<div id="feature_text">
			$Content
			</div>
			</section>
			<div class="clear"></div>
		
		<% end_if %><!--end if Submissions -->
	<% if Submissions %>
		<% include Submissions %>
	<% else %>

	<% end_if %>
	</div>
</div>