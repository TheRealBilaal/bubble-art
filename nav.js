$(".menu-button-show").click(function() {
	$("nav").css("right", "-300px");
	$("nav").animate({right: 0}, 500);
	$(".menu-button-hide").css("right", "-300px");
	$(".menu-button-hide").animate({right: 0}, 500);
});
$(".menu-button-hide").click(function() {
	$("nav").css("right", "-0px");
	$("nav").animate({right: -300}, 500);
	$(".menu-button-hide").css("right", "-0px");
	$(".menu-button-hide").animate({right: -300}, 500);
});