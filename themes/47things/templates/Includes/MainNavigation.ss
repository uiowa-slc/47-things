		<div id="content-nav">
			<ul>
			<li><a href="{$BaseHref}" class="nav-button">home</a></li> 
			<li><a href="{$BaseHref}submission-form/?thing={$Thing.ID}" class="fancybox nav-button"><span>add your photo for a chance to win the new iPad</span></a></li>
			
						
			
			<% if CurrentMember %>
				<li><a href="{$BaseHref}#checklist">view your checklist</a></li>
			<% else %>
				<fb:login-button size="xlarge"
                 onlogin="Log.info('onlogin callback')" scope="$Top.FacebookPermissions" on-login="top.location = '{$BaseHref}#checklist'; ">
	                 Sign in to see your checklist!
                 </fb:login-button>

			<% end_if %>
			</ul>
			
			<div class="clear"></div>

		</div>