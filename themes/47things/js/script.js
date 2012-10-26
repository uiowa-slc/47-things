/* Author:

*/

function showHide(shID) {
	if (document.getElementById(shID)) {
			$('.showLink').removeClass("selectedDiv");
			$('.more').slideUp(250);
			$('#' + shID+'-show').addClass("selectedDiv");
			$('#' + shID).delay(300).slideDown(800);
	}
}



