jQuery(function($){
    $(document).ready(function(){
        $(".owl-carousel-wrap .sv_member").off('click').off('focusin');

        $(".owl-carousel-wrap").on("click", ".sv_member", function(e) {
            e.stopPropagation(); // 클릭 이벤트 전파 방지

            var $sv = $(this).closest('.sv_member-dropdown').find('.sv'); // 현재 클릭한 .sv 찾기
            $(".sv").not($sv).slideUp(); // 다른 열린 .sv 닫기

            if ($sv.is(":visible")) {
                $sv.slideUp();
            } else {
                var winWidth = $(window).width();
                var winHeight = $(window).height();

                // 일단 화면 중앙에 표시 후 크기 계산
                $sv.appendTo("body").css({
                    "position": "fixed",
                    "top": "50%",
                    "left": "50%",
                    "transform": "translate(-50%, -50%)",
                    "z-index": 99999,
                    "display": "block",
                    "visibility": "visible",
                    "max-width": "90%",
                    "max-height": "90%",
                    "overflow": "auto"
                }).stop(true, true).slideDown();

                // 내용 크기에 따라 자동 너비 조정
                setTimeout(function() {
                    var contentWidth = $sv.prop("scrollWidth"); // 실제 컨텐츠 너비
                    var maxAllowedWidth = winWidth * 0.9; // 최대 허용 너비 (90% 기준)
                    var finalWidth = Math.min(contentWidth, maxAllowedWidth); // 최종 너비 결정

                    $sv.css("width", finalWidth + "px");
                }, 10); // DOM이 업데이트될 시간을 기다린 후 실행
            }
        });

        // 문서의 다른 곳을 클릭하거나 터치하면 .sv 닫기
        $(document).on("click touchstart", function(e) {
            if (!$(e.target).closest('.sv, .sv_member').length) {
                $(".sv").slideUp();
            }
        });

        // 스크롤 시 드롭다운 닫기
        $(window).on("scroll", function() {
            $(".sv").slideUp();
        });

        var carousels = [],
            is_loop = true;

        function owl_show_page(event){
            if (event.item) {
                var count = event.item.count,
                    item_index = event.item.index,
                    index = 1;

                if( is_loop ){
                    index = ( 1 + ( event.property.value - Math.ceil( event.item.count / 2 ) ) % event.item.count || 0 ) || 1;
                } else {
                    index = event.item.index ? event.item.index + 1 : 1;
                }

                var str = "<b>"+index+"</b>/"+count;
                $(event.target).next(".lt_page").find(".page_print").html(str);
            }
        }

        $(".lt.owl-carousel-wrap").each(function(index, value) {
            var $this = $(this),
                item_loop_c = ($this.children('.latest-sel').find(".item").length > 1) ? 1 : 0 ;

            carousels['sel' + index] = $this.children('.latest-sel').addClass("owl-carousel").owlCarousel({
                items:1,
                loop: is_loop && item_loop_c,
                center:true,
                autoHeight:true,
                dots:false,
                onChanged:function(event){
                    owl_show_page(event);
                },
            });

            carousels['sel' + index].on('changed.owl.carousel', function(event) {
                if ($.fn.tooltipster) {
                    var instances = $.tooltipster.instances();
                    $.each(instances, function(i, instance){
                        instance.close();
                    });
                }
            });

            $this.on("click", ".lt_page_next", function(e) {
                e.preventDefault();
                carousels['sel' + index].trigger('next.owl.carousel');
            });

            $this.on("click", ".lt_page_prev", function(e) {
                e.preventDefault();
                carousels['sel' + index].trigger('prev.owl.carousel');
            });

        }); // each
    });
});
