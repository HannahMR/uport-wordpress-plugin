//@flow
// import {Connect, ConnectCore, QRUtil, SimpleSigner, Credentials, MNID} from 'uport-connect'
// import Web3 from 'web3'
(function ready() {
// const uport = require('uport');

const uportconnect = window.uportconnect
// var uport = new uportconnect.Connect('MyDApp')
// const Connect = window.uportconnect.Connect
const appName = wp_uport_config.appName // bloginfo
const appMNID = wp_uport_config.appMNID // MNID needs defined in wp-config.php
const connect = new uportconnect.Connect(appName, {
  network: 'rinkeby'
})
const signer  = uportconnect.SimpleSigner(wp_uport_config.signkey)
const credentials = new uportconnect.Credentials({
  appName: appName,   // $bloginfo of wp site
  address: appMNID,   // MNID of the application identity, defined in wp-config.php
  signer: signer        // Signer object, private key should be defined in wp-config.php
})
// const web3 = connect.getWeb3()

// function ready() {
// uPort connect
const uportConnect = function() {

  // web3.eth.getCoinbase((error, address) => {
  //   if (error) { throw error }
  // globalState.ethAddress = address

  // let signer = connect.SimpleSigner(<your key here>)
  // let endpoint = <replace this with a public IP or HTTP tunnel>

  connect.requestCredentials().then((credentials) => {
    console.log(credentials)
  })
}


  credentials.createRequest({
    requested: ['ID', 'user_email', 'user_login', 'user_pass'],
    callbackUrl: "<public address>/callback",            // publicly available IP address for the callback
    exp: Math.floor(new Date().getTime()/1000) + 300     // expiration for the request
    }).then( function(response) {
    // see step 4...
  })

  var injectButton = function(uportConnect) {
    const loginForm = document.getElementById('loginform')
    const buttondata = '<div class="button buttom-primary button-large" id="connectUportBtn" style="float: left" onclick="uportConnect()">Connect uPort</div>'
    loginForm.insertAdjacentHTML('beforeend', buttondata)
  }



  if (document.readyState !== 'loading' &&
  document.getElementsByClassName('login') != null &&
  document.getElementsByClassName('wp-core-ui') != null){
    injectButton()
  } else {
    document.addEventListener('DOMContentLoaded', injectButton)
  }
}
)();
