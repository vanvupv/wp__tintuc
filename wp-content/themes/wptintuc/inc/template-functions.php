<?php
// Setup theme setting page
if (function_exists('acf_add_options_page')) {
    $name_option = 'Theme Settings';
    acf_add_options_page(
        array(
            'page_title' => $name_option,
            'menu_title' => $name_option,
            'menu_slug' => 'theme-settings',
            'capability' => 'edit_posts',
            'redirect' => false,
            'position' => 80
        )
    );
}

// The function "write_log" is used to write debug logs to a file in PHP.
function write_log($log = null, $title = 'Debug')
{
    if ($log) {
        if (is_array($log) || is_object($log)) {
            $log = print_r($log, true);
        }

        $timestamp = date('Y-m-d H:i:s');
        $text = '[' . $timestamp . '] : ' . $title . ' - Log: ' . $log . "\n";
        $log_file = WP_CONTENT_DIR . '/debug.log';
        $file_handle = fopen($log_file, 'a');
        fwrite($file_handle, $text);
        fclose($file_handle);
    }
}

// Replacing underscores and dashes with spaces, capitalizing the first letter of each word, and removing spaces.
function custom_name_block($input)
{
    $normalized = str_replace(['_', '-'], ' ', $input);
    $ucwords = ucwords($normalized);
    $formatted = str_replace(' ', '', $ucwords);

    return 'section' . $formatted;
}

// custom text title by character
function custom_title($text = '', $character = true)
{
    if ($character) {
        $text = preg_replace('/\[{(.*?)}\]/', '<span class="character">$1</span>', $text);
    } else {
        $text = str_replace(['[', ']', '{', '}'], '', $text);
    }

    return $text;
}

// block info general information
function block_info($data_block = null)
{
    ob_start();

    if ($data_block):
        $data = [
            'title' => $data_block['title'] ?? null,
            'desc' => $data_block['description'] ?? null,
            'link' => $data_block['link'] ?? null,
        ];

        // render html the section
        if ($data['title'] || $data['desc'] || $data['link']):
            ?>
            <div class="secHeading">
                <?php if ($data['title']): ?>
                    <h2 class="secTitle secHeading__title">
                        <?php echo $data['title']; ?>
                    </h2>
                <?php endif; ?>

                <?php if ($data['desc']): ?>
                    <div class="editor secHeading__desc">
                        <?php echo $data['desc']; ?>
                    </div>
                <?php endif; ?>

                <?php
                if ($data['link']) {
                    echo custom_link($data['link'], 'secHeading__link');
                }
                ?>
            </div>
            <?php
        endif;
    endif;

    return ob_get_clean();
}
// end block info

// block btn link general
function custom_link($link = null, $class = null)
{
    ob_start();

    if ($link):
        // validate link
        $url = !empty($link['url']) ? $link['url'] : '';
        $title = !empty($link['title']) ? $link['title'] : __('See more', 'cltheme');
        $target = !empty($link['target']) ? $link['target'] : '';

        if ($url):
            ?>
            <div class="<?php echo $class . 'Block'; ?>">
                <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="btnLink <?php echo $class; ?>">
                    <?php echo $title; ?>
                </a>
            </div>
            <?php
        endif;
    endif;

    return ob_get_clean();
}

// block image link general
function custom_img_link($link = null, $image = '', $class = '')
{
    ob_start();

    if ($image):
        // validate link
        $url = !empty($link['url']) ? $link['url'] : 'javascript:void(0);';
        $title = !empty($link['title']) ? $link['title'] : __('See more', 'cltheme');
        $target = !empty($link['target']) ? $link['target'] : '_self';
        $class_img_block = empty($link['url']) ? ' cursor-default ' : '';
        $class_img_block .= $class ? $class . 'Block' : '';

        // renter html
        ?>
        <a class="imgGroup <?php echo $class_img_block; ?>" href="<?php echo $url; ?>" target="<?php echo $target; ?>">
            <img class="<?php echo $class; ?>" width="300" height="300" src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
        </a>
        <?php
    endif;

    return ob_get_clean();
}

// Count the elements that exist in the array to use check
function custom_count_array($array = [], $keys = [], $requireAll = true)
{
    $count = 0;

    foreach ($array as $item) {
        $hasValues = $requireAll;

        foreach ($keys as $key) {
            if ($requireAll) {
                if (empty($item[$key])) {
                    $hasValues = false;
                    break;
                }
            } else {
                if (!empty($item[$key])) {
                    $hasValues = true;
                    break;
                }
            }
        }

        if ($hasValues) {
            $count++;
        }
    }

    return $count;
}

// change hex color code to rgba
function hexToRgb($hex)
{
    $hex = str_replace("#", "", $hex);

    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    return $r . ', ' . $g . ', ' . $b;
}

// Added color selection option
function custom_color_tinymce($options)
{
    $options['textcolor_map'] = json_encode(
        array(
            '134D8B',
            'Primary',
            'C72127',
            'Secondary',
            '2E2E2E',
            'Text body'
        )
    );
    return $options;
}
add_filter('tiny_mce_before_init', 'custom_color_tinymce');

// used for fulltext search
function modify_search_query($query)
{
    if ($query->is_search() && !is_admin()) {
        // get param on url
        $postTypeSearch = 'all';
        if (isset($_GET["post_type"])) {
            $postTypeSearch = $_GET['post_type'];
        }

        // Returns results according to the desired post types
        if ($postTypeSearch == 'event') {
            $query->set('post_type', 'event');
        } else if ($postTypeSearch == 'post') {
            $query->set('post_type', 'post');
        } else if ($postTypeSearch == 'testimonial') {
            $query->set('post_type', 'testimonial');
        } else if ($postTypeSearch == 'leader') {
            $query->set('post_type', 'leader');
        } else {
            $query->set('post_type', ['post', 'event', 'leader', 'testimonial']);
        }
    }

    return $query;
}
add_filter('pre_get_posts', 'modify_search_query', 99, 1);

