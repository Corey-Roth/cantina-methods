<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>



		<!-- [Mini modal] -->
		<div class="modal" id="modal-1" aria-hidden="true">
			<div class="modal-window">

			  <div tabindex="-1" data-micromodal-close>

			    <div role="dialog" aria-modal="true" aria-labelledby="modal-1-title" >


			      <header>
			        <h2 id="modal-1-title">
			          Contact Us
			        </h2>

			        <hr/>

			        <p>Let's talk about your project</p>

			        <button class="header-close" aria-label="Close modal">
			        	<img src="https://methodcardscantina.wpcomstaging.com/wp-content/uploads/2019/03/Close.png" alt="close"  data-micromodal-close/>
			        </button>
			      </header>

			      <div id="modal-1-content">
			        Modal Content
			      </div>

			    </div>
			  </div>
			</div>
			<!-- end modal -->

			<div class="modal-curtain" data-micromodal-close></div>
		</div>

		<!-- wrapper -->
		<div class="ribbon">
			<div class="container centered">
				<a href="https://cantina.co/" target="_blank">Visit cantina.co &raquo;</a>
			</div>
		</div>

		<div class="wrapper">

			<!-- header -->
			<header class="container centered page-header" role="banner">

					<!-- logo -->
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
						</a>
					</div>
					<!-- /logo -->

					<!-- nav -->
					<nav class="main-nav" role="navigation">
						<?php html5blank_nav(); ?>
						<button class="cta" data-micromodal-trigger="modal-1">Contact Us</button>
					</nav>
					<!-- /nav -->

			</header>
			<!-- /header -->
