<% include Header %>


<div class="container">
	<div class="row">
		<div class=" col-sm px-lg-0 content-container" role="main">
			<article>
				<h1>$Title</h1>
				<div class="content">$Content</div>
				<%--<% include MagnificExample %> -- %>
				<%-- <% include SlideshowExample %> --%>
				<%-- <% include ContentExample %> --%>
			</article>
			$Form
			$PageComments

		</div>
		<% if $Menu(2) || $SideBarView.Widgets %>
			<% include SideBar %>
		<% end_if %>
	</div>
</div>

