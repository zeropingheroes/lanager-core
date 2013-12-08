<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>{{{ $title }}} :: LANager</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		{{ HTML::style('packages/zeropingheroes/lanager-core/vendor/twitter/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('packages/zeropingheroes/lanager-core/vendor/twitter/bootstrap/css/bootstrap-responsive.css') }}
		{{ HTML::style('packages/zeropingheroes/lanager-core/vendor/zeropingheroes/lanager/css/lanager.css') }}

		{{ HTML::script('packages/zeropingheroes/lanager-core/vendor/jquery/jquery-1.8.3.min.js') }}
		{{ HTML::script('packages/zeropingheroes/lanager-core/vendor/twitter/bootstrap/js/bootstrap.js') }}
		{{ HTML::script('packages/zeropingheroes/lanager-core/vendor/rails/jquery-ujs/rails.js') }}

		<script type="text/javascript">
			var siteUrl = '{{ url('/') }}';
			$(document).ready(function () {
				$("[rel=tooltip]").tooltip();
			});
  		</script>

	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->