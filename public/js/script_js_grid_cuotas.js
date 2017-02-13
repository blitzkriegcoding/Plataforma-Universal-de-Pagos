function getQuotes()
{
    jsGrid.locale("es");
    $.ajax({
        type: "POST",
        url: "/admin/get_client_quotes",
        data: {'id_cliente_cuota': $('#rut_cliente').val() }
    }).done(function(quotes) {
        quotes.unshift({ id_cuota: "0", name: "" });

        $("#jsGridQuotes").jsGrid({
            height: "450px",
            width: "100%",
            filtering: true,
            inserting: false,
            deleting: false,
            editing: false,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 48,
            pageButtonCount: 5,
            deleteConfirm: "¿Realmente quiere borrar los datos de este cliente?",
            controller: {
                loadData: function(filter) {
                    filter['id_cliente_cuota'] =  $('#rut_cliente').val()
                    console.log(filter);
                    return $.ajax({
                        type: "POST",
                        url: "/admin/get_filtered_quotes",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    //console.log(item);
                    return $.ajax({
                        type: "POST",
                        url: "/clients/",
                        data: item
                    });
                },
                updateItem: function(item) {
                    //console.log(item);
                    return $.ajax({
                        type: "POST",
                        url: "/admin/update_client/",
                        data: item,
                        statusCode: {
                            422: function(data){

                                $.each(data.responseJSON, function(i,k){                                    
                                    toastr.error(k);
                                });
                            }
                        }
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/admin/delete_item_loaded_lote/",
                        data: item
                    });
                }
            },
            fields: [
                { name: "nro_cuota", title: "N° Cuota", type: "text", width: 60 },                
                { name: "valor_cuota", title: "Valor Cuota", type: "text", width: 100 },                                
                { name: "activa", title: "Activa", type: "select", width: 100, items: [{ value:"", activa: '' }, { value:"NO", activa: 'F' }, { value:"SI", activa: 'V' }], valueField: "activa", textField: "value" },
                { name: "status_cuota", title: "Estado cuota", type: "text", width: 100 },
                { name: "fecha_vencimiento", title: "Fecha vencimiento", type: "text", width: 75 },
                { name: "fecha_pago_efectivo", title: "Fecha pago efectivo", type: "text", width: 100 },
                { type: "control" }
            ]
        });
    });
}