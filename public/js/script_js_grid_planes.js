function getPlan()
{
    if(!$('#rut_cliente').val())
        return false;
    jsGrid.locale("es");
    $.ajax({
        type: "POST",
        url: "../admin/get_plan",
        data: {'id_plan_cuota': $('#rut_cliente').val() },
        beforeSend: function() 
            {
                $("#download_button").empty();
            },                         
        statusCode: {
            200: function()
            {
                /* $("#download_button").append("<input type='button' class='btn btn-success' value='Descargar Excel'onclick='javascript:void(0)'>"); */
            }
        }        
    }).done(function(quotes) {
        quotes.unshift({ id_plan_cuota: "0", name: "id_plan_cuota" });

        $("#jsGridQuotes").jsGrid({
            height: "450px",
            width: "100%",
            filtering: true,
            inserting: false,
            deleting: false,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 48,
            pageButtonCount: 5,

            deleteConfirm: "¿Realmente quiere borrar este plan de crédito?",
            controller: {
                loadData: function(filter) {
                    filter['id_plan_cuota'] =  $('#rut_cliente').val();
                    console.log(filter);
                    return $.ajax({
                        type: "POST",
                        url: "../admin/get_filtered_plan",
                        data: filter,
                    });
                },
                // insertItem: function(item) {
                //     item['id_plan_cuota'] =  $('#rut_cliente').val()
                //     //console.log(item);                    
                //     return $.ajax({
                //         type: "POST",
                //         url: "../admin/create_quote",
                //         data: item,
                //         beforeSend: function() 
                //             {
                //                 $("#download_button").empty();
                //             },                        
                //         statusCode: {
                //             422: function(data)
                //             {
                //                 $.each(data.responseJSON, function(i,k){                                    
                //                     toastr.error(k);
                //                 });
                //             },
                //             200: function(data)
                //             {
                //                 //return false;
                //                 toastr.success('Cuota incluida con éxito');
                //                 return;
                //             },
                //             500: function(data)
                //             {
                //                 toastr.error('Ha ocurrido un error al tratar de actualizar');
                //                 return;
                //             }
                //         }                        
                //     });
                // },
                updateItem: function(item) {
                    //console.log(item);
                    return $.ajax({
                        type: "POST",
                        url: "../admin/update_plan",
                        data: item,
                        statusCode: {
                            422: function(data){

                                $.each(data.responseJSON, function(i,k){                                    
                                    toastr.error(k);
                                });
                            },
                            200: function(data){
                                //return false;
                                toastr.success('Plan de cuotas actualizado con éxito');
                                getPlan();
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
                    console.log(item);
                    return $.ajax({
                        type: "POST",
                        url: "../admin/delete_plan",
                        data: item,
                        statusCode: {
                            422: function(data){
                                $.each(data.responseJSON, function(i,k){                                    
                                    toastr.error(k);
                                });
                            },
                            200: function(data){
                                $.each(data.responseJSON, function(i,k){                                    
                                    toastr.success(k);
                                });
                                getPlan();
                                return false;
                            },
                            500: function(data)
                            {
                                toastr.error('Ha ocurrido un error al tratar de borrar');
                                return;
                            }
                        }                        
                    });
                }
            },
            fields: [
                { name: "credito", title: "N° Crédito", type: "text", width: 20, align: "center" },                
                { name: "cuotas", title: "N° Cuotas", type: "text", width: 35, align: "center",readOnly: true },                                
                { name: "vencimiento", title: "Vencimiento crédito", type: "text", width: 30,readOnly: true, align: "center" },
                { name: "paquete", title: "Nombre Paquete", type: "text", width: 30, readOnly: false, align: "center" },                
                { type: "control", width: 20 }
            ]
        });
    });
}

function downloadFile()
{

}