$(document).ready(function() {
	//POPUP
	var popup_slider;
	
	(function($) {
    $.fn.extend({
        leanModal: function(options) {
            var defaults = {
                top: 100,
                overlay: 1,
                closeButton: null
            };
            var overlay = $("<div id='lean_overlay'></div>");
            $("body").append(overlay);
            options = $.extend(defaults, options);
            return this.each(function() {
                var o = options;
                $(this).click(function(e) {
                    var modal_id = $(this).attr("href");
                    $("#lean_overlay").click(function() {
                        close_modal(modal_id)
                    });
                    $(o.closeButton).click(function() {
                        close_modal(modal_id)
                    });
                    var modal_height = $(modal_id).outerHeight();
                    var modal_width = $(modal_id).outerWidth();
                    $("#lean_overlay").css({
                        "display": "block",
                        opacity: 0
                    });
                    $("#lean_overlay").fadeTo(300, o.overlay);
                    $('.modal').fadeOut(0);
                    $(modal_id).css({
                        "display": "block",
                        "position": "fixed",
                        "opacity": 0,
                        "z-index": 11000,
                        "top": "50%",
                        "left": "50%",
                        "transform": " translate(-50%, -50%)"
                    });
                    $(modal_id).fadeTo(300, 1);
					
					popup_slider = $(modal_id).find('.popup_slider .slider').bxSlider({
						pager:false
					});
					popup_slider.reloadSlider();
					
					
					
                    e.preventDefault();
							
                })
            });

            function close_modal(modal_id) {
                $("#lean_overlay").fadeOut(300);
                $(modal_id).css({
                    "display": "none"
                });
				//popup_slider.destroySlider();
            }	
        }
    })
	})(jQuery);
	
	$("[data-rel=leanModal]").leanModal({  closeButton: ".modal_close, .btncancel" });

	
	//top slider
	$('.top_slider').bxSlider({
		 pager:false,
		 auto:true
	 });
	 
	//single slider
	$(".wrap_slider .slider").bxSlider({
		pager: false
	});
	
	
	//SHOW HIDE SIDEBAR
	$(".show_sidebar").click(function(){
		$(".sidebar").addClass("showing");
	});
	$(".sidebar .close").click(function(){
		$(this).parent().removeClass("showing");
	});
	
	//SHOW HIDE MENU
	$(".mmenu").click(function(){
		$("nav").fadeToggle();
		$(this).toggleClass('change');
	});
	
	var headerHeight = $("header").height();
	$("#container").css("padding-top", container + "px");
	
	
});