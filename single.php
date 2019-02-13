<?php get_header(); ?>

	<main role="main">
	<!-- section -->
		<section class="hero card">
			<div class="container centered flex-row">
				<div class="flex-col col-md-7">
					<h1><?php the_title(); ?></h1>
					<div class="large mb-3">
						<?php the_field('card_description'); ?>
					</div>
					<div class="flex-row mb-3">
						<div class="flex-col">
							<h2>Serving suggestion</h2>
							<?php the_field('serving_suggestions'); ?>
						</div>
						<div class="flex-col">
							<h2>Pairs well with</h2>
							<?php the_field('pairs_with'); ?>
						</div>
					</div>
					<h2>Recipes</h2>
					<div class="unstyled-list large">
						<?php the_field('recipes'); ?>
					</div>
				</div>
				<div class="styled-card">
					<p class="tag">Look In</p>
					<h2>How to do it:</h2>
					<?php the_field('how_to_do_it'); ?>
					<div class="footer">
						<h3>Success looks like:</h3>
						<?php the_field('success'); ?>
					</div>
				</div>
			</div>
		</section>

		<section class="container centered spacer">
			<h2 class="underline text-center">More resources</h2>
			<div class="flex-row resources">
				<div class="resource">
					<?php the_field('resource_1'); ?>
				</div>
				<div class="resource">
					<?php the_field('resource_2'); ?>
				</div>
				<div class="resource">
					<?php the_field('resource_3'); ?>
				</div>
			</div>
		</section>
	<!-- /section -->
	</main>

<?php get_footer(); ?>
