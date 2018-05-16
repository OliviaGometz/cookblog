$(document).ready(function() {
	popin.linkClick();
	forms.requete(subscribe);
	forms.requete(login);
	logout.requete($('#logout'));
	forms.requete(recipeAdd);
	textarea.init();
});

var popin = {
	el: $('aside.popin'),
	contents: $('.popin-content'),
	linkClick: function() {
		$('nav li').click(function(e) {
			popin.openContent('#' + $(this).data('target'));
		});
	},
	openContent: function(ct) { //pimper fonction avec classes personnalisées + virer style inline aside dans popin.php
		this.el.show();
		this.contents.hide();
		$(ct).show();
	},
	close: function() {

	},
};

var message = {
	el: $('aside.message'),
	close: function() {

	},
};

var popup = {
	el: $('<aside class="popup"></aside>'),
	create: function(block) {
		$('.popup').remove();
		block.prepend(this.el);
	},
	close: function() {

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
			if (errors.length) {
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
		popup.create($(this.following));
		popup.el.load('partials/templates/popup-registred.php', {'pseudo': data['pseudo'], 'email': data['email']});
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

var logout = {
	requete: function(el) {
		el.click(function(e) {
			logout.ajax();
		});
	},
	ajax: function() {
		$.ajax({
			url: 'partials/traitements/logout.php',
			type: 'POST',
			success: function() {
				location.reload();
			},
			error: function() {
				popup.create($('body'));
				popup.el.html('<p>Une erreur est survenue lors de l\'appel AJAX&nbsp;: tu n\'as peut-être pas été déconnecté.</p>');
			},
		});
	},
};

var recipeAdd = {
	el: $('#recipeAdd'),
	errors: function(data) {
		console.log(data);
	},
	registred: function(data) {
		console.log(data);
	},
};

var textarea = {
	el: $('textarea'),
	mesureClassCorrect: 'mesureCorrect',
	mesureClassError: 'mesureError',
	init: function() {
		this.start();
		$('textarea').bind('input propertychange', function() {
			textarea.changeMesure(this);
		});
	},
	start: function() {
		this.el.after('<div class="text-mesure"><div></div></div><span class="text-count"></span>');
		this.el.each(function() {
			textarea.changeMesure(this);
		});
	},
	changeMesure: function(e) {
		var pourcent = Math.ceil(e.value.length / $(e).attr('maxlength') * 100) + '%';
		var mesureClass = e.value.length >= $(e).attr('minlength') && e.value.length <= $(e).attr('minlength') ? textarea.mesureClassCorrect : textarea.mesureClassError;
		$(e).siblings('.text-mesure').children('div').css('width', pourcent).removeClass(textarea.mesureClassCorrect, textarea.mesureClassError).addClass(mesureClass);
		$(e).siblings('.text-count').text(e.value.length + '/' + $(e).attr('maxlength'));
	},
};