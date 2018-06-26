//@flow
import { Connect, SimpleSigner } from 'uport-connect'
import Web3 from 'web3'

// const Connect = window.uportconnect.Connect
const appName = 'uport-wp-plugin'
const uport = new Connect(appName, {
  clientId: '2onpaDYj2R4RaUJGJcWe3AAWoQn5e4kwQzo',
  network: 'rinkeby',
  signer: SimpleSigner('20c2eb928659799c4cf6e25177d0a68f26819774d30d0127d2aaa0beae84b258'),
})
const web3 = uport.getWeb3()

// Setup the simple Status contract - allows you to set and read a status string

const abi = [{
  "constant":false,
  "inputs":[{
    "name":"status",
    "type":"string"
  }],
    "name":"updateStatus",
    "outputs":[],
    "payable":false,"type":"function"
  },{
      "constant":false,
      "inputs":[{
        "name":"addr",
        "type":"address"
      }],
        "name":"getStatus",
        "outputs":[{
          "name":"",
          "type":"string"
        }],
        "payable":false,
        "type":"function"
      }]

const StatusContract = web3.eth.contract(abi);
const statusInstance = StatusContract.at('0x70A804cCE17149deB6030039798701a38667ca3B')

// uPort connect
const uportConnect = function() {
  console.log("clicked")
  web3.eth.getCoinbase((error, address) => {
    if (error) { throw error }
    globalState.ethAddress = address
    console.log("address")

    // This one is for display purposes - MNID encoding includes network
    globalState.uportId = uport.MNID.encode({network: '0x4', address: address})
    statusInstance.getStatus.call(globalState.ethAddress, (err, st) => {
      globalState.currentStatus = st
      web3.eth.getBalance(globalState.ethAddress, (err, bal) => {
        globalState.ethBalance = web3.fromWei(bal)
        render()
      })
    })
  })
}

function ready(uportConnect) {
  var injectButton = function(uportConnect) {
    const loginForm = document.getElementById('loginform')
    const buttondata = '<div class="button buttom-primary button-large" id="connectUportBtn" style="float: left" onclick="window.uportConnect">Connect uPort</div>'
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

// ready.onclick = uportConnect();
window.uportConnect = uportConnect
global.ready = ready

ready()

// TODO: improve this schema using HTML5 methods
const $ = (selector) => document.querySelector(selector)
      let globalState = {
        uportId: "",
        ethAddress: "",
        ethBalance: "",
        currentStatus: "",
        statusInput: "",
        txHashSentEth: "",
        txHashSetStatus: "",
        sendToAddr: "",
        sendToVal: ""
      }

      const render = function () {
        $('#uportId').innerHTML = globalState.uportId;
        $('#ethAddress').innerHTML = globalState.ethAddress;
        $('#ethBalance').innerHTML = globalState.ethBalance;
        $('#txHashSentEth').innerHTML = globalState.txHashSentEth;
        $('#txHashSetStatus').innerHTML = globalState.txHashSetStatus;
        $('#sendTo').value = globalState.sendToAddr;
        $('#amount').value = globalState.sendToVal;
        $('#currentStatus').innerHTML = globalState.currentStatus;
      }

      const updateState = function () {
        globalState.sendToAddr = $('#sendTo').value;
        globalState.sendToVal = $('#amount').value;
        globalState.statusInput = $('#statusInput').value;
        console.log(globalState)
      }
// module.exports = uportConnect;
