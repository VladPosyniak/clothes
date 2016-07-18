authApp.config(function($authProvider) {


$authProvider.loginUrl = 'api/authenticate/auth';

$authProvider.google({
  url: 'api/authenticate/google',
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


$authProvider.instagram({
  name: 'instagram',
  url: 'api/authenticate/instagram',
  authorizationEndpoint: 'https://api.instagram.com/oauth/authorize',
  redirectUri: 'http://localhost/',
  requiredUrlParams: ['scope'],
  scope: ['basic'],
  scopeDelimiter: '+',
  clientId: '5db28eb986294edda144099b91e955b8',
  type: '2.0'
});


});








