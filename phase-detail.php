<?php
/*
Template Name: Phase Detail Page
*/
?>


<?php get_header(); ?>

	<main role="main">

		<!-- main content -->
		<section class="hero">
			<div class="container centered text-center">
			<h1><?php the_title(); ?></h1>
			<?php echo wpautop($post->post_content); ?>
			</div>
		</section>

		<section class="card-sort container spacer centered">
			<h2 class="underline text-center">Phase Cards</h2>
			<div class="flex-row card-flex">
				<?php
			    $args = array( 'category' => 4, 'post_type' =>  'post' ); 
			    $postslist = get_posts( $args );    
			    foreach ($postslist as $post) :  setup_postdata($post); 
			    ?>
			    <div class="styled-card mini">  
				    <h3><?php the_title(); ?></h3> 
				    <?php the_field('card_description'); ?>
				    <a href="<?php the_permalink(); ?>">View Card</a>
				</div>
			    <?php endforeach; ?> 
			</div>
		</section>
		<!-- end main content -->

	</main>

<?php get_footer(); ?>
