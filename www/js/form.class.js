
// FORM
(function($){

	$.Form = function() {};

	$.Form.prototype = {
		errorCodes: [
			'Ce champs n\'est pas renseigné',
			'Ce champs n\'est pas complet',
			'L\'adresse mail indiquée est mal formatée',
			'Le mot de passe indiquée n\'est pas sécurisé'+"\n"+'  (8 caractères minimum | lettres + chiffres | 1 majuscule minimum)',
			'La portion de code indiquée est invalide'+"\n"+'  (lettres + chiffres uniquement)'
		],
		ResetError: function(){
			var that=this;
			$.each($('input.error'),function(i,v){
				$(v).removeClass('error');
				$(v).removeAttr('title');
			});
			$('ins.result').text('');
			$('ins.result').removeClass('error');
		},
		HightlightErrors: function(errors){
			var that=this;
			$.each(errors,function(i,v){
				// element
				var el;
				if(v.field==undefined)	el = $('input[name="'+i+'"');
				else					el = $('input[name="'+v.field+'"');
				el.addClass('error');
				// number
				var err;
				if(v.err==undefined)	err=v;
				else					err=v.err;
				if(el.attr('title')==undefined)
					el.attr('title','- '+that.errorCodes[err]);
				else
					el.attr('title', el.attr('title')+"\n"+'- '+that.errorCodes[err]);
			});
		},
		Check: function(type,value){
			switch(type){
				case'M':
					if(value.match(/^[a-zA-Z0-9._+-]+@+[a-zA-Z0-9._-]+\.[a-zA-Z]{2,6}$/)){
						return true;
					}
				break;
				case'P':
					if(value.match(/^(?=.*[0-9])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,}$/)){
						return true;
					}
				break;
				case'T4':
					if(value.match(/^[A-Z0-9]{4}$/)){
						return true;
					}
				break;
				case'T2':
					if(value.match(/^[A-Z0-9]{2}$/)){
						return true;
					}
				break;
			}
			return false;
		}
	};

}(jQuery));
