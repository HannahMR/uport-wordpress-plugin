(function ready() {

  const uportconnect = window.uportconnect
  const appName = wp_uport_config.appName
  const appMNID = wp_uport_config.appMNID
  const connect = new uportconnect.Connect(
    appName,
    {
      network: 'rinkeby',
    })
  const Signer  = new uportconnect.SimpleSigner(wp_uport_config.signkey)
  const credentials = new uportconnect.Credentials({
    appName:  wp_uport_config.appName,   // $bloginfo of wp site
    address:  wp_uport_config.appMNID,   // MNID of the application identity, defined in wp-config.php
    signer:   wp_uport_config.signkey     // Signer object, private key should be defined in wp-config.php
  })

  // const uriHandler = (uri) => {
  // // Creates a QR code URI, this is also a good place to you used any QR code library you prefer.
  // const qrCode = uportconnect.QRUtil.getQRDataURI(uri)
  // // A QR cod URI can then be used in a html img tag <img src="${qrCode}"/>
  // const loginForm = document.getElementById('loginform')
  // const qrcodedata = '<div img src="${qrCode}"/>'
  // loginForm.insertAdjacentHTML('beforeend', qrcodedata)
  //
  // }
  // credentials.createRequest({
  //   requested: ['ID', 'user_email', 'user_login', 'user_pass'],
  //   callbackUrl: "<public address>/callback",            // publicly available IP address for the callback
  //   exp: Math.floor(new Date().getTime()/1000) + 300     // expiration for the request
  // }).then( function(response) {
  //   // see step 4...
  //   })
  // }
  // const qrcodedata = '<div img src="${qrCode}"/>

  const injectButton = () => {
    const loginForm = document.getElementById('loginform')
    const buttondata = '<div class="button buttom-primary button-large" id="connectUportBtn" style="float: right;background: #0085ba; border-color: #0073aa #006799 #006799; box-shadow: 0 1px 0 #006799; color: #fff; text-decoration: none; text-shadow: 0 -1px 1px #006799, 1px 0 1px #006799, 0 1px 1px #006799, -1px 0 1px #006799;">uPort Login </div>'
    loginForm.insertAdjacentHTML('beforeend', buttondata)
    let button_in = document.getElementById('connectUportBtn')
    button_in.onclick = () => {
      connect.requestCredentials().then((credentials) => {
        console.log(credentials)
        return credentials 
      })
    }
  }

  if (document.readyState !== 'loading' &&
  document.getElementsByClassName('login') != null &&
  document.getElementsByClassName('wp-core-ui') != null){
    injectButton()
  } else {
    document.addEventListener('DOMContentLoaded', injectButton)
  }
})();
