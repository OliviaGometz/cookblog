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
		this.setErrorMsg(); //vide l'emplacement de l'erreur
		if (data['registred'] != null) {
			console.log(data['registred']);
		}
		else {
			this.setInputsErrorMsg(data);
		}
	},
	setErrorMsg: function(msg = null) {
		this.object.find($('div.form-error')).html(msg);
	},
	setInputsErrorMsg: function(data) {
		this.object.children('fieldset').each(function() {
			var errors = data[$(this).children('input').attr('name')];
			var ul = $(this).children('ul.input-error');
			ul.empty(); //vide la liste d'erreurs
			errors.forEach(function(msg) {
				ul.append('<li>'+msg+'</li>');
			});
		});
	},
};