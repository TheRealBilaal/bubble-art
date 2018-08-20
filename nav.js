var isMenuHidden = true;
$(".menu-button").click(function() {
	$("nav").fadeToggle();
	if (isMenuHidden) {
		isMenuHidden = false;
		$(".menu-button").addClass("blue");
	} else {
		isMenuHidden = true;
		$(".menu-button").removeClass("blue");
	}
});