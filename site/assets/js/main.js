$(document).ready(function() {
	popin.linkClick();
	forms.requete(subscribe);
	forms.requete(login);
});

var popin = {
	aside: $('aside.popin'),
	contents: $('.popin-content'),
	linkClick: function() {
		$('.no-connected li').click(function(e) {
			popin.openContent('#' + $(this).data('target'));
		});
	},
	openContent: function(ct) { //pimper fonction avec classes personnalisées + virer style inline aside dans popin.php
		this.aside.show();
		this.contents.hide();
		$(ct).show();
	},
};

var forms = {
	requete: function(variable) {
		variable.el.find($('input[type="submit"]')).click(function(e) {
			e.preventDefault();
			forms.ajax(variable);
		});
	},
	ajax: function(variable) {
		$.post(
			variable.el.attr('action'),
			variable.el.serialize(),
			function(data, status, xhr) {
				if (status == 'success') {
					forms.reponseAjax(variable, data);
				}
				else {
					var errorMsg = '<p>Une erreur est survenue lors de l\'appel AJAX.</p> <code>xhr.readyState: '+xhr.readyState+'<br> xhr.status: '+xhr.status+'</code>';
					forms.errorAjax(variable, errorMsg);
				}
			},
			'json'
		);
	},
	reponseAjax: function(variable, data) {
		this.cleanErrorAjax(variable);
		data['success'] ? variable.registred(data) : variable.errors(data);
	},
	errorAjax: function(variable, msg) {
		this.cleanErrorAjax(variable);
		variable.el.append('<div class="error">'+msg+'</div>');
	},
	cleanErrorAjax: function(variable) {
		variable.el.find($('div.error')).remove();
	},
};

var subscribe = {
	el: $('#subscribe'),
	following: '#connexion',
	errors: function(data) {
		this.el.children('fieldset').each(function() {
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
		popin.openContent(this.following);
		$(this.following).find($('input[name="login"]')).val(data['pseudo']);
		$(this.following).prepend(document.createElement('header'));
		$(this.following).children('header').load('partials/templates/form-login-header.php', {'pseudo': data['pseudo'], 'email': data['email']});
	},
};

var login = {
	el: $('#login'),
	errors: function(data) {
		this.el.children('ul').remove();
		this.el.append(document.createElement('ul'));
		data.forEach(function(msg) {
			login.el.children('ul').append('<li>'+msg+'</li>');
		});
	},
	registred: function(data) {
		location.reload();
	},
};