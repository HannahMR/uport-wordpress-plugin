//@flow
import { Connect, SimpleSigner } from 'uport-connect'


// const Connect = window.uportconnect.Connect;
const appName = 'uport-wp-plugin';
// const connect = new Connect(appName, {network: 'rinkeby'})
// const web3 = Connect.getWeb3();

var uport = new Connect('uport-wp-plugin', {
  clientId: '2onpaDYj2R4RaUJGJcWe3AAWoQn5e4kwQzo',
  network: 'rinkeby',
  signer: SimpleSigner('20c2eb928659799c4cf6e25177d0a68f26819774d30d0127d2aaa0beae84b258'),
})
// uPort connect
const uportConnect = function () {
  web3.eth.getCoinbase((error, address) => {
    if (error) { throw error }
    globalState.ethAddress = address

    // This one is for display purposes - MNID encoding includes network
    globalState.uportId = window.uportconnect.MNID.encode({network: '0x4', address: address})

    statusInstance.getStatus.call(globalState.ethAddress, (err, st) => {
      globalState.currentStatus = st
      web3.eth.getBalance(globalState.ethAddress, (err, bal) => {
        globalState.ethBalance = web3.fromWei(bal)
        render()
      })
    })
  })
}
// Request credentials to login
// uport.requestCredentials({
//   requested: ['name', 'email', 'password'],
//   notifications: true // We want this if we want to recieve credentials
// })
// .then((credentials) => {
//   // Do something
// })

// Attest specific credentials
// uport.attestCredentials({
//   sub: THE_RECEIVING_UPORT_ADDRESS,
//   claim: {
//     CREDENTIAL_NAME: CREDENTIAL_VALUE
//   },
//   exp: new Date().getTime() + 30 * 24 * 60 * 60 * 1000, // 30 days from now
// })


function ready(injectButton) {
  var injectButton = function() {
    var loginForm = document.getElementById('loginform');
    var uportlogin = document.createElement("div");
    // var buttondata = 'class="button button-small buttom-primary" id="connectUportBtn" style="float: left" onclick="uportConnect()">Connect uPort';
    // uportlogin.innerHTML = buttondata;
    uportlogin.textContent = 'Connect uPort';
    uportlogin.className = 'button button-small buttom-primary';
    loginForm.appendChild(uportlogin);
  };
  if (document.readyState !== 'loading' &&
    document.getElementsByClassName('login') != null &&
    document.getElementsByClassName('wp-core-ui') != null){ // &&
    // document.getElementsByClassName.length('login') > 0){
    injectButton();
  } else {
      document.addEventListener('DOMContentLoaded', injectButton);
    };
  }
global.ready = ready;
