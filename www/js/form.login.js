
var loginForm;

$( document ).ready(function() {
	
	// Init Form
	loginForm = new $.Form();

	$('div#ticketBox form input[name="TB_submit"]').on('click',function(){
		loginForm.ResetError();
		var formData = $('div#ticketBox form').serializeArray();
		var errors = [];
		//checks
		if(formData[0]['value'].length == 0){errors.push( {field: formData[0]['name'], err:0 } ); }
		if(formData[1]['value'].length == 0){errors.push( {field: formData[1]['name'], err:0 } ); }
		if(formData[2]['value'].length == 0){errors.push( {field: formData[2]['name'], err:0 } ); }
		if(formData[3]['value'].length == 0){errors.push( {field: formData[3]['name'], err:0 } ); }

		if(formData[0]['value'].length != 4){errors.push( {field: formData[0]['name'], err:1 } ); }
		if(formData[1]['value'].length != 4){errors.push( {field: formData[1]['name'], err:1 } ); }
		if(formData[2]['value'].length != 4){errors.push( {field: formData[2]['name'], err:1 } ); }
		if(formData[3]['value'].length != 2){errors.push( {field: formData[3]['name'], err:1 } ); }

		if(errors.length>0){
			loginForm.ConnectError(errors);
			return false;
		}

		// HIDE LOGIN PANEL
		$('div#loadingPanel').addClass('hide_A');
		$('div#loadingPanel').animate({
			left: 0,
		},200,function(){
			$('div#loadingPanel').addClass('hide_B');
			$('div#loadingPanel').animate({
				left: 0,
			},1000,function(){
				$('div#loadingPanel').remove();
				$('html').addClass('canOverflow');
			});
		});

	});

});