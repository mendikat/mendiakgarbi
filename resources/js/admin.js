$( function() {
    
    // Create the table
    $( '#table-events').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json',
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<span class="fa fa-table"></span> Excel'
            },
            {
                extend: 'pdfHtml5',
                text: '<span class="fa fa-file"></span> PDF',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }
        ],

    });

    // Show wvent in modal
    $( '.btn-show').click( function (event) {

        // Init HoldOn
        HoldOn.open({
            theme:   'sk-circle',
            message: $( '#form-event').attr( 'data-wait-message')
        });
    
        // Set focus
        setTimeout( function() { 
            $( '#name').focus().select();
        }, 500);

        // The event id
        var id= $( this).attr( 'data-id');

        // Fill the modal
        $( '#id').val( id);
     
        $( '#user').html( $( '#table-events tr[data-id="' + id + '"] td:eq(5)').html());
        $( '#date_c').text( $( '#table-events tr[data-id="' + id + '"] td:eq(1)').text());

        $( '#name').val( $( '#table-events tr[data-id="' + id + '"] td:eq(2)').text());
        $( '#type option[value="' +  $( '#table-events tr[data-id="' + id + '"] td:eq(4)').attr( 'data-id') +'"]').prop( 'selected', true);
        $( '#description').val( $( '#table-events tr[data-id="' + id + '"] td:eq(3)').text());

        var lat= $( '#table-events tr[data-id="' + id + '"]').attr( 'data-lat');
        var lng= $( '#table-events tr[data-id="' + id + '"]').attr( 'data-lng');

        $( '#map-link').attr( 'href', 'https://www.google.com/maps/?q=' +  lat + ',' + lng );

        $( '#thumbnails ul').html( ''); // Remove images

        // Get images
        $.ajax({
            url: 'admin.php?action=image',
            data: '&id=' + id,
            type: 'post',
            success: function ( response) {
                
                try {
                    var images= $.parseJSON( response);
                } catch( e) {
                    alert( e + '\n' + response);
                }

                if ( images.length == 0) {
                    return;
                }

                for (var i = 0; i < images.length; i++) 
                    $( '#thumbnails ul').append( '<li><a title="Ampliar" target="_blank" href="' + images[i].replace( '/thumbs', '')  + '"><img src="' + images[i] + '" alt="" /></a></li>'); 
                
            },
            error: function( error ) {

                HoldOn.close();
                alert( error);
            }

        });

        google.charts.load( 'current', { packages: ['corechart', 'bar']} );
        google.charts.setOnLoadCallback( function draw() {

            // Get the event history
            $.ajax({
                url: 'admin.php?action=hist',
                type: 'post',
                data: '&id=' + id,
                success: function( response) {

                    HoldOn.close();

                    try {
                        var history= $.parseJSON( response);
                    } catch( e) {
                        alert( e + '\n' + response);
                    }

                    if ( history.length == 0) {
                        $( '#chart').html( '');
                        return;
                    }
    
                    var values=[[ 'Fecha', 'Progreso', { role: 'style' }, { role: 'annotation' }, {role: 'tooltip'} ]];
    
                    for (var i = 0; i < history.length; i++) {      
                        var progress= parseInt(history[i].progress);
                        values.push( [history[i].date, progress, 'color: ' + ( progress < 30 ? '#ff5c33' : progress < 100 ? '#ffa366' : '#9fff80'), history[i].status, history[i].text ]);
                    }
                
                    var data = google.visualization.arrayToDataTable( values);
            
                    var options = {
                        title: '',
                        legend: {position: 'none'},
                        hAxis:  {title: '',  titleTextStyle: {color: '#333'}, direction:-1, slantedTextAngle: 45 },
                        vAxis:  {minValue: 0},
                        width: 600,
                        height: 300,
                        chartArea: { 'width': '100%', 'height': '50%'}
                    };

                    var chart = new google.visualization.ColumnChart( document.getElementById( 'chart'));
                    chart.draw(data, options);
                },
                error: function( error) {

                    HoldOn.close();
                    alert( error);

                }            
                
            });
            
        });

    });

    $( '#btn-event-accept').click( function( event) {

        // Init HoldOn
        HoldOn.open({
            theme:   'sk-circle',
            message: $( '#form-event').attr( 'data-wait-message')
        });

        $.ajax({
            url:  'admin.php?action=save',
            data: $( '#form-event').serialize(), 
            type: 'post',
            success: function( response) {

                HoldOn.close();
       
                if ( response == 'ok') {
                    
                    // Update table
                    var id= $( '#id').val();

                    $( '#table-events tr[data-id="' + id + '"] td:eq(2)').html( $( '#name').val());
                    $( '#table-events tr[data-id="' + id + '"] td:eq(3)').html( $( '#description').val());
                    $( '#table-events tr[data-id="' + id + '"] td:eq(4)').html( $( '#type  option:selected').text());
                    
                    $( '#modal-event').modal( 'toggle');

                } else {
                    alert( response);
                }
            },
            error: function ( error) {
                HoldOn.close();
                alert( error);
            }

        });

    });

    // Pass the event id to the modal
    $( '.btn-delete').click( function (event) {

        var id= $( this).attr( 'data-id');
        $( '#btn-delete-accept').attr( 'data-id', id);

    });

    // Delete the event
    $( '#btn-delete-accept').click( function( event) {

        $( '#modal-delete').modal( 'toggle');

        // Init HoldOn
        HoldOn.open({
            theme:   'sk-circle',
            message: $( '#form-event').attr( 'data-wait-message')
        });

        // Get the event id
        var id= $( this).attr( 'data-id');

        $.ajax({
                url:  'admin.php?action=delete',
                type: 'post',
                data: '&id=' + id,
                success: function( response) {

                    HoldOn.close();
       
                    if ( response == 'ok') {
                        // Hide the row
                        $( '#table-events tr[data-id="' + id + '"]').hide();
                    } else {
                        alert( response);
                    }

                },
                error: function( error) {
                    HoldOn.close();
                    alert( error);
                }

        });

    });

    // Change the event status
    $( '.select').change( function( event) {
        
        // Get the event id
        var id   = $( this).attr( 'data-id');
         
        var name     = $( this).find( 'option:selected').text();
        var progress = $( this).find( 'option:selected').attr( 'data-progress');


        // Get the new status
        var status= $( this).val();

        // Update the status
        $.ajax({
            url: 'admin.php?action=status',
            data: '&id=' + id + '&status=' + status,
            type: 'post',
            success: function( response) {

                if ( response == 'ok') {
                    
                    // Update the table
                    $( '#table-events tr[data-id="' + id + '"] td:eq(6)').html( '<span>' + name + '</span> <span>' + progress +'%</span>' +
                       '<div class="progress"><div class="progress-bar ' + ( progress < 30 ? 'bg-danger' : progress < 100 ? 'bg-warning' : 'bg-success') + ' progress-bar-striped active" style="width:' + progress +'%;"></div></div>');
                    var today = new Date(); 
                    $( '#table-events tr[data-id="' + id + '"] td:eq(7)').text( today.toLocaleString( 'es-ES').replace( /\//g, '-'));

                    // Show the modal
                    $( '#modal-status').modal();
                    setTimeout( function() { 
                        $( '#hist-text').focus().select();
                    }, 500);
  
                } else {

                    alert( response);

                }
            },
            error: function( error) {

                alert( error);

            }
        });

    });

    // Text to change status
    $( '#btn-status-accept').click( function( event) {
                        
        // Change the text
        $.ajax({
            url: 'admin.php?action=text',
            type: 'post',
            data: '&text=' +  $( '#hist-text').val(),
            success: function( response) {

                if ( response == 'ok')
                    $( '#modal-status').modal( 'toggle');
                else
                    alert( response);    

            },
            error: function( error) {
                alert( error);
                $( '#modal-status').modal( 'toggle');
            }
        });
        
    });
    
});

