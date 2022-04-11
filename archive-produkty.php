<?php 

/* 
Template Name: Archive - custom-post-produkty
*/

get_header(); ?>


<main>

	<div class="obal">

		<div class="nadpis-custom-post-produkty">

			<h1>Kategórie produktov</h1>

		</div>

		<div class="kategorie-custom-post-produkty">
			<ul>

				<?php //zobrazenie kategorií
				function zobraz_kategorie() {
					// Get the taxonomy's terms
					$terms = get_terms(
						array(
							'taxonomy'   => 'produkty_category',
							'hide_empty' => false,
						)
					);

					// Check if any term exists
					if ( ! empty( $terms ) && is_array( $terms ) ) {
						// Run a loop and print them all
						foreach ( $terms as $term ) { ?>
				<li id="<?php echo $term->term_id; ?>"><a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
					<?php echo $term->name; ?>
					</a></li><?php
													}
					} 

				}

				echo zobraz_kategorie();
				?>
				

				
			</ul>
			
		</div>

	</div>

	<div class="obal custom-post-produkty archive-custom-post-produkty">

		<div class="bocny-panel">

			<?php if ( dynamic_sidebar('produkty_bocny_panel') ) : else : endif; ?>


		</div>

		<div class="custom-post-produkty-prava-strana">
			
			<ul>



				<?php
				// Start the Loop
				while ( have_posts() ) : the_post(); ?>

				<?php if ( has_post_thumbnail() ) { ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?><div class="overlay"><i class="fa fa-search"></i></div></a></li>
				  <?php 
					  }else{ 
				  ?>
					  <li><a href="<?php the_permalink(); ?>"><img src="https://finestudio.sk/wp-content/uploads/2021/06/Ikonka-eshop@2x-8.png" class="attachment-full size-full wp-post-image" alt="obrazok-nie-je"><div class="overlay"><i class="fa fa-search"></i></div></a></li>
					  <?php
				  } 
				  ?>  





				<?php endwhile; ?>
				
				<span class="clear-float"></span>
				
			</ul>
		

		</div>

		<span class="clear-float"></span>
		
		<?php
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$args = array(
			'post_type' => 'produkty',
			'posts_per_page' => 12,
			'paged' => $paged
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
		// CPT content
		endwhile;
		?>
		<div class="custom-post-produkty-pagination">
			<?php
			$big = 999999999;
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $loop->max_num_pages,
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;'
			) );
			?>
		</div>
		<?php wp_reset_postdata(); ?>

	</div>

</main>


<?php get_footer(); ?>
