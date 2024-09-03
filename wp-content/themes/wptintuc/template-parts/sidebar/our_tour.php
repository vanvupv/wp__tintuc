<?php
$heading_tour_sidebar = get_field('heading_tour_sidebar_vi', 'option') ?? null;
$link_tour_sidebar = get_field('link_tour_sidebar_vi', 'option') ?? null;

if ($heading_tour_sidebar && $link_tour_sidebar): ?>
    <div class="ourTour">
        <h2 class="headingLineSidebar ourTour__heading">
            <?php echo $heading_tour_sidebar; ?>
        </h2>
        <div class="ourTour__list">
            <?php foreach ($link_tour_sidebar as $item): ?>
                <a _target="<?php echo $item['link']['target']; ?>" href="<?php echo $item['link']['url']; ?>"
                    class="h4 linkHover ourTour__item">
                    <?php echo $item['link']['title']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
<!--  -->