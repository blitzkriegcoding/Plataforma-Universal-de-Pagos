function getQuotes()
{
    jsGrid.locale("es");
    $.ajax({
        type: "POST",
        url: "/admin/get_client_quotes",
        data: {'rut_cliente': $('#rut_cliente').val()}
    }).done(function(quotes) {
        quotes.unshift({ id_cuota: "0", name: "" });

        $("#jsGridEditLote").jsGrid({
            height: "450px",
            width: "100%",
            filtering: true,
            inserting: true,
            deleting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 48,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete client?",
            controller: {
                loadData: function(filter) {
                    console.log(filter);
                    return $.ajax({
                        type: "POST",
                        url: "/admin/get_filtered_quotes",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    console.log(item);
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
                                //alert("Hola");
                                //console.log(data.responseJSON);
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
                { name: "fecha_vencimiento", title: "Vencimiento", type: "text", width: 100 },                
                { name: "interes", title: "Monto interés", type: "text", width: 100 },
                { name: "amortizacion", title: "Amotización", type: "text", width: 100 },
                { name: "valor_cuota", title: "Monto cuota", type: "text", width: 75 },
                { name: "saldo_insoluto", title: "Saldo insoluto", type: "text", width: 100 },
                { name: "estado_cuota", title: "Estado de cuota", type: "text", width: 100 },
                { name: "tipo_cuota", title: "Tipo de Cuota", type: "text", width: 100 },
                /*{ name: "fecha_pago", title: "Fecha pago efectivo", type: "text", width: 150 },*/
                { name: "rut_cliente", title: "RUT del Cliente", type: "text", width: 100 },
                { name: "nro_credito", title: "N° Crédito", type: "text", width: 80 },
                { name: "nombres_cliente", title: "Nombres", type: "text", width: 100 },
                { name: "apellidos_cliente", title: "Apellidos", type: "text", width: 100 },
                //{ name: "country_id", title: "Country", type: "select", width: 100, items: countries, valueField: "id", textField: "name" },
                //{ name: "married", type: "checkbox", title: "Is Married", sorting: false, filtering: false },
                { type: "control" }
            ]
        });
    });
}