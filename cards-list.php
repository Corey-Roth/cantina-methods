<?php
/*
Template Name: Card Deck
*/
?>

<?php get_header(); ?>

	<main role="main">
	<!-- section -->
		<section class="hero">
			<div class="container centered text-center">
				<div class="hero-text">
					<h1><?php the_title(); ?></h1>
					<div class="">
						<?php
						    wp_reset_query(); // necessary to reset query
						    while ( have_posts() ) : the_post();
						        the_content();
						    endwhile; // End of the loop.
						?>
					</div>
				</div>
			</div>
			<div class="background-img">
				<?php
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail( 'full' );
				}
				?>
			</div>
		</section>
		
		<section class="card-sort container spacer centered">
			<a id="cards"></a>
			<div class="flex-row phase-row">
				<div class="phase" data-category="Look In">
					<h3><a href="#cards">Look In</a></h3>
					<hr/>
					<p>Build an understanding of the organization and industry to serve as a foundation and starting point of the project.</p>
				</div>
				<div class="phase" data-category="Look Out">
					<h3><a href="#cards">Look Out</a></h3>
					<hr/>
					<p>Learn about your target users and gain an understanding of their motiviations, behaviors, attitudes and needs in order to design something that is right for them.</p>
				</div>
				<div class="phase" data-category="Expand">
					<h3><a href="#cards">Expand</a></h3>
					<hr/>
					<p>Go big and broad, build out your team, explore a multitude of possible solutions and directions.</p>
				</div>
				<div class="phase" data-category="Focus">
					<h3><a href="#cards">Focus</a></h3>
					<hr/>
					<p>Start to narrow and refine your direction. Who are you designing for? What role does your brand or organization play in their process? What are the key opportunities?</p>
				</div>
				<div class="phase" data-category="Look Forward">
					<h3><a href="#cards">Look Forward</a></h3>
					<hr/>
					<p>Transitioning from “what is” to “what could be”. Setting the design direction and providing the creative team the tools they need for success.</p>
				</div>
			</div>
			<div class="flex-row phase-row">
				<button class="show centered">Show All</button>
			</div>
			<div class="flex-row card-flex">
				<?php 
				// the query
				$wp_args = array(
					'order'   => 'ASC',
					'post_type'=>'post',
					'post_status'=>'publish',
					'posts_per_page'=>-1
				);
				$wpb_all_query = new WP_Query($wp_args); ?>
				<?php if ( $wpb_all_query->have_posts() ) : ?>
				<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
				<div class="styled-card mini" data-category="<?php 
			    	$args = array('child_of' => 1358);
					$post_categories = wp_get_post_categories( get_the_ID($args) );
					foreach($post_categories as $c){
					    $cat = get_category( $c );
					    if ($cat->name == 'Look In' || $cat->name == 'Look Out' || $cat->name == 'Look Forward' || $cat->name == 'Expand' || $cat->name == 'Focus') {
					    	$cat_name = ucfirst($cat->name);
						    echo $cat_name;
					    } else {
					    	//do nothing
						}
					}?>" 
			    	data-recipe="
			    	<?php
			    	$args = array('child_of' => 1359);
					$post_categories = wp_get_post_categories( get_the_ID() );
					foreach($post_categories as $c){
					    $cat = get_category( $c );
					    echo $cat->slug . ' ';
					}
					?>"> 

				    <h3><?php the_title(); ?></h3> 
				    <?php the_field('short_description'); ?>
				    <a href="<?php the_permalink(); ?>">View Card</a>
				</div>
				<?php endwhile; ?>
				<!-- end of the loop -->

				<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			</div>
		</section>
	<!-- /section -->
	</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

	var currentPhase;
	var $deckHeight;

	$('.show').fadeOut(300);

	$(".phase").click(function(){
		$('.phase').removeClass('active');
		$(this).addClass('active');
		getTheCategory($(this).attr("data-category"));
	});

	function getTheCategory(activePhase) {
		if (currentPhase == activePhase) {
			showAll();
		} else {
			currentPhase = activePhase;
			toggleCards(activePhase);
			$('.show').fadeIn(300);
		}
	}

	function toggleCards(activePhase) {
		$('.styled-card').each(function(index){
			$phase = $(this).attr('data-category');
			if ( $phase == activePhase) {
				$(this).delay(400).fadeIn(300);
			} else {
				$(this).fadeOut(300);
			}
		});

	}

	function showAll() {
		$('.styled-card').fadeOut(300);
		$('.styled-card').delay(400).fadeIn(300);
		$('.show').fadeOut(300);
		$('.phase').removeClass('active');
	}

	function checkHeight() {
		$deckHeight = $('.card-flex').height();
		$('.card-flex').height($deckHeight);
	}

	$('.show').click(function(){
		if (currentPhase) {
		showAll();
		} else {
			//nada
		}
	});

	$(document).ready(function(){
		checkHeight();
	});

	$(window).resize(function(){
		checkHeight();
	});

</script>
<?php get_footer(); ?>
