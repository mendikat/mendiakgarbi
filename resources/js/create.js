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
        else if ( $( '#email').val() == '' || !is_email( $( '#email').val()) ) 
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
    if ( typeof( google) !== 'undefined' ) {

        var map= new google.maps.Map( document.getElementById( 'map'), {
            center:new google.maps.LatLng( $( '#map').attr( 'data-start-lat'), $( '#map').attr( 'data-start-lng')),
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.HYBRID
        });

        // Get current location
        navigator.geolocation.watchPosition( 
            
            function ( position) {
                console.info( 'Posición actual : (' + position.coords.latitude + ',' + position.coords.longitude + ')' )
                // Center the map in the current position
                map.setCenter( {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                })
            },

            function ( error) {
                console.warn( 'No se ha obtenido una posición valida. Error ' + error.code + ': ' + error.message); 
            },

            {
                enableHighAccuracy: true,
                timeout: 2000,
                maximumAge: 0
            }
        );

    } else  {

        $( '#map').hide();
        console.error( 'MENDIAKGARBI: No se ha cargado GoogleMaps. El mapa no se mostrará.');
    }

    // Add a file image to upload
    $( '#btn-attach-image').click( function( event) {
        
        event.preventDefault();
        $( '#file').trigger( 'click');

        return false;
    });

    // Generate the thumbnails
    $( '#file').change( function( event) {
        
        var files = event.target.files;

        $( '#images').html( ''); // Clear previous images
    
        for( var i=0; i< files.length; i++) {

            var file= files[i];

            file.ext= file.name.split( '.').pop().toLowerCase();

            // Validate the type and size for the file
            if( ( file.ext != 'jpg' && file.ext != 'jpeg') || file.type != 'image/jpeg' ) {
                alert( $( this).attr( 'data-format-error'));
                return false;
            }

            if ( file.size > 10 * 1024 * 1024) {
                alert( $( this).attr( 'data-size-error'));
                return false;           
            }

            var img= $( '<img class="image" alt="" />');

            var reader  = new FileReader();
    
          


            reader.onloadend = function( event) { 
                
                $( $.parseHTML( '<img>')).attr( 'src', event.target.result).addClass( 'image').appendTo( '#images');
    
            };           
        
                
            reader.readAsDataURL( file);

           
        }
         
    });    


    
});

// Enable submit button
function enableSubmit() {
    $( 'button.newsletter-btn').prop( 'disabled', false);
    $( 'button.newsletter-btn').removeAttr( 'title');
}

// Validate Email Address
function is_email( email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}