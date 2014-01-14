<!DOCTYPE html>
<html>
	<head>
		<title>{{{ $title }}} :: LANager</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content>
		<meta name="author" content>
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="packages/zeropingheroes/lanager-core/apple-touch-icon-152x152-precomposed.png">
		
		{{ HTML::style('packages/zeropingheroes/lanager-core/vendor/twitter/bootstrap/css/bootstrap-dark.min.css') }}
		{{ HTML::style('packages/zeropingheroes/lanager-core/css/lanager.css') }}
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<script type="text/javascript">
			var siteUrl = '{{ url('/') }}';
			$(document).ready(function () {
				$("[rel=tooltip]").tooltip();
			});
  		</script>

	</head>
	<body style>