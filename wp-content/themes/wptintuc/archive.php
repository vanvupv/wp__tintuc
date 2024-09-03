<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cltheme
 */

get_header();
?>

<?php
$archive = get_queried_object();

$archive_id = $archive->term_id;
$archive_name = $archive->name;
$img_url = get_field('featured_image', 'category_' . $archive_id);

get_template_part('template-parts/banner_blog');
?>

<?php
$bg = get_field("background_image", $archive) ?? get_background_image();

if ($bg): ?>
	<div class="bannerContact" style="background-image: url(<?php echo $bg; ?> )">
		<div class="container">
			<div class="bannerContact__inner">
				<div class="secSpace bannerContact__content">
					<h1 class="bannerContact__title">
						<?php echo $archive_name; ?>
					</h1>
					<div class="breadcrumbContact">
						<?php wp_breadcrumbs(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<!-- -->
<section>
	<div class="blog space">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<?php
					if (have_posts()):
						while (have_posts()):
							the_post();
							get_template_part('template-parts/single/blog_item', get_post_format());
						endwhile;
						wp_reset_postdata();
					endif;
					?>
					<div class="pagination">
						<?php
						echo paginate_links(
							array(
								'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
								'total' => $wp_query->max_num_pages,
								'current' => max(1, get_query_var('paged')),
								'format' => '?paged=%#%',
								'show_all' => false,
								'type' => 'plain',
								'end_size' => 2,
								'mid_size' => 1,
								'prev_next' => true,
								'prev_text' => '',
								'next_text' => '',
								'add_args' => false,
								'add_fragment' => '',
							)
						);
						?>
					</div>
				</div>
				<div class="col-lg-4">
					<!-- Catory -->
					<?php get_template_part('template-parts/sidebar/category'); ?>
					<!-- / Catory -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- -->
<?php
get_footer();

