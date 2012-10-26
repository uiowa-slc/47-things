<div id="page_content" class="clearfix">


	<div id="Content">
		<h2>Your Checklist</h2>
		<div id="content-nav">
		
			<ul>
			<li><a href="{$BaseHref}">home</a></li>
			<li><a href="http://47things.uiowa.edu/submission-form/?thing={$Thing.ID}" class="fancybox nav-button"><span>Enter your photo for a chance to win a new iPad!</span></a></li>


			</ul>
			<div class="clear"></div>

		</div>
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
		<h3>You haven't done these yet:</h3>
		
	<section class="things_grid">
		<% control UndoneThings %>
			<div class="checklist-thing"  style="background-image: url($Image.AbsoluteURL);">
				<a href="$Link"><span>#{$Number}</span> $Title</a>
			</div>
		<% end_control %>	
	</section>
		

	</div>
		

	
	</div>
</div>