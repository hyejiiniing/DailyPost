<?php
if (!defined('_GNUBOARD_')) {
    exit;
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

add_stylesheet(
    '<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">',
    0
);

$list_count = is_array($list) ? count($list) : 0;
?>

<div class="dp-latest-grid">
    <?php
    for ($i = 0; $i < $list_count; $i++) {
        $thumbnail = get_list_thumbnail(
            $bo_table,
            $list[$i]['wr_id'],
            480,
            300,
            false,
            true
        );
    ?>
        <article class="dp-latest-card">
            <a
                href="<?php echo get_pretty_url($bo_table, $list[$i]['wr_id']); ?>"
                class="dp-latest-link"
            >
                <?php if (!empty($thumbnail['src'])) { ?>
                    <div class="dp-latest-image">
                        <img
                            src="<?php echo $thumbnail['src']; ?>"
                            alt="<?php echo get_text($list[$i]['subject']); ?>"
                            loading="lazy"
                        >
                    </div>
                <?php } else { ?>
                    <div class="dp-latest-image dp-latest-placeholder">
                        DailyPost
                    </div>
                <?php } ?>

                <div class="dp-latest-content">
                    <h3>
                        <?php echo get_text($list[$i]['subject']); ?>
                    </h3>

                    <div class="dp-latest-meta">
                        <span><?php echo $list[$i]['name']; ?></span>
                        <span><?php echo $list[$i]['datetime2']; ?></span>
                    </div>
                </div>
            </a>
        </article>
    <?php } ?>

    <?php if ($list_count === 0) { ?>
        <div class="dp-latest-empty">
            아직 등록된 게시글이 없습니다.
        </div>
    <?php } ?>
</div>