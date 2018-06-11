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

    // Pass the event id to the modal
    $( '.btn-delete').click( function (event) {

        var id= $( this).attr( 'data-id');
        $( '#btn-delete-accept').attr( 'data-id', id);

    });

    // Delete the event
    $( '#btn-delete-accept').click( function( event) {

        $( '#modal-delete').modal( 'toggle');

        // Get the event id
        var id= $( this).attr( 'data-id');

        $.ajax({
                url:  'admin.php?action=delete',
                type: 'post',
                data: '&id=' + id,
                success: function( response) {

                    if ( response == 'ok') {
                        // Hide the row
                        $( '#table-events tr[data-id="' + id + '"]').hide();
                    } else {
                        alert( response);
                    }

                },
                error: function( error) {

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

        // Update teh status
        $.ajax({
            url: 'admin.php?action=status',
            data: '&id=' + id + '&status=' + status,
            type: 'post',
            success: function( response) {

                if ( response == 'ok') {
                    $( '#table-events tr[data-id="' + id + '"] td:eq(6)').html( '<span>' + name + '</span> <span>' + progress +'%</span>' +
                       '<div class="progress"><div class="progress-bar ' + ( progress < 30 ? 'bg-danger' : progress < 100 ? 'bg-warning' : 'bg-success') + ' progress-bar-striped active" style="width:' + progress +'%;"></div></div>');
                    var today = new Date(); 
                    $( '#table-events tr[data-id="' + id + '"] td:eq(7)').text( today.toLocaleString( 'es-ES').replace( /\//g, '-'));
                }
            },
            error: function( error) {


            }
        });

    });
    
});

