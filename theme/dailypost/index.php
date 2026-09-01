<?php
if (!defined('_INDEX_')) {
    define('_INDEX_', true);
}

if (!defined('_GNUBOARD_')) {
    exit;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<main class="dp-home">
    <section class="dp-hero">
        <p class="dp-eyebrow">WRITE YOUR DAY</p>
        <h2>당신의 하루를 기록하세요.</h2>
        <p>DailyPost에서 일상과 생각을 자유롭게 나눠보세요.</p>
        <form
            action="<?php echo G5_BBS_URL; ?>/board.php"
            method="get"
            class="dp-hero-search"
        >
            <input type="hidden" name="bo_table" value="post">
            <input type="hidden" name="sfl" value="wr_subject||wr_content">
            <input type="hidden" name="sop" value="and">

            <label for="dp_search" class="sound_only">
                DailyPost 검색
            </label>

            <input
                type="search"
                name="stx"
                id="dp_search"
                placeholder="어떤 이야기를 찾고 있나요?"
                required
            >

            <button type="submit">
                검색
            </button>
        </form>
        <a
            href="<?php echo G5_BBS_URL; ?>/write.php?bo_table=post"
            class="dp-write-button"
        >
            새 글 작성
        </a>
    </section>

    <section class="dp-posts">
        <div class="dp-section-heading">
            <h2>최근 게시글</h2>

            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=post">
                전체 보기
            </a>
        </div>

        <?php
        echo latest('theme/dailypost', 'post', 6, 50);
        ?>
    </section>
</main>

<?php
include_once(G5_THEME_PATH.'/tail.php');