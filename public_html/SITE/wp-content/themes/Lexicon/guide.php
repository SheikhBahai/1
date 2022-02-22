<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'fabthemes_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function fabthemes_theme_guide(){ ?>

		
<div id="welcome-panel" class="about-wrap">
<div class="container">

<div class="row">

	<div class="col3 col">
		<img src="<?php echo get_template_directory_uri() ?>/screenshot.png" />
	</div>
	<div class="col34 col">
		<h2>Welcome to <?php echo wp_get_theme(); ?> WordPress theme!</h2>
		<p> <?php echo wp_get_theme(); ?> is a magazine blog theme. This is a responsive theme built with Bootstrap framework. It has a 3 column homepage layout. The theme supports custom menus, featured posts, custom style options, custom banner ads etc.</p>
	</div>

</div>

<div class="row">

	<div class="col col1">
		<h3>Theme setup</h3>
		<p>Download the theme zip file from Fabthemes.com. Open your WordPress admin panel and go to <b> Appearence > Themes</b> . Click <b> Add new </b> and then <b> Upload the theme </b> to your themes directory and activate it.  </p>
	</div>

</div>

<div class="row">

	<div class="col col1"> 
		<h3>Theme Options </h3>
		<p> Theme comes with an options panel to custostsmize its settings. </p>
	 </div>

	 <div class="col col1">
	 	<h4> 1. Homepage </h4>
	 	<p> The homepage has a column to display a list of featured posts. You can select a category as featured category and set the number of posts to show. </p>
	 </div>
	 <div class="col col1">
	 	<h4> 2. Custom styling </h4>
	 	<p> Use this option to set an accent color, header background color, link color etc. </p>
	 </div>
	 <div class="col col1">
	 	<h4> 3. Banner settings </h4>
	 	<p> Use this options to customize the banner ads on the sidebar.</p>
	 </div>
</div>


<div class="row">
	<div class="col col1">
			<?php echo file_get_contents(dirname(__FILE__) . '/FT/license-html.php'); ?>
	</div>
</div>


</div>
</div>



<style media="screen" type="text/css">

	.container{	width: 960px;}
	.row { background: #fff;  margin-bottom: 20px; padding: 20px 0px;}
	.row:before, .row:after {  display: table;  content: " ";}
	.row:after {  clear: both;	}
	.row:before, .row:after {  display: table;  content: " ";}
	.row:after { clear: both; }
	.col{ padding:0px 20px 0px 20px;  position:relative; 	 }
	.col1{ width: 920px;}
	.col2{ width: 440px; float: left;}
	.col3{ width: 280px; float: left;}
	.col34{ width: 600px; float: left;}
	.col h2{ font-weight: 700; font-size: 30px;}
	.col h3{ font-weight: 300; font-size: 24px; margin:0px 0px 20px 0px; background: #333; color:#fff; padding: 10px; }
	.col h4{ font-weight: bold; font-size: 16px; margin:10px 0px;}
	.clear{clear: both;}

</style>	

<?php }
