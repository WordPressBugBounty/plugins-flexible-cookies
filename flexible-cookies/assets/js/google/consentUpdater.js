class FlexibleCookiesGTMConsentUpdater {
	DENIED_KEY  = 'denied';
	GRANTED_KEY = 'granted';

	grantAll() {
		gtag( 'consent', 'update', {
			'ad_storage': this.GRANTED_KEY,
			'ad_user_data': this.GRANTED_KEY,
			'ad_personalization': this.GRANTED_KEY,
			'analytics_storage': this.GRANTED_KEY
		} );
	}

	denyAll() {
		gtag( 'consent', 'update', {
			'ad_storage': this.DENIED_KEY,
			'ad_user_data': this.DENIED_KEY,
			'ad_personalization': this.DENIED_KEY,
			'analytics_storage': this.DENIED_KEY
		} );
	}

	grantAllowed( allowed_params ) {
		gtag( 'consent', 'update', allowed_params );
	}

	grantAcceptedCategories( allowedCategories ) {
		let allowedParams = {
			'ad_storage': this.DENIED_KEY,
			'ad_user_data': this.DENIED_KEY,
			'ad_personalization': this.DENIED_KEY,
			'analytics_storage': this.DENIED_KEY
		};

		allowedCategories.forEach( category => {
			for ( const [ key, value ] of Object.entries( gtmUpdater[ 'assigned_categories' ] ) ) {
				if ( category === value ) {
					allowedParams[ key ] = this.GRANTED_KEY;
				}
			}
		} );

		for ( const categoryKey in gtmUpdater[ 'assigned_categories' ] ) {
			if ( gtmUpdater[ 'necessary_categories' ].includes( gtmUpdater[ 'assigned_categories' ][ categoryKey ] ) ) {
				allowedParams[ categoryKey ] = this.GRANTED_KEY;
			}
		}

		this.grantAllowed( allowedParams );
	}
}

const flexibleCookiesGTMConsentUpdater = new FlexibleCookiesGTMConsentUpdater;
