# uPort Wordpress Bridge
### Bounty Candidate Project
To create a bridge between Web2.0 and Web3.0 a `uport-wordpress-login` plugin should be made available. But, we need your help community.

The uPort Wordpress Bridge Plugin should provide both passwordless login capabilities for users and easy interaction with an injected Web3 object.

## Acceptance Criteria - Bounty Candidates
The uPort Wordpress Bridge needs to fulful the following critieria to be considered ready for non-beta testing purposes.

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

If you're unfamiliar with the ERC20 token specification please reference the following materials

- https://github.com/ConsenSys/Tokens/tree/master/contracts/eip20
- https://theethereum.wiki/w/index.php/ERC20_Token_Standard
- https://medium.com/@jgm.orinoco/understanding-erc-20-token-contracts-a809a7310aa5

## User Story

#### User
As a user I want to maintain data privacy by storing my personal data on my smartphone. Releasing my personal information to the world only when it is absolutely required. As a default I would like to maintain self-sovereignty and ownership of my data by default. Instead of trusting companies to manage my data, I would instead like to provide cryptographically verified attestations i.e. private data to websites which include guarantees for single-time use.

#### Developer
As a developer I want to test new decentralized applications solutions quickly and easily. Since Wordpress is the world's popular Open Source Content Management, it would be great if I could easily add uPort's single sign-on capabilities and web3 object with a single plugin, which integrated with Wordpress Authentication System and allowed users to sign Ethereum Blockchain Transactions directly from their smartphones or a similar interface.

For example, in the near future it should be possible to easily embed decentralized event regisration and buyer rewards programs, without requiring paying monthly subscriptions. Thanks to the Ethereum Blockchain (and other decentralized technologies) features that once required centralized organizations/companies to build and maintain can simply become the fabric of the Internet. Open Source Smart Contracts will be readily available for developers easily embed on any website, which will handle a number of currently centralized services. 

## Background
uPort wants to provide simple tools for new developers to experiment and tinker with decentralized applications. Decentralized solutions like event registration, loyalty rewards programs, and other Internet enhanced protocols. However, instead of relying on centralized applications to provide the code (if/else/loops/arrays) and systems maintenance (servers, database, network) for common features of the Internet we all know and love today, these day-to-day solutions be transformed into public utilities - lowering the cost for users, whether that's direct (payment) or indirect (personal information).

To help users get accustomed to using decentralized technologies, like the Ethereum blockchain, uPort would like to help build the simple use-cases and ready-to-go examples, so developers, website administrators and everyday people buidling websites using Wordpress, can use decentralized solutions as easily as their able to deploy the Wordpress CMS i.e. in a couple of clicks.