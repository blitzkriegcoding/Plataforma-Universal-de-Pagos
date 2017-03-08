function getPaymentsExcel()
{
    
    $.ajax({
        type: "POST",
        url: "/admin/get_payments",
        data: {'dt_start': $('#date_start').val(), 'dt_end':$('#date_end').val() },
        beforeSend: function() 
            {
                $("#download_button").empty();
                $("#download_button").append("<div class='row'><span>Construyendo archivo...</span><img src='/images/squares.gif' class='img-responsive' alt='cargando...'></div>");              


            },
        statusCode: {
            422:function(data)
            {
                $.each(data.responseJSON, function(i,k){                                    
                    toastr.error(k);
                });                
            }
        },
        statusCode: {
            500: function(data)
            {
                toastr.error('Ha ocurrido un error interno en el servidor, favor contacte a su administrador');
            }
        }

    }).done(function(data){
        var path = JSON.parse(data);
        $("#download_button").empty();
        $("#download_button").append("<a href='"+path.final_path+"' class='btn btn-success' target='_self'> Descargar Pagos </a>");        
    });
}