// Converts date types into a certain format
function custom_convert_time($date_time, $format = "d/m/Y")
{
    $date_time_object = null;

    switch (true) {
        // Format d/m/Y
        case (strpos($date_time, '/') !== false):
            $date_time_object = DateTime::createFromFormat('d/m/Y', $date_time);
            break;
        // Format Ymd
        case (strlen($date_time) === 8 && ctype_digit($date_time)):
            $date_time_object = DateTime::createFromFormat('Ymd', $date_time);
            break;
        // Format Y-m-d
        case (strpos($date_time, '-') !== false):
            $date_time_object = DateTime::createFromFormat('Y-m-d', $date_time);
            break;
        // Format d.m.Y or m.d.Y
        case (strpos($date_time, '.') !== false):
            $date_time_object = DateTime::createFromFormat('d.m.Y', $date_time);
            if (!$date_time_object) {
                $date_time_object = DateTime::createFromFormat('m.d.Y', $date_time);
            }
            break;
        // Format M j, Y or j M Y
        case (preg_match('/^(?:\d{1,2}\s)?(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s\d{4}$/', $date_time)):
            $date_time_object = DateTime::createFromFormat('M j, Y', $date_time);
            if (!$date_time_object) {
                $date_time_object = DateTime::createFromFormat('j M Y', $date_time);
            }
            break;
        // Format j F Y or F j, Y
        case (preg_match('/^(?:\d{1,2}\s)?(?:January|February|March|April|May|June|July|August|September|October|November|December)\s\d{4}$/', $date_time)):
            $date_time_object = DateTime::createFromFormat('j F Y', $date_time);
            if (!$date_time_object) {
                $date_time_object = DateTime::createFromFormat('F j, Y', $date_time);
            }
            break;
    }

    // If there's a date object, format it to the desired format
    if ($date_time_object instanceof DateTime) {
        return $date_time_object->format($format);
    }

    return false;
}

/**
 * Add Recommended size image to Featured Image Box
 */
add_filter('admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction($html)
{
    $post_type = get_post_type();
    switch ($post_type) {
        case 'post':
            $html .= '<p>Recommended size: 500x310</p>';
            break;
        case 'event':
            $html .= '<p>Recommended size: 500x135</p>';
            break;
        default:
            break;
    }

    return $html;
}

// dump + die()
function dd($data)
{
    echo '<div style="background-color: #c0c0c0; border: 1px solid #ddd; color: #333; padding: 20px; margin: 20px;">';
    echo '<div style="font-size: 20px; font-weight: bold; color: #007bff; margin-bottom: 10px;">Debug Data</div>';
    echo '<div style="font-family: monospace;">';
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    echo '</div>';
    echo '</div>';
    die();
}

function the_url_search()
{
    $search = get_site_url();

    if (function_exists('pll_default_language')) {
        if (pll_default_language() !== LANG) {
            $search = $search . '/' . LANG . '/';
        }
    }

    echo $search;
}

function custom_replace_text($text, $arr = null)
{
    if ($text && $arr) {
        $patterns = array_map(function ($key) {
            return '/\b(' . preg_quote($key, '/') . ')\b/i';
        }, array_keys($arr));

        $replacements = array_values($arr);

        $text = preg_replace($patterns, $replacements, $text);

        return $text;
    }

    return false;
}

function custom_filter_by_post_type($post_type)
{
    $taxonomies = get_object_taxonomies($post_type, 'objects');
    $tax_ignore = [
        'language',
        'post_translations',
    ];

    foreach ($taxonomies as $taxonomy) {
        if (in_array($taxonomy->name, $tax_ignore)) {
            continue;
        }

        $terms = get_terms(
            array(
                'taxonomy' => $taxonomy->name,
                'hide_empty' => true,
            )
        );

        if (!empty($terms)) {
            wp_dropdown_categories(
                array(
                    'show_option_all' => __("All {$taxonomy->label}"),
                    'taxonomy' => $taxonomy->name,
                    'name' => "{$taxonomy->name}_filter",
                    'orderby' => 'name',
                    'selected' => isset($_GET["{$taxonomy->name}_filter"]) ? $_GET["{$taxonomy->name}_filter"] : '',
                    'show_count' => false,
                    'hide_empty' => false,
                )
            );
        }
    }
}
add_action('restrict_manage_posts', 'custom_filter_by_post_type');

function custom_filter_by_post_type_query($query)
{
    if (is_admin() && $query->is_main_query() && !empty($_GET['post_type'])) {
        $taxonomies = get_object_taxonomies($_GET['post_type'], 'objects');

        if ($taxonomies) {
            foreach ($taxonomies as $taxonomy) {
                if (!empty($_GET["{$taxonomy->name}_filter"])) {
                    if ($_GET["{$taxonomy->name}_filter"] !== '0') {
                        $query->set(
                            'tax_query',
                            array(
                                array(
                                    'taxonomy' => $taxonomy->name,
                                    'field' => 'term_id',
                                    'terms' => $_GET["{$taxonomy->name}_filter"],
                                ),
                            )
                        );
                    }
                }
            }
        }
    }
}
add_action('pre_get_posts', 'custom_filter_by_post_type_query');