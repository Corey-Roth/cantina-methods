<?php
/*
Template Name: Recipe Book
*/
?>

<?php
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
?>

<?php get_header(); ?>

	<main role="main">

	<!-- Recipe flipper -->
		<section class="hero recipe">
			<div class="recipe-selector container centered flex-row">
				<div class="recipe-left">
					<p class="eyebrow">I need to...</p>
					<div class="styled-select">
						<select id="recipe-list">
							<option value="empty" data-id="0">Select a recipe</option>
							<?php
								$args = array('child_of' => 1359);
								$categories = get_categories( $args );
								foreach($categories as $category) { 
								    echo '<option data-id=' . $category->term_id . ' value=' . $category->slug . '>' . $category->name.'</option>';
								}
							?>
						</select>
					</div>
					<?php
					$args = array( 'child_of' => 25 , 'post_type' =>  'page' ); 
			    	$pagelist = get_pages( $args ); 
					foreach ($pagelist as $post) : setup_postdata($post);
					?>
					<div class="recipe-info" data-recipe="<?php the_field('recipe_slug'); ?>">
						<p class="recipe-desc">
							<?php the_field('recipe_description'); ?>
						</p>
						<div class="flex-row resources">
							<p>
								<strong>Format:</strong>
								<span class="format">
									<?php the_field('format'); ?>
								</Span>
							</p>
							<p>
								<strong>Time:</strong>
								<span class="time">
									<?php the_field('time'); ?>
								</span>
							</p>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<!-- Icon -->
				<?php 
				$image = get_field('icon');
				if( !empty($image) ): ?>
				<img class="recipe-icon" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" data-recipe="<?php the_field('recipe_slug'); ?>"/>
				<?php endif; ?>
			</div>
			
			<!-- cards -->
			<div class="card-sort container centered">
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
			</div>

			<div class="background-img">
				<?php 
				$image = get_field('icon');
				if( !empty($image) ): ?>
				<img class="recipe-icon" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" data-recipe="<?php the_field('recipe_slug'); ?>"/>
				<?php endif; ?>
			</div>
		</section>
	<!-- section -->
	</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	
	var selected;

	$(document).on('change','#recipe-list',function(){
		selected = $('#recipe-list').find(":selected").attr('value');
		toggleCards();
	});

	function toggleCards() {
		shuffleTheDeck('.styled-card');
		shuffleTheDeck('.recipe-info');
		shuffleTheDeck('.recipe-icon');
	}

	function shuffleTheDeck(x) {
		$(x).each(function(index){
			$recipe = $(this).attr('data-recipe');
			if ( $recipe.includes(selected)) {
				$(this).delay(400).fadeIn(300);
			} else {
				$(this).fadeOut(300);
			}
		});
	}

	function clearTheStage() {
		$('.recipe-info').addClass('hidden');
		$('.recipe-icon').addClass('hidden');
	}

	clearTheStage();
</script>

<?php get_footer(); ?>
