$(function() {
    jsGrid.locale("es");
    $.ajax({
        type: "POST",
        url: "/admin/get_uploads_history"
    }).done(function(clients) {

        clients.unshift({ id_carga: "0", name: "" });
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "7000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }

        $("#jsGridUploadHistory").jsGrid({
            height: "400px",
            width: "100%",
            filtering: true,
            inserting: false,
            deleting: false,
            editing: false,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
            deleteConfirm: "Realmente desea eliminar este registro?",
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "POST",
                        url: "/admin/get_filtered_history",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    console.log(item);
                    return $.ajax({
                        type: "POST",
                        url: "/admin/create_client/",
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
                            },
                            200: function()
                            {
                                toastr.success('Cliente modificado con éxito');
                            },
                            500: function()
                            {
                                toastr.error('Ha ocurrido un error intentado actualizar el cliente');
                            }
                        }
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "#",
                        data: item
                    });
                }
            },
            fields: [
                { name: "fecha_hora_carga", title: "Fecha", type: "text", width: 85, align:"center" },
                { name: "nro_registros", title: "N° Registros", type: "text", width: 85, align:"center" },                
                { name: "nombre_empresa", title: "Nombre empresa", type: "text", width: 100, align:"center" },
                { name: "nombre_usuario", title: "Nombre usuario", type: "text", width: 100, align:"center" },
                { name: "cargado", title: "Lote Cargado", type: "text", width: 100, align:"center" },
                //{ name: "country_id", title: "Country", type: "select", width: 100, items: countries, valueField: "id", textField: "name" },
                //{ name: "married", type: "checkbox", title: "Is Married", sorting: false, filtering: false },
                { type: "control" }
            ]
        });
    });
});