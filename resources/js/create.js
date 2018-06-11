$( function() {
    
    // Set focus at name field to start
    setTimeout( function()  {
        
        $( '#name').focus();

        $( 'html,body').animate( { 
            scrollTop: 400}, 
            'fast'
        );


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

            // Init HoldOn
            HoldOn.open({
                theme:   'sk-circle',
                message: $( '#form-event').attr( 'data-wait-message')
            });

            // Send event
            $.ajax( {
                url : 'create.php',
                data: new FormData( $( this)[0]),
                cache: false,
                contentType: false,
                processData: false,               
                type: 'post',
                success: function ( response) {
                    
                    HoldOn.close();
             
                    if ( response == 'ok') {

                        // Hide the form and show the message
                        $( '#form-event').hide();
                        $( '#success-message').show();

                        $( 'html,body').animate( { 
                            scrollTop: 400}, 
                            'slow'
                        );

                    } else {

                        console.warn( 'Error : ' + response);
                    }

                    return false;

                },
                error: function( response) {

                    HoldOn.close();
                    console.warn( 'Error : ' + response);

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

    // Add a file image to upload
    $( '#btn-attach-image').click( function( event) {
        
        event.preventDefault();
        $( '#file').trigger( 'click');

        return false;
    });

    // Generate the thumbnail
    $( '#file').change( function( event) {
        
        var file = event.target.files[0];

        file.ext= file.name.split( '.').pop().toLowerCase();

        // Validate the type and size fof the file
        if( ( file.ext != 'jpg' && file.ext != 'jpeg') || file.type != 'image/jpeg' ) {
            alert( $( this).attr( 'data-format-error'));
            return false;
        }

        if ( file.size > 10 * 1024 * 1024) {
            alert( $( this).attr( 'data-size-error'));
            return false;           
        }

        var reader  = new FileReader();
  
        reader.onloadend = function () {
          $( '#image').attr( 'src', reader.result).show();
        }
      
        reader.readAsDataURL( file);
         
    });    


    
});

// Enable submit button
function enableSubmit() {
    $( 'button.newsletter-btn').prop( 'disabled', false);
    $( 'button.newsletter-btn').removeAttr( 'title');
}