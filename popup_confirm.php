<?php
 /*
 Template Name: inline confirm
 */
get_header();
$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<!-- new styles for the standard inline confirmation -->

<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content {
    background-color: #fefefe;
    margin-top: 8%!important;
    margin-left: 27% !important;
    border: 1px solid #e2e2e2;
    width: 50%;
    position: fixed;
    z-index: 9999;
    margin: auto;
    padding: 25px;
    border-radius: 5px;
    min-width: 200px;
    font-size: 17px;
    line-height: 23px;
	box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}
.modal-header h2 {
    border-bottom: 2px solid #E2e2e2;
    margin-bottom: 20px;
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 21px;
    font-weight: bold;
    position: absolute;
    right: -8px;
    top: -14px;
    border: 2px solid #e2e2e2;
    border-radius: 100%;
    padding: 0px 5px;
    background-color: white;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}
</style>

<!-- call the jQuery library if not already loaded in theme -->

<!-- the function to fade the confirmation text -->

<script type="text/javascript">
  $(document).ready(function(){
	   modal.style.display = "block";
   setTimeout(function(){
  $("#gforms_confirmation_message").fadeOut("slow", function () {
  $("#gforms_confirmation_message").remove();
      });

}, 2000);
 });
</script>




<div id="main-content">
<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>
				<?php
	//show different confirmation messages based on the querystring value
	$s=get_field( "confirmation_popup" );
	$titles=get_field( "formtitle" );
	$formconfirm = $_GET['confirm'];
	
		switch ($formconfirm)
		{
		
			case 1:
			echo '<div id="myModal"><div class="modal-content"><div class="modal-header"><span class="close">&times;</span><h2>'.$titles.'</h2> </div><div class="modal-body">'.$s.'</div></div></div>
<script>jQuery(document.body).on("click",".modal-content .modal-header .close",function(){
      jQuery(this).parent().parent().hide();
});
</script>';
			break;
			
			case form2:
			echo "<div id=\"gforms_confirmation_message\">Thanks for submitting the second form. We'll be back in touch with you soon.</div>";
			break;
			
			case form2:
			echo "<div id=\"gforms_confirmation_message\">Thanks for submitting the third form. We'll be back in touch with you soon.</div>";
			break;
	
		}
	?>

					<div class="entry-content">
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>