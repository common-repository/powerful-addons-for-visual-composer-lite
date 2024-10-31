( function( $ ) {

	/**
	 * AJAX Request Queue
	 *
	 * - add()
	 * - remove()
	 * - run()
	 * - stop()
	 *
	 * @since 1.0.0
	 */
	var PAVCAjaxQueue = (function() {

		var requests = [];

		return {

			/**
			 * Add AJAX request
			 *
			 * @since 1.2.0.8
			 */
			add:  function(opt) {
			    requests.push(opt);
			},

			/**
			 * Remove AJAX request
			 *
			 * @since 1.2.0.8
			 */
			remove:  function(opt) {
			    if( jQuery.inArray(opt, requests) > -1 )
			        requests.splice($.inArray(opt, requests), 1);
			},

			/**
			 * Run / Process AJAX request
			 *
			 * @since 1.2.0.8
			 */
			run: function() {
			    var self = this,
			        oriSuc;

			    if( requests.length ) {
			        oriSuc = requests[0].complete;

			        requests[0].complete = function() {
			             if( typeof(oriSuc) === 'function' ) oriSuc();
			             requests.shift();
			             self.run.apply(self, []);
			        };

			        jQuery.ajax(requests[0]);

			    } else {

			      self.tid = setTimeout(function() {
			         self.run.apply(self, []);
			      }, 1000);
			    }
			},

			/**
			 * Stop AJAX request
			 *
			 * @since 1.2.0.8
			 */
			stop:  function() {

			    requests = [];
			    clearTimeout(this.tid);
			}
		};

	}());

	PAVCAdmin = {

		init: function() {
			/**
			 * Run / Process AJAX request
			 */
			PAVCAjaxQueue.run();

			$( document ).delegate( ".pavc-activate-widget", "click", PAVCAdmin._activate_widget );
			$( document ).delegate( ".pavc-deactivate-widget", "click", PAVCAdmin._deactivate_widget );

			$( document ).delegate( ".pavc-addons-activate-all", "click", PAVCAdmin._bulk_activate_widgets );
			$( document ).delegate( ".pavc-addons-deactivate-all", "click", PAVCAdmin._bulk_deactivate_widgets );
		},

		/**
		 * Activate All Widgets.
		 */
		_bulk_activate_widgets: function( e ) {
			var button = $( this );

			var data = {
				action: 'powerful_vc_bulk_activate_widgets',
				nonce: pavc_admin_js.ajax_nonce,
			};

			if ( button.hasClass( 'updating-message' ) ) {
				return;
			}

			$( button ).addClass('updating-message');

			PAVCAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){

					// Bulk add or remove classes to all modules.
					$('.pavc-widget-list').children( "div" ).addClass( 'activate' ).removeClass( 'deactivate' );

					$('.pavc-widget-list').children( "div" ).find('.pavc-activate-widget').addClass('pavc-deactivate-widget').removeClass('pavc-activate-widget');
					$('.pavc-widget-list').children( "div" ).find('.dashicons').removeClass('dashicons-visibility').addClass('dashicons-hidden');

					$( button ).removeClass('updating-message');
				}
			});

			e.preventDefault();
		},

		/**
		 * Deactivate All Widgets.
		 */
		_bulk_deactivate_widgets: function( e ) {
			var button = $( this );

			var data = {
				action: 'powerful_vc_bulk_deactivate_widgets',
				nonce: pavc_admin_js.ajax_nonce,
			};

			if ( button.hasClass( 'updating-message' ) ) {
				return;
			}

			$( button ).addClass('updating-message');

			PAVCAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){

					// Bulk add or remove classes to all modules.
					$('.pavc-widget-list').children( "div" ).addClass( 'deactivate' ).removeClass( 'activate' );

					$('.pavc-widget-list').children( "div" ).find('.pavc-deactivate-widget').addClass('pavc-activate-widget').removeClass('pavc-deactivate-widget');
					$('.pavc-widget-list').children( "div" ).find('.dashicons').removeClass('dashicons-hidden').addClass('dashicons-visibility');

					$( button ).removeClass('updating-message');
				}
			});
			e.preventDefault();
		},

		/**
		 * Activate Module.
		 */
		_activate_widget: function( e ) {
			var button = $( this ),
				id     = button.parents('div').attr('id');

			var data = {
				module_id : id,
				action: 'powerful_vc_activate_widget',
				nonce: pavc_admin_js.ajax_nonce,
			};

			if ( button.find('.dashicons').hasClass( 'updating-message' ) ) {
				return;
			}

			$( button ).find('.dashicons').removeClass('dashicons-visibility').addClass('updating-message');

			PAVCAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){

					// Add active class.
					$( '#' + id ).addClass('activate').removeClass( 'deactivate' );
					// Change button classes & text.
					$( '#' + id ).find('.pavc-activate-widget').addClass('pavc-deactivate-widget').removeClass('pavc-activate-widget');
					$( '#' + id ).find('.dashicons').removeClass('updating-message').addClass('dashicons-hidden');
				}
			});

			e.preventDefault();
		},

		/**
		 * Deactivate Module.
		 */
		_deactivate_widget: function( e ) {
			var button = $( this ),
				id     = button.parents('div').attr('id');

			var data = {
				module_id: id,
				action: 'powerful_vc_deactivate_widget',
				nonce: pavc_admin_js.ajax_nonce,
			};

			if ( button.find('.dashicons').hasClass( 'updating-message' ) ) {
				return;
			}

			$( button ).find('.dashicons').removeClass('dashicons-hidden').addClass('updating-message');

			PAVCAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){
					// Remove active class.
					$( '#' + id ).addClass( 'deactivate' ).removeClass('activate');
					// Change button classes & text.
					$( '#' + id ).find('.pavc-deactivate-widget').addClass('pavc-activate-widget').removeClass('pavc-deactivate-widget');
					$( '#' + id ).find('.dashicons').removeClass('updating-message').addClass('dashicons-visibility');
				}
			});

			e.preventDefault();
		}
	}

	$( document ).ready(function() {
		PAVCAdmin.init();
	});

} )( jQuery ); 
