<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<div class="lat">
    <h2 class="lat_title"><a href="<?php echo get_pretty_url($bo_table); ?>"><?php echo $bo_subject ?></a></h2>
    <ul>
    <?php for ($i=0; $i<$list_count; $i++) {  ?>
        <li class="basic_li">
            <?php
            if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";

            echo "<a href=\"".get_pretty_url($bo_table, $list[$i]['wr_id'])."\"> ";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];

            echo "</a>";

            if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i><span class=\"sound_only\">인기글</span></span>";
            if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            echo $list[$i]['icon_reply']." ";
            if (isset($list[$i]['icon_file']) && $list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
            if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;

            if ($list[$i]['comment_cnt'])  echo "
            <span class=\"lt_cmt\"><span class=\"sound_only\">댓글</span>".$list[$i]['comment_cnt']."</span>";

            ?>
            <div class="lt_info">
                <div class="member-dropdown"> <!-- glitter 🔽 -->
                    <span class="lt_name member" data-id="<?php echo $list[$i]['mb_id']; ?>" data-index="<?php echo $i; ?>">
                        <?php echo $list[$i]['name']; ?>
                    </span>
                    <div class="sv" id="member_menu_<?php echo $list[$i]['mb_id'] . '_' . $i; ?>">
                        <a href="//nickmenu.glitter.kr/bbs/memo_form.php?me_recv_mb_id=<?php echo $list[$i]['mb_id']; ?>"
                        onclick="win_memo(this.href); return false;">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; 쪽지 보내기
                        </a>
                        <a href="//nickmenu.glitter.kr/bbs/profile.php?mb_id=<?php echo $list[$i]['mb_id']; ?>"
                        onclick="win_profile(this.href); return false;">
                            <i class="fa fa-user" aria-hidden="true"></i>&nbsp; 회원 프로필
                        </a>
                        <a href="https://nickmenu.glitter.kr/bbs/search.php?srows=10&gr_id=&sfl=mb_id&stx=<?php echo $list[$i]['mb_id']; ?>&sop=and">
                            <i class="fa fa-search" aria-hidden="true"></i>&nbsp; 회원글 검색
                        </a>
                    </div>
                </div> <!-- glitter 🔼 -->
                <span class="lt_date"><?php echo $list[$i]['datetime2'] ?></span>
            </div>
        </li>
    <?php }  ?>
    <?php if ($list_count == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_more"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  <!-- glitter 🔽 Dropdown Menu -->
<script src="<?=$latest_skin_url?>/js/toggleMemberInfo.js"></script> <!-- glitter 🔼 Dropdown Menu -->
