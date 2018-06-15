$( function() {

    // Init google maps
    var map= new google.maps.Map( document.getElementById( 'map'), {
        center:new google.maps.LatLng( $( '#map').attr( 'data-start-lat'), $( '#map').attr( 'data-start-lng')),
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    $.getJSON( 'service/get-markers.php', function( events) {

        var icons= [
                '', 
                'resources/img/icons/food-icon.png',
                'resources/img/icons/car-icon.png',
                'resources/img/icons/closed-road-icon.png',
                'resources/img/icons/hiking-icon.png',
                'resources/img/icons/fox-icon.png',
                'resources/img/icons/turtle-icon.png',
                'resources/img/icons/caution-icon.png'
        ];

        $.each( events, function ( key, event) {

            var marker = new google.maps.Marker({
                position:  new google.maps.LatLng( event.lat, event.lng),
                map: map,
                title: event.name,
                icon: {
                    url: event.type in icons ? icons[ event.type] : icons[ 7],
                    scaledSize: new google.maps.Size(42, 48)
                }
            });

            marker.addListener( 'click', function() {

                var color = ( event.progress < 30 ? 'red' : event.progress < 100 ? 'orange' : 'green'  );

                var infoWindow = new google.maps.InfoWindow({
                    content:  '<div style="color: blue;">' + event.description + '</div>' +
                              '<div style="color: ' + color + ';"><progress value="' + event.progress + '" max="100"></progress> ' + event.progress    + '%</div>'
                });

                infoWindow.open( map, marker);

            });

        });

    });

});