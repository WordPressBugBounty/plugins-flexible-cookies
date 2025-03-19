window.dataLayer = window.dataLayer || [];

function gtag() {
	dataLayer.push( arguments );
}


class FlexibleCookiesGTMFunctions {

	isConsentGranted(){
		let cookie_name = 'flexible_cookies_accepted_categories';
		let name = cookie_name + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) === ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) === 0) {
				return c.substring(name.length, c.length);
			}
		}
		return false;
	}
}

const flexibleCookiesGTMFunctions = new FlexibleCookiesGTMFunctions();
