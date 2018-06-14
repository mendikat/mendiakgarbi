$( function() {

	angleCalc();

	$( '.btn-lang').click( function( event) {

		event.preventDefault();

		var lang= $( this).attr( 'data-lang');

		$.cookie( 'lang', lang, { expires : 1 });

		location.reload();

		return false;

	});

	$( window).scroll( function(){
		
		var wScroll = $( this).scrollTop();
		
		if (wScroll > ($( this).height() / 3)) {
		
			$( '.fixed-navbar, .navbar-lockup').addClass( 'nav-fix');

		} else {
			
			$( '.fixed-navbar, .navbar-lockup').removeClass( 'nav-fix');
			
		}

	});

	$( '.mobile-nav-toggle').click(function(){
		
		if (!( $( this).hasClass('nav-open'))) {
		
			$( this).addClass('nav-open');
		
			$( '.slide-out-nav, .fixed-navbar, .mobile-shift').addClass( 'nav-open');
		
		}
		
		else {
			
			$( this).removeClass('nav-open');
			
			$( '.slide-out-nav, .fixed-navbar, .mobile-shift').removeClass( 'nav-open');
			
		}

	});

	$( '.claim').click( function( event) {
		location = 'create.php';
	});

});

function angleCalc() {

	var opposite = $( '.slide-out-nav').height(),
		adjacent = $( '.slide-out-nav').width(),
		radian = Math.atan( opposite / adjacent),
		angle = (90 - radian * ( 180 / Math.PI)) * -1;
	
	$( '.mobile-nav-slice').css({
		
		'transform' : 'rotate( '+ angle +'deg)'
	
	});
	
}

