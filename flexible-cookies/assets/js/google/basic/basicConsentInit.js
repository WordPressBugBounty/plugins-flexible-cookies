var gtmScript = document.createElement('script');
gtmScript.async = true;
gtmScript.src = 'https://www.googletagmanager.com/gtm.js?id='+basicCMSettings.gtmId;

var firstScript = document.getElementsByTagName('script')[0];
firstScript.parentNode.insertBefore(gtmScript,firstScript);

dataLayer.push( { 'gtm.start': new Date().getTime(), 'event': 'gtm.js' } );
