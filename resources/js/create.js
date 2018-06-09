$( function() {

    // Set focus at name field to start
    setTimeout( function()  {
        $( '#name').focus();
    }, 500 );

    // Submit the form
    $( '#form-event').submit( function( event) {

        event.preventDefault();

        // Clear all previous errors
        $( '.haserror').removeClass( 'haserror');
        
        // Get latitude anf longitude from map
        $( '#lat').val( map.getCenter().lat());
        $( '#lng').val( map.getCenter().lng());

        // Validations
        var hasErrors= false;

        if ( $( '#name').val() == '')  
            hasErrors= $( '#name');
        else if ( $( '#email').val() == '') 
            hasErrors= $( '#email');
        else if ( $( '#event').val() == '') 
            hasErrors= $( '#event');
        else if ( $( '#description').val() == '') 
            hasErrors= $( '#description');

        if ( hasErrors) {
            hasErrors.addClass( 'haserror').focus();
        } else {
            // Send event
            $.ajax( {
                url : 'create.php',
                data: $( this ).serialize(),
                type: 'post',
                success: function ( response) {
                    
                    // Hide the form and show the message
                    $( '#form-event').hide();
                    $( '#success-message').show();

                    $( 'html,body').animate( { 
                        scrollTop: 400}, 
                        'slow'
                    );

                    return false;

                },
                error: function( response) {

                }
            });

        }

        return false;

    });

    // Init google maps
    var map= new google.maps.Map( document.getElementById( 'map'), {
        center:new google.maps.LatLng( $( '#map').attr( 'data-start-lat'), $( '#map').attr( 'data-start-lng')),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.HYBRID
    });

    // Get current location
    navigator.geolocation.getCurrentPosition( 
        
        function ( position) {
            map.setCenter( {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            })
        },

        function ( error) {
            console.warn( 'ERROR(' + err.code + '): ' + err.message); 
        },

        {
            enableHighAccuracy: true,
            timeout: 2000,
            maximumAge: 0
        }
    );
    
});

// Enable submit button
function enableSubmit() {
    $( '.newsletter-btn').prop( 'disabled', false);
}