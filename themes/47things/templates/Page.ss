<!doctype html>
<html lang="en"class="no-js" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<% base_tag %>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<% if ClassName = Thing %>
	
		<title>$Title - 47 Things Things You Should Do at Iowa</title> 
	<% else_if ClassName = ThingSubmission %>
		<title>$Thing.Title - 47 Things Things You Should Do at Iowa</title> 

	<% else %>
		<title>47 Things You Should Do at Iowa</title>
	<% end_if %>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!--<link rel="stylesheet" href="css/style.css">-->
<% require themedCSS(layout) %>

	<script src="{$ThemeDir}/js/libs/modernizr-2.0.6.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="{$ThemeDir}/js/fancybox/jquery.fancybox.pack.js"><\/script>
<script>window.jQuery || document.write('<script src="{$ThemeDir}/js/fancybox/jquery-1.7.2.min.js"><\/script>')</script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox({
			'type' : 'iframe',
			'padding' : 0,
			'autoSize' : true,
			'minHeight' : 600,
	
			afterClose : function() {
				location.reload();
				return;
			}
			
			});

			
		});
	</script>
	
	<link rel="stylesheet" type="text/css" href="{$ThemeDir}/js/fancybox/jquery.fancybox.css">
	
</head>
<body>


<header id="page_header">
	<div id="header_container">
		<a href="/"><h1>47 Things You Should Do at Iowa</h1></a>
		
		<!--<div class="facebook_connect">
			<h2><a href="#">Connect with Facebook</a></h2>
		</div>-->

		
	</div>
</header>
$Layout


<div id="footer_paper">
</div>
<footer id="footer" class="clearfix">
	<div id="footer_container">
		<div class="logo">
			<img src="{$ThemeDir}/images/doslogo.png"/><br>
			<p2>249 Iowa Memorial Union | Iowa City , IA 52242 <br> 319-335-3557 | <a href="mailto:fortyseventhings@uiowa.edu">fortyseventhings@uiowa.edu</a></p2>
		</div>
		<div class="footer_about">
	 <p>47 Things is a contest for students to become better acquainted with the University of Iowa. When you complete one of the items on the list, take a photo of yourself doing that "thing" and submit it online. Each photo submission, or "thing" completed on the website will automatically enter your name for the drawing to be held on a date to be announced.  The more photos you submit, the better your odds are of winning. The winner of the contest will receive a new Apple iPad.</p> 
		</div>
		
		<div class="nav">
		<ul>
			<a href="http://47things.uiowa.edu/submission-form/" class="fancybox"><li>Submit Your Entry</li></a>
		</ul>
		</div>
		
	</div>
</footer>



<!-- scripts concatenated and minified via ant build script-->
<script src="{$ThemeDir}/js/plugins.js"></script> 
<script src="{$ThemeDir}/js/script.js"></script> 

<!-- end scripts-->

<script type="text/javascript">

 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-426753-43']);
 _gaq.push(['_trackPageview']);

 (function() {
   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();

</script>
 <% include ConnectInit %>
</body>
</html>