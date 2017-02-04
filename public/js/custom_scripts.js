   $(document).ready(function(){
	    $('#fecha_vencimiento').datepicker({
	        language: "es",
	        todayBtn: true,
	        clearBtn: true,
	        autoclose: true
	    });  
	    template = function(data, container) {

	    }
		$("#rut_cliente").select2({
		language: "es",
		  ajax: {
		    url: "get_client_by_rut",
		    dataType: 'json',
		    method: 'post',
		    delay: 250,
		    data: function (params) {
		      return {
		        rut_cliente: params.term, // search term
		        page: params.page
		      };
		    },
		    processResults: function (data, params) {
		      // parse the results into the format expected by Select2
		      // since we are using custom formatting functions we do not need to
		      // alter the remote JSON data, except to indicate that infinite
		      // scrolling can be used
		      params.page = params.page || 1;
		      var resultados = [];
		      $.each(data, function(index, item){
		      	resultados.push({
		      		'id': item.id_cliente_cuota,
		      		'text': item.datos_cliente
		      	});
		      	console.log(item);
		      });

		      return {
		        results: resultados,
		      };
		    },
		    cache: false
		  },
		  //escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		  minimumInputLength: 1,
		  // templateResult: formatRepo, // omitted for brevity, see the source of this page
		  templateSelection: function(data, container){
		  	return data.text;
		  }  // omitted for brevity, see the source of this page
		});
		$('#total_credito').inputmask("numeric", {
		    radixPoint: ",",
		    groupSeparator: ".",
		    digits: 2,
		    autoGroup: true,
		    prefix: '$ ', //Space after $, this will not truncate the first character.
		    rightAlign: false,
		    oncleared: function () { self.Value(''); }
		});

   });
