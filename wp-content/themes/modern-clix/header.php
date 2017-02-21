<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<title><?php bloginfo('name'); ?> <?php if ( is_single() || is_page() ) { ?> <?php } ?> <?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="keywords" content="The Wilson Project, Ivan Wilson, web developer, web development, Ivan, Wilson, wilson project, portfolio, HTML, XHTML, DOM, CSS, JavaScript, information architecture, information architect, web programming, web programmer, programming, coding, digital, internet" />
	<meta name="description" content="Portfolio Site of Ivan Wilson, UI/Front-end Developer" />	
	<meta name="p:domain_verify" content="139a21d37fff63550a3494d794507109" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.min.css" type="text/css" media="screen" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" type="text/css" media="screen" />
	<![endif]-->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>

<body>
	<div id="wrapper">
		
		<div id="header" class="col last span-12">
			<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
			<em>Portfolio Site of Ivan Wilson, UI/Web Developer</em>
		</div>

		<hr />