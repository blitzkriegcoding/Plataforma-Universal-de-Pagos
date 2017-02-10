   $(document).ready(function(){		
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