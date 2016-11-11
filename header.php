<?php
/**
 * The Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
 ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<?php  	cryout_seo_hook(); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
 	cryout_header_hook();
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php cryout_body_hook(); ?>

<div id="wrapper" class="hfeed">

<?php cryout_wrapper_hook(); ?>

<header id="header">

		<div id="masthead">

			<div id="branding" role="banner" >

				<?php cryout_branding_hook();?>
				<div style="clear:both;"></div>

			</div><!-- #branding -->

			<nav id="access" class="jssafe" role="navigation">

				<?php cryout_access_hook();?>

				<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
					<div>
						<input type="text" size="10" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="Hledat na webu" class="btn" />
					</div>
				</form>

			</nav><!-- #access -->

		</div><!-- #masthead -->

	<div style="clear:both;"> </div>

</header><!-- #header -->
<div id="main">
	<div  id="forbottom" >
		<?php cryout_forbottom_hook(); ?>

		<div style="clear:both;"> </div>
		
		<?php cryout_breadcrumbs_hook();?>
							
