do ($ = jQuery, window, document, Nuclear) ->
	# "use strict"; inside the function scope
	`'use strict'`

	#	jQuery global objects
	$window = $ window
	$document = $ document
	$body = $ 'body'

	# 	merge objects
	Nuclear = Nuclear or {}

	# 	common code
	Nuclear.common =
		init: ->
			console.log 'Nuclear Init'
			return

	#	ajax
	Nuclear.api = 
		get: (query) ->
			if typeof query isnt 'object'
				return false

			deffered = $.Deferred()

			$.ajax
				type: 'GET'
				url: Nuclear.ajaxUri
				data: 
					nonce: Nuclear.nonce
					action: 'nuclear_micro_api'
					wp_query: query
			.success (data) ->
				deffered.resolve data
			.error (err) ->
				deffered.reject err

			deffered.promise()


	UTIL =
		fire: (func, funcname, args) ->
			namespace = Nuclear
			funcname = (if (funcname is `undefined`) then 'init' else funcname)
			namespace[func][funcname] args if func isnt '' and namespace[func] and typeof namespace[func][funcname] is 'function'
			return

		loadEvents: ->
			UTIL.fire 'common'
			$.each document.body.className.replace(/-/g, '_').split(/\s+/), (i, classnm) ->
				UTIL.fire classnm
				return
			return

	$document.ready UTIL.loadEvents;
	return