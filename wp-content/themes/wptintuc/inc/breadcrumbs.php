<?php
/**
 * Breadcrumbs
 */
function wp_breadcrumbs()
{
	$delimiter = '
	<span class="icon">
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M6.6665 11.3333L9.72861 8.58922C10.0902 8.26515 10.0902 7.73485 9.72861 7.41077L6.6665 4.66666" stroke="#818181" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</span>
	';

	$home = __('Home', 'cltheme');
	$before = '<span class="current">';
	$after = '</span>';
	if (!is_home() && !is_front_page() || is_paged()) {

		global $post;

		echo '<nav>';
		echo '<div id="breadcrumbs" class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">';

		$homeLink = home_url();
		echo '<a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . ' ';

		switch (true) {
			case is_category() || is_archive():
				$cat_obj = get_queried_object();
				echo $before . $cat_obj->name . $after;
				break;

			case is_single() && !is_attachment():
				$post_type = $post->post_type;

				$id_page = get_field('br_' . $post_type, 'option') ?? null;
				if ($id_page) {
					echo '<a href="' . get_permalink($id_page) . '">' . get_the_title($id_page) . '</a>' . $delimiter . ' ';
				}

				echo $before . $post->post_title . $after;
				break;

			case is_page():
				if ($post->post_parent) {
					$parent_id = $post->ID;
					echo generate_page_parent($parent_id, $delimiter);
				}

				echo $before . custom_title(get_the_title(), false) . $after;
				break;

			case is_search():
				echo $before . 'Search' . $after;
				break;

			case is_404():
				echo $before . 'Error 404' . $after;
				break;
		}

		echo '</div>';
		echo '</nav>';
	}
} // end wp_breadcrumbs()

// Generate breadcrumbs ancestor page
function generate_page_parent($parent_id, $delimiter)
{
	$breadcrumbs = [];
	$output = '';

	while ($parent_id) {
		$page = get_post($parent_id);
		$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . custom_title(get_the_title($page->ID), false) . '</a>';
		$parent_id = $page->post_parent;
	}


	$breadcrumbs = array_reverse($breadcrumbs);
	array_pop($breadcrumbs);

	foreach ($breadcrumbs as $crumb) {
		$output .= $crumb . $delimiter;
	}

	return rtrim($output);
}