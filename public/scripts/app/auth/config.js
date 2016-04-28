authApp.config(function($authProvider) {


$authProvider.loginUrl = '/authenticate/auth';

$authProvider.google({
  url: '/authenticate/google',
  name: "google",
  authorizationEndpoint: 'https://accounts.google.com/o/oauth2/auth',
  requiredUrlParams: ['scope'],
  optionalUrlParams: ['display'],
  scope: ['profile', 'email'],
  scopePrefix: 'openid',
  scopeDelimiter: ' ',
  display: 'popup',
  type: '2.0',
  popupOptions: { width: 452, height: 633 },
  clientId: '1053405629906-7dessi035qfi5o79v0pcjrgqupmf51pd.apps.googleusercontent.com'
})


});








