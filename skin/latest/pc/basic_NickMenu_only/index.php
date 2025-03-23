<?php
define('_GNUBOARD_', true);
include_once('./common.php'); // 그누보드 환경설정 파일

// 테마 헤더 포함
include_once(G5_THEME_PATH.'/head.php');
?>

<h2 class="sound_only">베이직 최신글</h2>

<div class="latest_wr">
    <!-- 새로운 게시판 목록 -->
    <?php
    // `basic_NickMenu_only` 스킨을 활용하여 최신글 출력
    echo latest('theme/basic_NickMenu_only', 'free', 4, 30);
    ?>
</div>

<?php
// 테마 푸터 포함
include_once(G5_THEME_PATH.'/tail.php');
?>
