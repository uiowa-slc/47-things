<div class="typography">
	<% if Menu(2) %>
		<% include SideBar %>
		<div id="Content">
	<% end_if %>

	<% if Level(2) %>
	  	<% include BreadCrumbs %>
	<% end_if %>
	
		<h2>$Title</h2>
		<p>Welcome, $MemberName!!!</p>
		$Content
		$PageComments
		
		<h2>Submissions for this thing:</h2>
			<% control Submissions %>
			$Image.CroppedImage(130,130)
			<% end_control %>
			
			
			
			<% if CurrentFacebookMember %><!-- if user is logged in -->
				
				<% if currentMemberHasThing %><!-- if current user has thing we're looking at -->
				<h2>Your submission</h2>
				
					<% control currentMemberHasThing %>
						$Image.SetWidth(300)
					<% end_control %>
				
				<% else %> <!-- user doesn't have the thing we're looking at -->

					<h2>Submit Yours!</h2>
					<p>Upload your submission below:</p>
					$Form
					<% include ConnectLogout %>
				<% end_if %><!-- end if current user has thing we're looking at -->
			<% else %><!-- user isn't logged in-->
				<% include ConnectLogin %>
			<% end_if %><!-- end if user logged in -->
			
	
			
			
		<% if Menu(2) %>
		</div>
	<% end_if %>
</div>