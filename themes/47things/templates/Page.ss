<!doctype html>
<html lang="en" class="no-js">
    <head>
        <% base_tag %>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        $MetaTags(false)
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <% if $URLSegment = 'home' %>
          <title>$SiteConfig.Title | The University of Iowa</title>
        <% else %>
          <title>$Title - $SiteConfig.Title | The University of Iowa</title>
        <% end_if %>
        $OpenGraph
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <% include Favicons %>

        $TypeKitScript
        <link rel="stylesheet" href="{$ThemeDir}/dist/styles/main.css">
    </head>
    <body class="{$ClassName}">

    <a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>

    <% include UiowaBar %>

    $Layout



    <% include Footer %>
    $BetterNavigator

    <script src="{$ThemeDir}/dist/scripts/main.min.js"></script>

    $Analytics
  </body>
</html>
