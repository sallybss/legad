<?php
get_header();
?>

<main class="size-guide-page">

    <?php 
    $header_img = get_field('header_img');
    $tabs = get_field('tabs');
    ?>

    <?php if ($header_img): ?>
        <div class="sizeguide-hero">
            <img src="<?php echo esc_url($header_img['url']); ?>" alt="Size guide banner">
        </div>
    <?php endif; ?>

    <!-- Tab Navigation -->
    <div class="tab-nav">
        <?php foreach ($tabs as $index => $tab): ?>
            <button class="tab-link <?php if ($index === 0) echo 'active'; ?>"
                    onclick="openTab(event, 'tab-<?php echo esc_attr($index); ?>')">
                <?php echo esc_html($tab['tab_title']); ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Tab Content -->
    <div class="tab-content-wrapper">
        <?php foreach ($tabs as $index => $tab): ?>
            <div id="tab-<?php echo esc_attr($index); ?>" class="tab-content <?php if ($index === 0) echo 'active'; ?>">
                <div class="tab-inner">
                    <div class="left">
                        <?php if (!empty($tab['tab_image']['url'])): ?>
                            <img src="<?php echo esc_url($tab['tab_image']['url']); ?>" alt="<?php echo esc_attr($tab['tab_title']); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="right">
                        <?php if (!empty($tab['size_table'])): ?>
                            <table class="size-table">
                                <thead>
                                    <tr>
                                        <?php
                                        $custom_headers = explode('|', $tab['table_headers']);
                                        foreach ($custom_headers as $header): ?>
                                            <th><?php echo esc_html(trim($header)); ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tab['size_table'] as $row): ?>
                                        <tr>
                                            <?php foreach ($row as $value): ?>
                                                <td><?php echo esc_html($value); ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>

                        <?php if (!empty($tab['tab_text'])): ?>
                            <p><?php echo esc_html($tab['tab_text']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</main>

<script>
function openTab(evt, tabId) {
    const tabs = document.querySelectorAll('.tab-content');
    const buttons = document.querySelectorAll('.tab-link');

    tabs.forEach(tab => tab.classList.remove('active'));
    buttons.forEach(btn => btn.classList.remove('active'));

    document.getElementById(tabId).classList.add('active');
    evt.currentTarget.classList.add('active');
}
</script>

<?php get_footer(); ?>