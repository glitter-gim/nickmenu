<?php
define('_GNUBOARD_', true);
include_once('./common.php'); // 그누보드 환경설정 파일

// 테마 헤더 포함
include_once(G5_THEME_PATH.'/head.php');
?>

<h2 class="sound_only">사진 리스트 최신글</h2>

<div class="latest_wr">
    <!-- 📷 새로운 사진 리스트 게시판 목록 -->
    <?php
    // `pic_list_NickMenu_only` 스킨을 활용하여 최신글 출력
    echo latest('theme/pic_list_NickMenu_only', 'free', 4, 30);
    ?>
</div>

<?php
// 테마 푸터 포함
include_once(G5_THEME_PATH.'/tail.php');
?>
