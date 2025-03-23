window.toggleMemberMenu = function(event, memberId) {
    event.stopPropagation();

    // 현재 클릭한 회원 메뉴를 제외한 모든 드롭다운 메뉴를 닫기
    document.querySelectorAll('.sv').forEach(function(menu) {
        if (menu.id !== 'member_menu_' + memberId) {
            menu.style.display = 'none';
        }
    });

    let menu = document.getElementById('member_menu_' + memberId);
    if (!menu) return;

    // 현재 display 상태를 계산된 스타일로 확인하여 토글
    let currentDisplay = window.getComputedStyle(menu).display;
    menu.style.display = currentDisplay === 'none' ? 'block' : 'none';
};

jQuery(document).on("click", ".member", function(event) {
    let memberId = $(this).data("id");
    toggleMemberMenu(event, memberId);
});

// 문서의 다른 영역 클릭 시 모든 드롭다운 메뉴 숨기기
document.addEventListener("click", function(event) {
    if (!event.target.closest(".sv") && !event.target.closest(".member")) {
        document.querySelectorAll('.sv').forEach(function(menu) {
            menu.style.display = 'none';
        });
    }
});
