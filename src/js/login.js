import {$, JQuery} from 'jquery'
import { Connect, SimpleSigner } from 'uport-connect'


const Connect = window.uportconnect.Connect
const appName = 'UportTutorial'
const connect = new Connect(appName, {network: 'rinkeby'})
const web3 = connect.getWeb3()


const uport = new Connect('uport-wp-plugin', {
  clientId: '2onpaDYj2R4RaUJGJcWe3AAWoQn5e4kwQzo',
  network: 'rinkeby',
  signer: SimpleSigner('20c2eb928659799c4cf6e25177d0a68f26819774d30d0127d2aaa0beae84b258'),
})

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


$(document).ready(function () {

        // what exactly needs to be done here that depends on JQuery?

        // check to see if we're on the login pages
        if ($('body').hasClass('login') && $('body').hasClass('wp-core-ui') && $('#login').length > 0) {

            // TODO: append the qr code to the login form
            // for the alpha, here we can simply use the uport modal and add a button
            $('#loginform').append('<button class="btn btn-sm btn-primary" id="connectUportBtn" onclick="uportConnect()">Connect uPort</button>');
        }
    });
