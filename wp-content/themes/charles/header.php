<!doctype html>
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js ie-8"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' / '; } ?> <?php bloginfo('name'); ?></title>		
		<meta charset="<?php bloginfo('charset'); ?>" />

		<!-- dns prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch" />
		
		<!-- meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />
		<meta name="keywords" content="The Wilson Project, Ivan Wilson, web developer, web development, wilson project, HTML, XHTML, HTML5, DOM, CSS, CSS3, JavaScript, jQuery, front-end development, web programming, programming, coding, digital, internet" />	
		<meta name="p:domain_verify" content="139a21d37fff63550a3494d794507109" />		
		
		<!-- icons -->
		<link href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon.ico" rel="shortcut icon" />

		<!-- For third-generation iPad with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-144x144-precomposed.png">
		<!-- For iPhone with high-resolution Retina display -->
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-120x120-precomposed.png">
		<!-- For first- and second-generation iPad: -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-72x72-precomposed.png">		
		<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-precomposed.png">

		<!-- css -->
		<link href="<?php echo get_template_directory_uri(); ?>/style.min.css" rel="stylesheet" />			

	</head>

	<body>
	
		<!--Container-->
		<div class="container">

	        <!--Site Header-->
	        <header role="banner">
				<div class="blkHeader">		
					<strong>The Wilson Project</strong>
					<em>Blog of Front-End Developer/UX Engineer Ivan Wilson</em>
					<a href="<?php echo home_url(); ?>" class="siteLogo"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-twp.png" width="415" height="170" alt="The Wilson Project [Logo]" /></a>

					<p class="btnNavigation"><a href="#navigation" id="btnNavigation">Skip to Navigation</a></p>
				</div>
	        </header>
	        <!--Site Header-->