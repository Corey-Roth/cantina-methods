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
								$args = array('child_of' => 5);
								$categories = get_categories( $args );
								foreach($categories as $category) { 
								    echo '<option data-id=' . $category->term_id . ' value=' . $category->slug . '>' . $category->name.'</option>';
								}
							?>
						</select>
					</div>
					<?php
					$args = array( 'child_of' => 14 , 'post_type' =>  'page' ); 
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
					//$activecategory = get_field('recipe_number');
				    $args = array( 'category' => 3 , 'post_type' =>  'post' ); 
				    $postslist = get_posts( $args );    
				    foreach ($postslist as $post) :  setup_postdata($post); 
				    ?>
				    <div class="styled-card mini" data-category="<?php $category = get_the_category(); $firstCategory = $category[2]->cat_name; echo $firstCategory;?>" 
				    	data-recipe="
				    	<?php
				    	$args = array('child_of' => 5);
						$post_categories = wp_get_post_categories( get_the_ID() );
						$cats = array();
						foreach($post_categories as $c){
						    $cat = get_category( $c );
						    echo $cat->slug . ' ';
						    $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
						}
						?>"> 

					    <h3><?php the_title(); ?></h3> 
					    <?php the_field('short_description'); ?>
					    <a href="<?php the_permalink(); ?>">View Card</a>
					</div>
				    <?php endforeach; ?>
				</div>
			</div>
		</section>
	<!-- section -->
	</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var recipeBook = [];
	var selected;
	$('#recipe-list option').each(function(index){
		var recipe = [$(this).attr('data-id'), $(this).attr('value')];
		recipeBook = recipeBook.concat(recipe);
	});

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
				$(this).removeClass('hidden');
			} else {
				$(this).addClass('hidden');
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
