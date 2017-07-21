<!DOCTYPE html>
<html ng-app="CoyApp">
<head>
  <title>Coy Bowles</title>
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?=get_stylesheet_directory_uri()?>/style.css" />
  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/main.js"></script>
  <?php wp_head(); ?>
</head>
<body ng-cloak ng-controller="MainCtrl as ctrl">
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1644901739106799',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
