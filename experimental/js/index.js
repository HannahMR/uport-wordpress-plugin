import TopicFactoryDesktop from './TopicFactoryDesktop.js'


    import { Connect, SimpleSigner } from 'uport-connect'

    const uport = new Connect('uport-wp-plugin', {
      clientId: '2onpaDYj2R4RaUJGJcWe3AAWoQn5e4kwQzo',
      network: 'rinkeby or ropsten or kovan',
      signer: SimpleSigner('20c2eb928659799c4cf6e25177d0a68f26819774d30d0127d2aaa0beae84b258')
    })

    // Request credentials to login
    uport.requestCredentials({
      requested: ['name', 'phone', 'country'],
      notifications: true // We want this if we want to recieve credentials
    })
    .then((credentials) => {
      // Do something
    })

    // Attest specific credentials
    uport.attestCredentials({
      sub: THE_RECEIVING_UPORT_ADDRESS,
      claim: {
        CREDENTIAL_NAME: CREDENTIAL_VALUE
      },
      exp: new Date().getTime() + 30 * 24 * 60 * 60 * 1000, // 30 days from now
    })
