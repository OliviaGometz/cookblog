$(document).ready(function() {
	popin.linkClick();
	forms.requete(subscribe);
	forms.requete(login);
	logout.requete($('#logout'));
	forms.requete(recipeAdd, true);
	textarea.init();
	etapes.init();
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
	requete: function(variable, hasFiles = false) {
		variable.el.find($('input[type="submit"]')).click(function(e) {
			e.preventDefault();
			if(hasFiles) {
				forms.ajaxFiles(variable);
			}
			else {
				forms.ajax(variable);
			}
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
	ajaxFiles: function(variable) {
		var formData = new FormData(variable.el.get(0));
		$.ajax({
			type: variable.el.attr('method'),
			url: variable.el.attr('action'),
			data: formData,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: function(data) {
				forms.reponseAjax(variable, data);
			},
			error: function(jqXHR, exception) {
				var errorMsg = '<p>Une erreur est survenue lors de l\'appel AJAX.</p> <code>jqXHR.status: '+jqXHR.status+'<br> exception: '+exception+'</code>';
				forms.errorAjax(variable, errorMsg);
			},
		});
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
	el: $('.js-textarea'),
	mesureClassCorrect: 'mesureCorrect',
	mesureClassError: 'mesureError',
	init: function() {
		this.start();
		this.el.bind('input propertychange', function() {
			textarea.changeMesure(this);
		});
	},
	start: function() {
		this.el.after('<progress></progress><span class="count"></span>');
		this.el.each(function() {
			textarea.changeMesure(this);
		});
	},
	changeMesure: function(e) {
		var mesureClass = e.value.length >= $(e).attr('minlength') && e.value.length <= $(e).attr('maxlength') ? textarea.mesureClassCorrect : textarea.mesureClassError;
		$(e).siblings('progress').attr('value', e.value.length).attr('max', $(e).attr('maxlength')).removeClass(textarea.mesureClassCorrect + ' ' + textarea.mesureClassError).addClass(mesureClass);
		$(e).siblings('.count').text(e.value.length + '/' + $(e).attr('maxlength'));
	},
};

var etapes = {
	liste: $('.etapes').children('ol'),
	btn: $('.etapes').children('.btn'),
	li: '.etapes li',
	el: '<li><textarea></textarea><div class="actions"><span class="up">up</span><span class="down">down</span><span class="close">x</span></div></li>',
	elMin: 3,
	elMax: 30,
	init: function() {
		this.start();
		this.addEl();
		this.removeEl();
		this.upEl();
		this.downEl();
	},
	start: function() {
		while ($(this.li).length < this.elMin) {
			this.liste.append(etapes.el);
		}
	},
	addEl: function() {
		this.btn.click(function() {
			if ($(etapes.li).length < etapes.elMax) {
				etapes.liste.append(etapes.el);
			}
		});
	},
	removeEl: function() {
		this.liste.on('click', '.close', function() {
			if ($(etapes.li).length > 1) {
				$(this).parents('li').remove();
			}
		});
	},
	upEl: function() {
		this.liste.on('click', '.up', function() {
			$(this).parents('li').insertBefore($(this).parents('li').prev());
		});
	},
	downEl: function() {
		this.liste.on('click', '.down', function() {
			$(this).parents('li').insertAfter($(this).parents('li').next());
		});
	},
}
