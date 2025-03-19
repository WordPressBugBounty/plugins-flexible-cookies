const cookiesArray        = [];
const categories          = data.categories;
const preset_categories   = data.preset_categories;
const assignedCategories  = data.assigned_categories;
const hideAssignedCookies = data.hide_assigned_cookies;

window.addEventListener( 'message', function ( event ) {
	jQuery( '.scanner_spinner' ).fadeIn( 200 );
	let cookies = flexibleCookiesReceiver.convertCookiesToArray( decodeURIComponent( event.data ) );
	flexibleCookiesReceiver.updateTableUI( new Set( [ ...cookiesArray, ...cookies ] ) )
} );

class FlexibleCookiesReceiver {
	isCookieInPresetCategories( cookie_name ) {
		for ( let i = 0; i < preset_categories.length; i++ ) {
			if ( preset_categories[ i ].name === cookie_name ) {
				return preset_categories[ i ].category;
			}
		}
		return false;
	}
	getAssignedCategory( cookie_name ) {
		return assignedCategories[ cookie_name ];
	}

	getSelectedCategory( cookieName ) {
		return flexibleCookiesReceiver.getAssignedCategory( cookieName ) ? flexibleCookiesReceiver.getAssignedCategory( cookieName ) : flexibleCookiesReceiver.isCookieInPresetCategories( cookieName );
	}

	convertCookiesToArray( cookies ) {
		return cookies.split( ';' )
			.map( c => c.trim() )
			.map( c => c.split( '=' ) )
			.map( ( [ cookieName ] ) => cookieName )
	}

	getSelectField( cookie_name, selectedCategory ) {

		const select = document.createElement( 'select' );
		select.setAttribute( 'name', cookie_name );


		Object.entries( categories ).forEach( entry => {
			const [ key, value ] = entry;

			const option    = document.createElement( 'option' );
			option.value    = key;
			option.selected = selectedCategory === key;

			const text = document.createTextNode( value );
			option.appendChild( text );

			select.appendChild( option );
		} );


		return select;
	}

	updateTableUI( data ) {
		let tbodyElement = jQuery( '#flexible_cookies_cookie_table tbody' );
		tbodyElement.empty();

		data.forEach( function ( cookie ) {
			if ( flexibleCookiesReceiver.getAssignedCategory( cookie ) && hideAssignedCookies ) {
				return;
			}

			const selectedCategory = flexibleCookiesReceiver.getSelectedCategory( cookie );

			const tr = document.createElement( 'tr' );

			const cell_1       = document.createElement( 'td' );
			const checkbox     = document.createElement( 'input' );
			checkbox.type      = 'checkbox';
			checkbox.classList = 'cookie_checkbox';
			checkbox.name      = 'cookie_name[]';
			checkbox.value     = cookie;
			checkbox.checked   = true;
			cell_1.appendChild( checkbox );
			tr.appendChild( cell_1 );

			const cell_2 = document.createElement( 'td' );
			cell_2.appendChild( document.createTextNode( cookie ) );
			tr.appendChild( cell_2 );

			const cell_3 = document.createElement( 'td' );
			cell_3.appendChild( flexibleCookiesReceiver.getSelectField( cookie, selectedCategory ) );
			tr.appendChild( cell_3 );

			if( !selectedCategory || selectedCategory === 'other'){
				tbodyElement.prepend( tr );
				return;
			}
			tbodyElement.append( tr );

		} );
		jQuery( '.scanner_spinner' ).fadeOut( 200 );
	}
}

const flexibleCookiesReceiver = new FlexibleCookiesReceiver();

