<!-- page content starts -->
	<div id="page_content" class="clearfix">

	<section id="feature">
			<% include MainNavigation %>
			<% control RandomSubmission %>
				<a href="$Thing.Link">
				<% if Image.hasRotationOrCroppingInfo %>
					$Image.CroppedVersion
				<% else %>
					$Image.CroppedImage(400,400)
				<% end_if %>
				</a>
		<div id="feature_text">
			<h2><a href="$Thing.Link"><span>Thing #{$Thing.Number}:</span> $Thing.Title</a></h2>
				<% if Content %>
					$Content
				<% end_if %>
					<% include Caption %>
		</div>

		<% end_control %>
	</section>
<div class="clear"></div>

	
	<% if recentSubmissions %>
		<section id="recent_upload_pics">
			<h2>Recent Entries</h2>
			<ul class="recent_pics">
				<% control RecentSubmissions %>
				<a href="$Link"><li>$Image.CroppedImage(130,130)</li></a>
				<% end_control %>
			</ul>
	
		</section>
	<% end_if %>
		<section id="ipad_contest">
		<h2><a href="http://47things.uiowa.edu/submission-form/" class="fancybox">Submit yours for a chance to <br><strong>win a free iPad!</strong></a></h2>
	</section>
	<div class="clear"></div>
	<section class="things_grid">
	<div id="Content">
	
	<% if CurrentMember %>
	
	<% if DoneThings %>
		<h2 id="checklist">Your Checklist</h2>
		<h3>You've done $DoneThings.Count things and you have $DoneThings.Count entries to win a new iPad:</h3>
	
		<section class="things_grid">
			<% control DoneThings %>
				<div class="checklist-thing"  style="background-image: url($Image.AbsoluteURL);">
					<a href="$Link" class="done-thing"><span>#{$Thing.Number}</span> $Thing.Title</a>
				</div>
			<% end_control %>	
		</section>
		
		<div class="things_grid_end">
		</div>
	<% end_if %>
	
	<% if UndoneThings %>
		<h3>You haven't done these yet:</h3>
	
		<section class="things_grid">
			<% control UndoneThings %>
			<div class="checklist-thing"  <% if ThingSubmissions.First %> <% control ThingSubmissions.First %>style="background-image: url(<% control Image %><% control SetRatioSize(400,300) %>$AbsoluteURL<% end_control %><% end_control %>);"<% end_control %> <% end_if %>>
					<a href="$Link"><span>#{$Number}</span> $Title</a>
				</div>
			<% end_control %>	
		</section>
	<% end_if %>
	
	<% else %><%-- if the member isnt logged in --%>
		<h2>All Things</h2>
		<% control Things %>
	
			<div class="checklist-thing"  <% if ThingSubmissions.First %> <% control ThingSubmissions.First %>style="background-image: url(<% control Image %><% control SetRatioSize(400,300) %>$AbsoluteURL<% end_control %><% end_control %>);"<% end_control %> <% end_if %>>
			
				
			<a href="$Link"><span>#{$Number}</span> $Title</a>
			
			</div>
	
		<% end_control %>
	<% end_if %>
	<!--

	-->
	
				
	</section>
		<div class="things_grid_end">
		</div>
	</div>

<!-- page content ends -->