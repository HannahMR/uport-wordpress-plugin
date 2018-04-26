# uPort Wordpress Bridge

this submission is simply using the boilerplate code from wppb.me with roadmap.  File structure is sure to change when real coding begins.

### Road Map

- Implement QR code login utilizing external authentication methods
- decide which method of storage for smart contracts
- implement web3 either in php (which would require refactoring of uport code) or utilizing javascript uport libs
- JWT to wordpress database considerations
- QR code generation for confirmation of transactions
- addition of needed admin page/fields for interacting with web3 objects
- possible connector to infura to simplify plugin code 

### Bounty Candidate Project
To create a bridge between Web2.0 and Web3.0 a `uport-wordpress-login` plugin should be made available. But, we need your help community.

The uPort Wordpress Bridge Plugin should provide both passwordless login capabilities for users and easy interaction with an injected Web3 object.

## Acceptance Criteria - Bounty Candidates
The uPort Wordpress Bridge needs to fulfill the following critieria to be considered ready for non-beta testing purposes.

- [ ] Infrastructure - Passwordless Login using uPort Attestations.
- [ ] Feature - Authenticated users can save ERC20 smart contracts to either localstorage or Wordpress database.
- [ ] Decentralized - Use Web3 object to scan smart contracts to check the authenticated identities token balance.

## Technical Information
The uPort Wordpress Bridge should include both "centralized" and "decentralized" features.

#### Infrastructure - Passwordless Login
The authentication system should utilize uPort's attestation features to pass login credentials from the uPort mobile app to the Wordpress Frontend. The login credentials will be passed to Wordpress's default email/password authentication system.

- [ ] Login Attestation Request from uPort Mobile App
- [ ] Request Authentication information and send to default Wordpress Email/Password Authentication
- [ ] Request PushToken from the Decentralied Identity and saved in the Wordpress Database associated with new registered user

##### Future Bounty Candidate
uPort provides a PushToken (via a Firebase infrastructure), which allows applications to send attestation and transaction signing requesting directly to the uPort Mobile Application. This could be used by administrators to request additional information i.e. during an event registration process or during a checkout process at a later time.

If website administrators/developers wanted to utilize the PushToken capabilities it will be important to also create a Wordpress Plugin Dashboard Plugin that allows to manually or programatically interact with a decentralized identity.

#### Feature - Save List of Smart Contracts
The most common use case for the Ethereum Blockchain is ERC20 tokens. MetaMask provides a fantastic Browser Extension so everyone can quickly and easily interact with the Ethereum Blockchain, primarily to purchase ERC20 tokens or interact with CryptoKitties.

uPort imagines a world where tokens will be a common incentive mechanism across a variety of Internet applications. By helping adminstrators and website builders incorporate new decentralized features (like token incentivizes) into existing applications, it will be easier to help a broader audience understand the value of decentralized blockchains.

- [ ] Field To Add ERC20 Token Smart Contract Address
- [ ] Save Item in Wordpress Database or LocalStorage (Requires Discussion)
- [ ] Delete Item in Wordpress Database or LocalStorage (Requires Discussion)

#### Decentralized - ERC20 Token Balances
To highlight the capabilities decentralized application the plugin should include basic features for the currently most popular Ethereum Blockchain feature - ERC20 Tokens. The `uport-connect` Javascript library, which is required as a project dependency, includes a Web3 object, which can easily interact with the Ethereum blockchain using an Infura API endpoint.

To encourage experiments token mechanics uPort's wants to provide simple interface buttons that connect the ERC20 specification i.e `transfer`, `approve` and `transerFrom` to easily embedable interface components. uPort helps facilitate token mechanic experimentation by providing private key management within a smartphone application. Private key management within a smartphone application means users can interact with the Ethereum Blockchain using a variety interfaces (both digital and physical) and not just a local home computer with a Browser extension.

##### Outline
- [ ] Display token balances for the currently logged in decentralized identity.
- [ ] Token Transfer Form - ERC20.abi.transfer
- [ ] Token Transfer From Form - ERC20.abi.transferFrom
- [ ] Token Approve Form - ERC20.abi.approve

When the forms are submitted a transaction signing request should either be sent to the uPort Mobile App (if logged in) or a QR code should be generated and displayed (if NOT logged in), so uPort Mobile App can scan the QR code and confirm the transaction requst. In other words, submitting these forms do not require interacting with the Wordpress database - everything is done using the Ethereum Blockchain.
