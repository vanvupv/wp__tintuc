<?php
$heading_support = get_field('heading_support_vi', 'option') ?? null;
$support_list = get_field('online_support_vi', 'option') ?? null;

if ($heading_support && $support_list): ?>
    <div class="supportDetail">
        <h2 class="supportDetail__title">
            <?php echo $heading_support; ?>
        </h2>
        <div class="supportDetail__list">
            <?php foreach ($support_list as $item): ?>
                <div class="supportDetail__item">
                    <div>
                        <?php echo $item['subtitle']; ?>
                    </div>
                    <span class="h3">
                        <?php echo $item['title']; ?>
                    </span>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php endif; ?>