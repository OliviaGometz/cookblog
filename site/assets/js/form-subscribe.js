$(document).ready(function(){
	form.requete();
});

var form = {
	object: $('#subscribe'),
	requete: function() {
		this.object.find($('input[type="submit"]')).click(function(e) {
			e.preventDefault();
			form.ajax();
		});
	},
	ajax: function() {
		$.post(
			this.object.attr('action'),
			this.object.serialize(),
			function(data, status, xhr) {
				if (status == 'success') {
					form.reponse(data);
				}
				else {
					errorMsg = '<p>Une erreur est survenue lors de l\'appel AJAX.</p> <code>xhr.readyState: '+xhr.readyState+'<br> xhr.status: '+xhr.status+'</code>';
					form.setErrorMsg(errorMsg);
				}
			},
			'json'
		);
	},
	reponse: function(data) {
		this.setErrorMsg();
		
		if (data['registred']) {
			this.registred(data);
		}
		else {
			this.setInputsErrorMsg(data);
		}
	},
	setErrorMsg: function(msg = null) {
		this.object.find($('div.error')).remove();
		if (msg != null) {
			this.object.append('<div class="error">'+msg+'</div>');
		}
	},
	setInputsErrorMsg: function(data) {
		this.object.children('fieldset').each(function() {
			var fieldset = $(this);
			var errors = data[fieldset.children('input').attr('name')];
			fieldset.children('ul').remove();
			if (errors.length > 0) {
				fieldset.removeClass('success').addClass('error');
				fieldset.append(document.createElement('ul'));
				errors.forEach(function(msg) {
					fieldset.children('ul').append('<li>'+msg+'</li>');
				});
			}
			else {
				fieldset.removeClass('error').addClass('success');
			}
		});
	},
	registred: function(data) {
		$('body').load('partials/templates/validated-subscribe.php', {'pseudo': data['pseudo']});
	},
};