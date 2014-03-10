<article <?php post_class(); ?>>
	<?php 
		$feat_post = get_post_meta($post->ID, '_krank_feat_post', true);
		echo $feat_post;
	?>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="feat-img">
			<div class="feat-post">
				Featured Post
			</div>
			<a href="<?php the_permalink(); ?>" title="Read <?php the_title(); ?>">
				<?php the_post_thumbnail('post-thumb'); ?>
				<span class="img-more">
					<i class="fa-share"></i>
				</span>
			</a>
		</div>
	<?php } // endif ?>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
	<?php the_excerpt(); ?>
	<a class="btn btn-sm read-more" href="<?php the_permalink(); ?>" title="Continue reading <?php the_title(); ?>" >Read More</a>
  </div>
</article>