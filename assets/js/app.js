(function($, window, document, undefined, Nuclear) {

	var $window = $(window);
	var $document = $(document);

	Nuclear = Nuclear || {};

	Nuclear.common = {

		init: function() {
			console.log('init');
			// uncomment to see sample ajax request
			// this.exampleAjax();
		},

		/*!
		 * Comment this out to see how the 'micro api' response
		 */
		exampleAjax: function() {
			var response = Nuclear.microApi.get({
				post_type: 'page',
				posts_per_page: '1'
			});

			response.then(function(data) {
				console.log(data);
			});
		}
	};

	/*!
	 * Example on how to use built in 'micro api'
	 */
	Nuclear.microApi = {
		get: function(WP_Query) {
			var deffered;

			if(typeof WP_Query !== 'object')
				return false;

			deffered = $.Deferred();

			$.ajax({
				type: 'POST',
				url: Nuclear.ajaxUri,
				data: {
					nonce: Nuclear.nonce,
					action: 'nuclear_micro_api',
					wp_query: WP_Query
				}
			}).success(function(data){
				deffered.resolve(data);
			}).error(function(err) {
				deffered.reject(err);
			});

			return deffered.promise();
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

})(jQuery, window, document, undefined, Nuclear);
