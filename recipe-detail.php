<?php
/*
Template Name: Recipe Detail
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
						<select>
							<option><?php the_title(); ?></option>
						</select>
					</div>
					<div class="recipe-info">
						<p><?php the_field('recipe_description'); ?></p>
						<div class="flex-row resources">
							<p><strong>Format:</strong> <?php the_field('format'); ?></p>
							<p><strong>Time:</strong> <?php the_field('time'); ?></p>
						</div>
					</div>
				</div>
				<!-- Icon -->
				<?php 
				$image = get_field('image');
				if( !empty($image) ): ?>
				<img class="recipe-icon" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
			</div>
			
			<!-- cards -->
			<div class="card-sort container centered">
				<div class="flex-row card-flex">
					<?php
					$activecategory = get_field('recipe_number');
				    $args = array( 'category' => $activecategory , 'post_type' =>  'post' ); 
				    $postslist = get_posts( $args );    
				    foreach ($postslist as $post) :  setup_postdata($post); 
				    ?>
				    <div class="styled-card mini" data-category="<?php $category = get_the_category(); $firstCategory = $category[1]->cat_name; echo $firstCategory;?>" 
				    	data-recipe="<?php $args = array('child_of' => 5);
				    	$categories = get_categories( $args );
				    	foreach($categories as $category) { 
					    echo $category->slug;
						}?>">  
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


<?php get_footer(); ?>
