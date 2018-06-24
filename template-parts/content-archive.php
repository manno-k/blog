<article>
	<a href="<?php the_permalink() ?>">
		<dl>
			<dd>
				<time>
					<?php the_time( 'Y.m.d' ) ?>
				</time>
				<h1>
					<?php the_title(); ?>
				</h1>
			</dd>
			<dt>
				<?php if ( has_post_thumbnail() ): ?>
					<?php echo get_the_post_thumbnail( $post->ID, 'thumb100' ); ?>
				<?php else: ?>
					<i class="fa fa-picture-o" aria-hidden="true"></i>
				<?php endif; ?>
			</dt>

		</dl>
	</a>
</article>