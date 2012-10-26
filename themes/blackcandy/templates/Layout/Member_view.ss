<p>Member data will go here:</p>
<% control ViewingMember %>
	<p>$FirstName</p>
	<ul>
	<% control ThingSubmissions %>
		<li>$Image</li>
	<% end_control %>
	</ul>
<% end_control %>
