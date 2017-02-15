$(function() {
    jsGrid.locale("es");
    $.ajax({
        type: "POST",
        url: "/admin/get_all_clients"
    }).done(function(clients) {

        clients.unshift({ old_rut: "0", name: "" });
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

        $("#jsGrid").jsGrid({
            height: "400px",
            width: "100%",
            filtering: true,
            inserting: false,
            deleting: false,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete client?",
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "POST",
                        url: "/admin/get_filtered_clients",
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
                            }
                        }
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/clients/",
                        data: item
                    });
                }
            },
            fields: [
                { name: "rut_cliente", title: "RUT", type: "text", width: 85, align:"center" },
                { name: "nombre_cliente", title: "Nombres", type: "text", width: 150, align:"center" },                
                { name: "apellido_cliente", title: "Apellidos", type: "text", width: 150, align:"center" },
                { name: "email_cliente", title: "Email", type: "text", width: 150, align:"center" },
                { name: "telefono_cliente", title: "Teléfono", type: "text", width: 100, align:"center" },
                { name: "direccion_cliente", title: "Dirección", type: "text", width: 150, align:"center" },
                //{ name: "country_id", title: "Country", type: "select", width: 100, items: countries, valueField: "id", textField: "name" },
                //{ name: "married", type: "checkbox", title: "Is Married", sorting: false, filtering: false },
                { type: "control" }
            ]
        });
    });
});