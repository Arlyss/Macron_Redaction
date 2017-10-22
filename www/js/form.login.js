
var F;

function displayAuthorMode(){
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
}

$( document ).ready(function() {
	
	// Init Form
	F = new $.Form();

	$('div#ticketBox form input[name="TB_mail"]').focus();

	$("div#ticketBox form input[name^='TB_ticket']").on('input propertychange', function(ev){
		$(ev.target).val( $(ev.target).val().toUpperCase() );
		var n = $(ev.target).attr('name').replace('TB_ticket_','');
		if((n!='D' && $(ev.target).val().length==4) || (n=='D' && $(ev.target).val().length==2)){
			switch(n){
				case'A': $('div#ticketBox form input[name="TB_ticket_B"]').focus();	break;
				case'B': $('div#ticketBox form input[name="TB_ticket_C"]').focus();	break;
				case'C': $('div#ticketBox form input[name="TB_ticket_D"]').focus();	break;
				case'D': $('div#ticketBox form input[name="TB_mail"]').focus();		break;
			}
		}
	});

	$('div#ticketBox form input[name="TB_submit"]').on('click',function(){
		F.ResetError();
		var formData = $('div#ticketBox form').serializeArray();
		var errors = [];
		//checks
		if(formData[0]['value'].length == 0)	{errors.push( {field: formData[0]['name'], err:0 } ); }
		if(formData[1]['value'].length == 0)	{errors.push( {field: formData[1]['name'], err:0 } ); }
		if(formData[2]['value'].length == 0)	{errors.push( {field: formData[2]['name'], err:0 } ); }
		if(formData[3]['value'].length == 0)	{errors.push( {field: formData[3]['name'], err:0 } ); }

		if(formData[0]['value'].length != 4)	{errors.push( {field: formData[0]['name'], err:1 } ); }
		if(formData[1]['value'].length != 4)	{errors.push( {field: formData[1]['name'], err:1 } ); }
		if(formData[2]['value'].length != 4)	{errors.push( {field: formData[2]['name'], err:1 } ); }
		if(formData[3]['value'].length != 2)	{errors.push( {field: formData[3]['name'], err:1 } ); }

		if(!F.Check('T4',formData[0]['value']))	{errors.push( {field: formData[0]['name'], err:4 } ); }
		if(!F.Check('T4',formData[1]['value']))	{errors.push( {field: formData[1]['name'], err:4 } ); }
		if(!F.Check('T4',formData[2]['value']))	{errors.push( {field: formData[2]['name'], err:4 } ); }
		if(!F.Check('T2',formData[3]['value']))	{errors.push( {field: formData[3]['name'], err:4 } ); }

		var mail=formData[4]['value'];
		if(mail.length == 0)					{errors.push( {field: formData[4]['name'], err:0 } ); }
		if(!F.Check('M',mail))					{errors.push( {field: formData[4]['name'], err:2 } ); }

		var pass=formData[5]['value'];
		if(pass.length == 0)					{errors.push( {field: formData[5]['name'], err:0 } ); }
		if(!F.Check('P',pass))					{errors.push( {field: formData[5]['name'], err:3 } ); }

		if(errors.length>0){
			F.HightlightErrors(errors);
			return false;
		}

		$.ajax({
			method: 	'POST',
			dataType: 	'json',
			url: 		'./ajax/author.ajax.php',
			data:{
				action: 'suscribe',
				sql: 	true,
				data:   {
							TB_ticket_A: 	formData[0]['value'],
							TB_ticket_B: 	formData[1]['value'],
							TB_ticket_C: 	formData[2]['value'],
							TB_ticket_D: 	formData[3]['value'],
							TB_mail: 		formData[4]['value'],
							TB_pass: 		formData[5]['value']
						}
			},
			beforeSend: function(){
				$('div#ticketBox div.loadingOverlay').addClass('display');
			}
		}).done(function(res){
			$('div#ticketBox div.loadingOverlay').removeClass('display');
			if(res.success){
				// populate content
				displayAuthorMode();
			} else {
				$('div#ticketBox form ins.result').addClass('error');
				$('div#ticketBox form ins.result').text(res.message);
				F.HightlightErrors(res.errors);
			}
		});

		

	});

});