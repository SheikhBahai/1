<?php
	header("Content-type: text/css;");
	
	if( file_exists('../../../../wp-load.php') ) :
		include '../../../../wp-load.php';
	else:
		include '../../../../../wp-load.php';
	endif;
?>

<?php
	// Styles	
	$primary 	= ft_of_get_option('fabthemes_primary_color','#769A38');
	$secondary	= ft_of_get_option('fabthemes_secondary_color','');
	$link 		= ft_of_get_option('fabthemes_link_color','');
	$hover 		= ft_of_get_option('fabthemes_hover_color','');
	
?>

nav.main-navigation,
#secondary .widget .tagcloud a,
#footer-widgets .widget .tagcloud a ,
header.entry-header h1.entry-title:before,
#comments h2.comments-title,
#comments #respond p.form-submit input{
	background: <?php echo $primary ?>!important;
}
#comments #respond p.form-submit input{
	border-color:<?php echo $primary ?>!important;
}

nav.top-navigation{
	background: <?php echo $secondary ?>;
}
nav.main-navigation ul li.current-menu-item > a,
nav.main-navigation ul li.current-menu-parent > a,
nav.main-navigation ul li.current-menu-ancestor > a {
	color: <?php echo $primary ?>;
}

/* Links */

a:link, a:visited {
	color: <?php echo $link ?>;
}

a:hover,
a:focus,
a:active {
	color:<?php echo $hover ?>;
	text-decoration: none;
}


