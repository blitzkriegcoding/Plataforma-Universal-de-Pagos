$(document).ready(function(){		
		$("#id_empresa").select2({
		language: "es",
		  ajax: {
		    url: "get_enterprise_by_name",
		    dataType: 'json',
		    method: 'post',
		    delay: 250,
		    data: function (params) {
		      return {
		        name: params.term, // search term
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
		      		'id': item.id_empresa,
		      		'text': item.nombre_empresa
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

		$("#id_canal").select2({
		language: "es",
		  ajax: {
		    url: "get_channel_by_number",
		    dataType: 'json',
		    method: 'post',
		    delay: 250,
		    data: function (params) {
		      return {
		        channel: params.term, // search term
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
		      		'id': item.id_canal,
		      		'text': item.canal
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

   });