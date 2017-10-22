
// FORM
(function($){

	$.Form = function() {};

	$.Form.prototype = {
		errorCodes: [
			'Ce champs n\'est pas renseigné',
			'Ce champs n\'est pas complet'
		],
		ResetError: function(){
			var that=this;
			$.each($('input.error'),function(i,v){
				$(v).removeClass('error');
				$(v).removeAttr('title');
			});
		},
		ConnectError: function(errors){
			var that=this;
			$.each(errors,function(i,v){
				var el = $('input[name="'+v.field+'"');
				el.addClass('error');
				if(el.attr('title')==undefined)
					el.attr('title','- '+that.errorCodes[v.err]);
				else
					el.attr('title', el.attr('title')+"\n"+'- '+that.errorCodes[v.err]);
			});
		},
		ListenForms: function(){
			var that=this;
			
		}
	};

}(jQuery));
