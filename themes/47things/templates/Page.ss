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

    <!-- Web Application Manifest -->
    <link rel="manifest" href="$resourceURL('themes/47things/dist/favicons/manifest.json')">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="$SiteConfig.Title">
    
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="$SiteConfig.Title">
    <link rel="apple-touch-icon" sizes="180x180" href="$resourceURL('themes/47things/dist/favicons/apple-touch-icon.png')">
    <link rel="icon" type="image/png" href="$resourceURL('themes/47things/dist/favicons/favicon-32x32.png')" sizes="32x32">
    <link rel="icon" type="image/png" href="$resourceURL('themes/47things/dist/favicons/favicon-16x16.png')" sizes="16x16">
    <link rel="icon" type="image/png" href="$resourceURL('themes/47things/dist/favicons/favicon-192x192.png')" sizes="192x192">
    <link rel="mask-icon" href="$resourceURL('themes/47things/dist/favicons/safari-pinned-tab.svg')" color="#000000">
    <link rel="shortcut icon" href="$resourceURL('themes/47things/dist/favicons/favicon.ico')">
    <meta name="msapplication-config" content="$resourceURL('themes/47things/dist/favicons/browserconfig.xml')">
    <meta name="theme-color" content="#000000">


    $TypeKitScript
    <link rel="stylesheet" href="{$ThemeDir}/dist/styles/main.css">
  </head>
  <body class="{$ClassName}">
  <% include UiowaBar %>

  $Layout



    <% include Footer %>
    $BetterNavigator

    <script src="{$ThemeDir}/dist/scripts/main.min.js"></script>

    $Analytics
  </body>
</html>