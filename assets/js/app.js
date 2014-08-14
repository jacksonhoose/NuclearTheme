(function($, window, document, undefined) {

	var Nuclear = {};

	Nuclear.common = {
		init: function() {
			console.log('init');
			this.sayHello();
		},
		sayHello: function() {
			console.log('Hello');
		}
	};

	var UTIL = {
		fire: function(func, funcname, args) {
			var namespace = Nuclear;
			funcname = (funcname === undefined) ? 'init' : funcname;
			if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
				namespace[func][funcname](args);
			}
		},
		loadEvents: function() {
			UTIL.fire('common');

			$.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
				UTIL.fire(classnm);
			});
		}
	};

	$(document).ready(UTIL.loadEvents);

})(jQuery, window, document, undefined);
