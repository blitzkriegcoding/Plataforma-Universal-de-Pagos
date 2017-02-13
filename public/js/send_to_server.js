
function sendToServer() 
{
		var f = $(this);
		var checking_hash = null;

		var formData = new FormData($('#form_uploader')[0]);
		// $("#download_button").off("click");
		// formData.append("dato", "valor");
		//alert($('input[type=file]')[0].files[0]);

		formData.append('lote_credito', $('#lote_credito')[0].files[0]);
		formData.append("filetype", $('#tipo_archivo').val());
		$.ajax({
			url: '/admin/upload_credits',
			type: 'post',
			dataType: 'html',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			statusCode: {
				200: function(data)
				{
					
					// toastr.success('Archivo cargado con éxito');
					$("#spinner").hide("slow");
					$("#upload_controls").show("slow");
					var server_return = JSON.parse(data);
					if(server_return.success == true)
					{
						toastr.success(server_return.mensaje);
						$("#upload_button").remove();
						$("#actions").append("<a href='"+server_return.ruta_redireccion+"' class='btn btn-success'> Ver resultados! </a> ");
						console.log(JSON.parse(data));
						return;
					}
					else					
					{
						toastr.error(server_return.mensaje);
						$("#upload_button").prop('disabled', false);
						console.log(JSON.parse(data));
						return;						
					}

					
					
				},
				500: function(data)
				{
					toastr.error('Ha ocurrido un error al cargar el archivo');
					$("#upload_button").prop('disabled', false);
					$("#spinner").hide("slow");
					$("#upload_controls").show("slow");					
				},
				422: function(data)
				{
					$("#upload_button").prop('disabled', false);
                    $.each(JSON.parse(data.responseText), function(i,k){                                    
                        toastr.error(k);
                    });
					$("#spinner").hide("slow");
					$("#upload_controls").show("slow")                    
                    
				}

			},
			beforeSend: function() 
				{
					$("#spinner").show("slow");
					$("#upload_controls").hide("slow");
					$("#upload_button").prop('disabled', true);
					
				},
			// complete: function() 
			// 	{
			// 		// $("#loader").hide("slow");
			// 	},
			// success: function(data) 
			// 	{
			// 		// $("#loader").hide("slow");
			// 		// $("#form_container").show("slow");
			// 		// var data = JSON.parse(data);
			// 		// alert(data.message);

			// 		// if(data.success == true)
			// 		// 	{	
			// 		// 		checking_hash = data.checking_hash;
			// 		// 		$("#format_download").empty();
			// 		// 		$("#format_download").append($('<option>', {value: 'xlsx', text: 'Excel 2007 format (.xlsx)'}));
			// 		// 		$("#format_download").append($('<option>', {value: 'csv', text: 'CSV File (.csv)'}));
			// 		// 		$('#myWizard').wizard('selectedItem', {
			// 		// 			step: 3
			// 		// 		});
			// 		// 		// downloadFile(checking_hash);
			// 		// 		$("#download_button").on("click",{checking_hash: checking_hash}, downloadFile);
							

			// 		// 	}
			// 		// console.log(data.message);
			// 	},
			// error: function(data) 
			// 	{
			// 		// $("#loader").hide("slow");							
			// 		// alert(data);
			// 		// $("#form_container").show("slow");
			// 		//toastr.error('Ha ocurrido un error al cargar el archivo');
			// 	}

		});
};	



