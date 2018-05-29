//@flow
// import {Connect, ConnectCore, QRUtil, SimpleSigner, Credentials, MNID} from 'uport-connect'
// import Web3 from 'web3'
import Connect from 'uport-connect'
// const Connect = window.uportconnect.Connect;
// d'application registry infos
const connect = new Connect('uport-wp-plugin', {
  // clientId: '2onpaDYj2R4RaUJGJcWe3AAWoQn5e4kwQzo',
  network: 'rinkeby'
})
const web3 = uport.getWeb3() // uport-core method . . . not sure why the tutorial includes web3


// Setup the simple Status contract - allows you to set and read a status string
// later we will parse other info

// const abi = [{
//   "constant":false,
//   "inputs":[{
//     "name":"status",
//     "type":"string"
//   }],
//     "name":"updateStatus",
//     "outputs":[],
//     "payable":false,"type":"function"
//   },{
//       "constant":false,
//       "inputs":[{
//         "name":"addr",
//         "type":"address"
//       }],
//         "name":"getStatus",
//         "outputs":[{
//           "name":"",
//           "type":"string"
//         }],
//         "payable":false,
//         "type":"function"
//       }]

const StatusContract = web3.eth.contract(abi);
const statusInstance = StatusContract.at('0x70A804cCE17149deB6030039798701a38667ca3B');

      // State and render functions
      //  exemplifies  how to set up state and render functions

      // const $ = (selector) => document.querySelector(selector)
      // let globalState = {
      //   uportId: "",
      //   ethAddress: "",
      //   ethBalance: "",
      //   currentStatus: "",
      //   statusInput: "",
      //   txHashSentEth: "",
      //   txHashSetStatus: "",
      //   sendToAddr: "",
      //   sendToVal: ""
      // };
      //
      // const render = function () {
      //   $('#uportId').innerHTML = globalState.uportId;
      //   $('#ethAddress').innerHTML = globalState.ethAddress;
      //   $('#ethBalance').innerHTML = globalState.ethBalance;
      //   $('#txHashSentEth').innerHTML = globalState.txHashSentEth;
      //   $('#txHashSetStatus').innerHTML = globalState.txHashSetStatus;
      //   $('#sendTo').value = globalState.sendToAddr;
      //   $('#amount').value = globalState.sendToVal;
      //   $('#currentStatus').innerHTML = globalState.currentStatus;
      // };
      //
      // const updateState = function () {
      //   globalState.sendToAddr = $('#sendTo').value;
      //   globalState.sendToVal = $('#amount').value;
      //   globalState.statusInput = $('#statusInput').value;
      //   console.log(globalState)
      // };

      ////////////////////////////////////////////////


      ////////////////////////////////////////////////


function ready() {
  // uPort connect
  const uportConnect = function() {
    connect.requestCredentials().then((credentials) => {
      console.log(credentials)
    })
  }
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

// window.uportConnect = uportConnect
global.ready = ready
