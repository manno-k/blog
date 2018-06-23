<article>
	<a href="<?php the_permalink() ?>">
		<dl>
			<dt><?php the_time( 'Y.m.d' ) ?>
				<span class="category"><?php the_category( '｜' ) ?></span>
			</dt>
			<dd>
				<h1>
					<?php the_title(); ?>
				</h1>
			</dd>
		</dl>
	</a>
</article>