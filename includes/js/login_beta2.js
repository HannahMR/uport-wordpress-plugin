(function ready() {

  const uportconnect = window.uportconnect
  const appName = wp_uport_config.appName
  const appMNID = wp_uport_config.appMNID
  const connect = new uportconnect.Connect(
    appName,
    {
      network: 'rinkeby',

    })
  const signer  = uportconnect.SimpleSigner(wp_uport_config.signkey)
  const credentials = new uportconnect.Credentials({
    appName: appName,   // $bloginfo of wp site
    address: appMNID,   // MNID of the application identity, defined in wp-config.php
    signer: signer        // Signer object, private key should be defined in wp-config.php
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
  // const
  // var uportConnect.onclick = function() {
  //   connect.requestCredentials().then((credentials) => {
  //     console.log(credentials)
  //   })
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

  const injectButton = function() {
    const loginForm = document.getElementById('loginform')
    const buttondata = '<div class="button buttom-primary button-large" id="connectUportBtn" style="float: left" onclick="button_in_ready()">Connect uPort</div>'
    loginForm.insertAdjacentHTML('beforeend', buttondata)
    let button_in = document.getElementById('connectUportBtn')
    button_in.onclick = () => {
      connect.requestCredentials().then((credentials) => {
        console.log(credentials)
      })
    }
  }

  // const button_in_ready = function() {
  //   let button_in = document.getElementById('connectUportBtn')
  //   button_in.onclick = () => {
  //     connect.requestCredentials().then((credentials) => {
  //       console.log(credentials)
  //     })
  //   }
  // }

  if (document.readyState !== 'loading' &&
  document.getElementsByClassName('login') != null &&
  document.getElementsByClassName('wp-core-ui') != null){
    injectButton()
    // button_in_ready()
    // uriHandler(uri)
  } else {
    // document.addEventListener('DOMContentLoaded', uriHandler)
    document.addEventListener('DOMContentLoaded', injectButton)
  }
})();
