<p>===</p>
<article class="c-related">
	<h1>related posts</h1>
	<?php
	//カテゴリ情報から関連記事を10個ランダムに呼び出す
	$categories  = get_the_category( $post->ID );
	$category_ID = array();
	foreach ( $categories as $category ):
		array_push( $category_ID, $category->cat_ID );
	endforeach;
	$args  = array(
		'post__not_in'   => array( $post->ID ),
		'posts_per_page' => 5,
		'category__in'   => $category_ID,
		'orderby'        => 'rand',
	);
	$query = new WP_Query( $args ); ?>
	<?php if ( $query->have_posts() ): ?>
		<?php while ( $query->have_posts() ) :
			$query->the_post(); ?>

			<section>
				<a href="<?php the_permalink() ?>">
					<dl>
						<dd>
							<h2>
								<?php the_title(); ?>
							</h2>
						</dd>
						<dt>
							<?php if ( has_post_thumbnail() ): ?>
								<?php echo get_the_post_thumbnail( $post->ID, 'thumb100' ); ?>
							<?php else: ?>
								<i class="fa fa-picture-o" aria-hidden="true"></i>
							<?php endif; ?>
						</dt>
						<dd><?php the_time( 'Y.m.d' ) ?>
							<span class="category"><?php the_category( '｜' ) ?></span>
						</dd>
					</dl>
				</a>
			</section>

		<?php endwhile; ?>

	<?php else: ?>
		<p>記事はありませんでした</p>
	<?php
	endif;
	wp_reset_postdata();
	?>
</article>

