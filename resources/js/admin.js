$( function() {
    
    // Create the table
    $( '#table-events').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json',
        },
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {
                extend: 'pdfHtml5',
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

    // Delete teh event
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

    // Changethe  event status
    $( '.select').change( function( event) {
        
        // Get the event id
        var id= $( this).attr( 'data-id');

        // Get the new status
        var status= $( this).val();

        // Update teh status
        $.ajax({
            url: 'admin.php?action=status',
            data: '&id=' + id + '&status=' + status,
            type: 'post',
            success: function( response) {

                if ( response == 'ok') {
                    
                    // 
                }

            },
            error: function( error) {


            }
        });

    });
    
});

