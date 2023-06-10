(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$(".toggle-password").click(function() {

	  $(this).toggleClass("fa-eye fa-eye-slash");
	  var input = $($(this).attr("toggle"));
	  if (input.attr("type") == "password") {
	    input.attr("type", "text");
	  } else {
	    input.attr("type", "password");
	  }
	});

})(jQuery);

// Full Height Function
function setFullHeight() {
	const section = document.querySelector('.h-custom');
	const windowHeight = window.innerHeight;
	section.style.height = `${windowHeight}px`;
  }
  
  // Password Toggling Function
  function togglePassword() {
	const passwordInput = document.getElementById('form3Example1w');
	const passwordToggle = document.querySelector('.password-toggle');
	const passwordIcon = passwordToggle.querySelector('i');
  
	if (passwordInput.type === 'password') {
	  passwordInput.type = 'text';
	  passwordIcon.classList.remove('bi-eye');
	  passwordIcon.classList.add('bi-eye-slash');
	} else {
	  passwordInput.type = 'password';
	  passwordIcon.classList.remove('bi-eye-slash');
	  passwordIcon.classList.add('bi-eye');
	}
  }
  
  // Set full height on page load and window resize
  window.addEventListener('DOMContentLoaded', setFullHeight);
  window.addEventListener('resize', setFullHeight);
