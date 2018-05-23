$(document).ready(function() {
	popin.linkClick();
	forms.requete(subscribe);
	forms.requete(login);
	logout.requete($('#logout'));
	forms.requete(recipeAdd, true);
	textarea.init();
	etapes.init();
	ingredients.init();
	unites.init();
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
	el: '.js-textarea',
	mesureClassCorrect: 'mesureCorrect',
	mesureClassError: 'mesureError',
	init: function() {
		$(this.el).each(function() {
			if ($(this).siblings('progress').length < 1) {
				$(this).after('<progress></progress><span class="count"></span>');
				textarea.changeMesure(this);
			}
		});

		$(this.el).bind('input propertychange', function() {
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
	el: $('.etapes').children('ol').html(),
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
		this.liste.empty();
		for (var i = 0; i < this.elMin; i++) {
			this.liste.append(this.el);
			this.progAndNameEl();
		}
	},
	addEl: function() {
		this.btn.click(function() {
			if ($(etapes.li).length < etapes.elMax) {
				etapes.liste.append(etapes.el);
				etapes.progAndNameEl();
			}
		});
	},
	removeEl: function() {
		this.liste.on('click', '.close', function() {
			if ($(etapes.li).length > etapes.elMin) {
				$(this).parents('li').remove();
				etapes.progAndNameEl();
			}
		});
	},
	upEl: function() {
		this.liste.on('click', '.up', function() {
			$(this).parents('li').insertBefore($(this).parents('li').prev());
			etapes.progAndNameEl();
		});
	},
	downEl: function() {
		this.liste.on('click', '.down', function() {
			$(this).parents('li').insertAfter($(this).parents('li').next());
			etapes.progAndNameEl();
		});
	},
	progAndNameEl: function() {
		textarea.init();
		$(this.li).each(function() {
			$(this).children('textarea').attr('name', 'etape' + ($(this).index() + 1));
		});
	},
};

var ingredients = {
	liste: $('.ingredients').children('ul'),
	btn: $('.ingredients').children('.btn'),
	li: '.ingredients li',
	el: $('.ingredients').children('ul').html(),
	elMin: 2,
	elMax: 30,
	init: function() {
		this.liste.empty();
		for (var i = 0; i < this.elMin; i++) {
			this.liste.append(this.el);
			this.nameEl();
		}
		this.addEl();
		this.removeEl();
	},
	addEl: function() {
		this.btn.click(function() {
			if ($(ingredients.li).length < ingredients.elMax) {
				ingredients.liste.append(ingredients.el);
				ingredients.nameEl();
				unites.pushOptions();
			}
		});
	},
	removeEl: function() {
		this.liste.on('click', '.close', function() {
			if ($(ingredients.li).length > ingredients.elMin) {
				$(this).parents('li').remove();
				ingredients.nameEl();
			}
		});
	},
	nameEl: function() {
		$(this.li).each(function() {
			$(this).children('input[type="text"]').attr({name: 'ingredient' + ($(this).index() + 1), placeholder: 'Ingrédient ' + ($(this).index() + 1)});
			$(this).children('select').attr({name: 'unite' + ($(this).index() + 1)});
			$(this).children('input[type="number"]').attr({name: 'quantite' + ($(this).index() + 1), placeholder: 'Quantité (ex: 1, 50...)'});
		});
	},
};

var unites = {
	selectOptions: '<option value="" selected= "selected" disabled="disabled">Choisis une unité...</option>',
	quantite: '<input type="number" min="1"></input>',
	init: function() {
		this.ajax();
		this.pushQuantite();
	},
	ajax: function() {
		$.ajax({
			type: 'post',
			url: 'partials/traitements/recipe-ingredients.php',
			dataType: 'json',
			success: function(data) {
				for (var key in data) {
					unites.selectOptions += '<option value="'+data[key]['id']+'" data-quantifiable="'+data[key]['quantifiable']+'">'+key+'</option>';
				}
				unites.pushOptions();
			},
		});
	},
	pushOptions: function() {
		$(ingredients.li).children('select').each(function() {
			if (! $(this).children('option').length) $(this).html(unites.selectOptions);
		});
	},
	pushQuantite: function() {
		$(ingredients.li).children('select').change(function() {
			console.log($(this));
			if ($(this).children('option:selected').data("quantifiable")) {
				if (! $(this).siblings('input[type="number"]').length) {
					$(this).after(unites.quantite);
					ingredients.nameEl();
				}
			}
			else {
				$(this).siblings('input[type="number"]').remove();
			}
		});
	},
};
