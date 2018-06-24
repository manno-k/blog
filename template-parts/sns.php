<nav class="c-sns">
	<ul>
		<li>
			<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank">
				<?php echo wp_get_svg( array( 'icon' => 'hatena' ) ); ?>
			</a>
		</li>
		<li>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
				<i class="fa fa-4x fa-facebook" aria-hidden="true"></i>
			</a>
		</li>
		<li>
			<a href="http://twitter.com/home?status=<?php echo urlencode(the_title_attribute('echo=0')); ?>%20<?php the_permalink(); ?>" target="_blank">
				<i class="fa fa-4x fa-twitter" aria-hidden="true"></i>
			</a>
		</li>
		<li>
			<a href="http://getpocket.com/edit?url=<?php the_permalink(); ?>" target="_blank">
			<i class="fa fa-4x fa-get-pocket" aria-hidden="true"></i>
			</a>
		</li>
		<li>
			<a href="<?php echo home_url('/?feed=rss2'); ?>" target="_blank">
				<i class="fa fa-4x fa-rss" aria-hidden="true"></i>
			</a>
		</li>
	</ul>
</nav>