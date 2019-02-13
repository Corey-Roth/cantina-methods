<?php
/*
Template Name: Method Cards Homepage
*/
?>

<?php get_header(); ?>

	<main role="main">
	<!-- section -->
		<section class="hero">
			<div class="container centered text-center">
			<h1><?php the_title(); ?></h1>
			<?php the_field('banner_copy'); ?>
			</div>
		</section>

		<section class="small-container centered spacer">
			<div class="flex-row">
			<h2 class="underline">Our Philosophy</h2>
				<div class="content-right light">
					<?php the_field('our_philosophy'); ?>
				</div>
			</div>
		</section>

		<section class="quote">
			<div class="small-container centered text-center">
				<?php the_field('quote'); ?>
			</div>
		</section>
		
		<section class="card-sort container spacer centered">
			<div class="flex-row phase-row">
				<div class="phase" data-category="Look In">
					<h3>Look In</h3>
					<p>Build an understanding of the organization and industry to serve as a foundation and starting point of the project.</p>
				</div>
				<div class="phase" data-category="Look Out">
					<h3>Look Out</h3>
					<p>Learn about your target users and gain an understanding of their motiviations, behaviors, attitudes and needs in order to design something that is right for them.</p>
				</div>
				<div class="phase" data-category="Expand">
					<h3>Expand</h3>
					<p>Go big and broad, build out your team, explore a multitude of possible solutions and directions.</p>
				</div>
				<div class="phase" data-category="Focus">
					<h3>Focus</h3>
					<p>Start to narrow and refine your direction. Who are you designing for? What role does your brand or organization play in their process? What are the key opportunities?</p>
				</div>
				<div class="phase" data-category="Look Forward">
					<h3>Look Forward</h3>
					<p>Transitioning from “what is” to “what could be”. Setting the design direction and providing the creative team the tools they need for success.</p>
				</div>
			</div>
			<div class="flex-row phase-row">
				<button class="show centered">Show All</button>
			</div>
			<div class="flex-row card-flex">
				<?php
			    $args = array( 'category' => 3, 'post_type' =>  'post' ); 
			    $postslist = get_posts( $args );    
			    foreach ($postslist as $post) :  setup_postdata($post); 
			    ?>
			    <div class="styled-card mini" data-category="<?php $category = get_the_category(); $firstCategory = $category[1]->cat_name; echo $firstCategory;?>">  
				    <h3><?php the_title(); ?></h3> 
				    <?php the_field('short_description'); ?>
				    <a href="<?php the_permalink(); ?>">View Card</a>
				</div>
			    <?php endforeach; ?>
			</div>
		</section>
	<!-- /section -->
	</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

	var currentPhase;

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
			console.log(activePhase);
			toggleCards(activePhase);
		}
	}

	function toggleCards(activePhase) {
		$('.styled-card').each(function(index){
			$phase = $(this).attr('data-category');
			if ( $phase == activePhase) {
				$(this).removeClass('hidden');
			} else {
				$(this).addClass('hidden');
			}
		});
	}

	function showAll() {
		$('.styled-card').removeClass('hidden');
	}

	$('.show').click(function(){
		showAll();
	});

</script>
<?php get_footer(); ?>
