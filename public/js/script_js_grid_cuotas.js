function getQuotes()
{
    jsGrid.locale("es");
    $.ajax({
        type: "POST",
        url: "/admin/get_client_quotes",
        data: {'id_plan_cuota': $('#rut_cliente').val() },
        beforeSend: function() 
            {
                $("#download_button").empty();
            },                         
        statusCode: {
            200: function()
            {
                $("#download_button").append("<input type='button' class='btn btn-success' value='Descargar Excel'onclick='javascript:void(0)'>");
            }
        }        
    }).done(function(quotes) {
        quotes.unshift({ id_cuota: "0", id_plan_cuota: "1", name: "Data" });

        $("#jsGridQuotes").jsGrid({
            height: "450px",
            width: "100%",
            filtering: true,
            inserting: true,
            deleting: false,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 48,
            pageButtonCount: 5,

            deleteConfirm: "¿Realmente quiere borrar los datos de este cliente?",
            controller: {
                loadData: function(filter) {
                    filter['id_plan_cuota'] =  $('#rut_cliente').val()
                    console.log(filter);
                    return $.ajax({
                        type: "POST",
                        url: "/admin/get_filtered_quotes/",
                        data: filter,

                    });
                },
                insertItem: function(item) {
                    item['id_plan_cuota'] =  $('#rut_cliente').val()
                    //console.log(item);                    
                    return $.ajax({
                        type: "POST",
                        url: "/admin/create_quote/",
                        data: item,
                        beforeSend: function() 
                            {
                                $("#download_button").empty();
                            },                        
                        statusCode: {
                            422: function(data)
                            {
                                $.each(data.responseJSON, function(i,k){                                    
                                    toastr.error(k);
                                });
                            },
                            200: function(data)
                            {
                                //return false;
                                toastr.success('Cuota incluida con éxito');
                                return;
                            },
                            500: function(data)
                            {
                                toastr.error('Ha ocurrido un error al tratar de actualizar');
                                return;
                            }
                        }                        
                    });
                },
                updateItem: function(item) {
                    //console.log(item);
                    return $.ajax({
                        type: "POST",
                        url: "/admin/update_quote/",
                        data: item,
                        statusCode: {
                            422: function(data){

                                $.each(data.responseJSON, function(i,k){                                    
                                    toastr.error(k);
                                });
                            },
                            200: function(data){
                                //return false;
                                toastr.success('Cuota actualizada con éxito');
                                return;
                            },
                            500: function(data)
                            {
                                toastr.error('Ha ocurrido un error al tratar de actualizar');
                                return;
                            }
                        }
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/admin/delete_quote/",
                        data: item,
                        statusCode: {
                            422: function(data){
                                $.each(data.responseJSON, function(i,k){                                    
                                    toastr.error(k);
                                });
                            },
                            200: function(data){
                                //return false;
                                toastr.success('Cuota borrada con éxito');
                                return;
                            },
                            500: function(data)
                            {
                                toastr.error('Ha ocurrido un error al tratar de actualizar');
                                return;
                            }
                        }                        
                    });
                }
            },
            fields: [
                { name: "nro_cuota", title: "N° Cuota", type: "text", width: 20, align: "center" },                
                { name: "valor_cuota", title: "Valor Cuota", type: "text", width: 50, align: "center", },                                
                { name: "activa", title: "Activa", type: "select", width: 20, items: [{ value:"", activa: '' }, { value:"NO", activa: 'F' }, { value:"SI", activa: 'V' }], valueField: "activa", textField: "value" },
                { name: "status_cuota", title: "Estado cuota", type: "text", width: 30,align: "center", },
                { name: "fecha_vencimiento", title: "Fecha vencimiento", type: "text", width: 30, align: "center" },
                { name: "fecha_pago_efectivo", title: "Fecha pago efectivo", type: "text", width: 30, readOnly: true, align: "center" },
                { type: "control", width: 20 }
            ]
        });
    });
}

function downloadFile()
{

}