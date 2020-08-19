
/** Scroll to top  **/
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("scroll-btn").style.display = "block";
  } else {
    document.getElementById("scroll-btn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  // document.body.scrollTop = 0; // For Safari
  // document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  $(window.opera ? 'html' : 'html, body').animate({
        scrollTop: 0
        }, 'slow');
}
/** Scroll to top  **/

// Toggle Sidebar On Mobile

$('.toggleNav').click(function() {
    $("#left-sidebar").toggleClass('toggle');
    $(".toggleNav").addClass('hidden');
    $(".toggleNav2").removeClass('hidden');
    $(".toggleNav2").addClass('inline-block');
  });

$('.toggleNav2').click(function() {
    $("#left-sidebar").toggleClass('toggle');
    $(".toggleNav2").addClass('hidden');
    $(".toggleNav").removeClass('hidden');
});