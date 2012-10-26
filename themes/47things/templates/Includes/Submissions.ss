<div id="submissions-container">
<% if Thing %>
<h3>All Submissions for #{$Thing.Number}</h3>
<% else %>
<h3>All Submissions for #{$Number}</h3>

<% end_if %>
		<div id="submissions">
			<ul>
				<li><a href="http://47things.uiowa.edu/submission-form/?thing=$Thing.ID" class="fancybox enter-yours-button"><span>Enter yours for a chance to win the new iPad!</span></a></li>
			<% control Submissions %>
				<li><a href="$Link">$Image.CroppedImage(130,130)</a></li>
			<% end_control %>
			<div class="clear"></div>
			</ul>
		</div>
</div>