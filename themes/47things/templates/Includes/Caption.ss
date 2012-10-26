		<% if Caption %>
						<span class="caption"><p>$Caption</p>
						<p class="submitter-name">$Member.FirstName<% if SubmitterGrade %>, $SubmitterGrade<% end_if %></p>
						<div class="clear"></div>
						</span>
					<% else %>
						<span class="caption no-text">
						<p>$Member.FirstName<% if SubmitterGrade %>, $SubmitterGrade<% end_if %></p>
						</span>
					<% end_if %>