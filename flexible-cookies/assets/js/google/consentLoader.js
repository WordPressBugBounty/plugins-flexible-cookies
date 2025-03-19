class FlexibleCookiesGTMConsentLoader {

	loadDefaultValues() {
		gtag( 'consent', 'default', {
			'ad_storage': gtmLoader.ad_storage,
			'ad_user_data': gtmLoader.ad_user_data,
			'ad_personalization': gtmLoader.ad_personalization,
			'analytics_storage': gtmLoader.analytics_storage,
			'wait_for_update': 500,
		} );
	}

	loadUserGrantedValues( allowedCategories ) {
		flexibleCookiesGTMConsentUpdater.grantAcceptedCategories( allowedCategories.split( ',' ) );
	}
}

const flexibleCookiesGTMConsentLoader = new FlexibleCookiesGTMConsentLoader();

let consentStatus = flexibleCookiesGTMFunctions.isConsentGranted();

if ( consentStatus !== false ) {
	flexibleCookiesGTMConsentLoader.loadUserGrantedValues( consentStatus );
} else {
	flexibleCookiesGTMConsentLoader.loadDefaultValues();
}

