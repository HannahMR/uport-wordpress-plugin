import axios from 'axios'
import Random from 'random-js'


//@flow
/**  @module wp-uport/TopicFactoryDesktop
  *  @description
  *  Manages the communication channel between the uport-connect library and a
  *  uPort mobile app, through a server. uPort offers a
  *  server called chasqui to implement this.
  */

/**
 *  Returns a function enclosed with the necessary settings which creates topics
 *  which are used on desktop as communication channels.
 *
 *  @param    {String}     topicID              UUID
 *  @param    {String}     pollingInterval      the rate at which the messaging server is polled
 *  @return   {Function}
 */
function TopicFactoryDesktop (pollingInterval = 2000) {
  const baseurl = 'https://chasqui.uport.me/api/v1/topic/'
  /**
   *  Polls a given url (messaging server) for given topic response
   *  from the mobile uPort app to the mobile browser.
   *
   *  @param    {String}     topicName     the topic you are waiting for a response
   *  @param    {String}     topicURL      url to poll for a response
   *  @param    {Function}   cb            function which is called with a response or error
   *  @param    {Function}   cancelled     function which returns true if the polling has been cancelled
   */
  function pollForResult (topicName, topicURL, cb, cancelled) {
    let interval = setInterval(
      () => {
        axios({
          method: 'get',
          url: topicURL,
          // json: true, json default response type in axios
          withCredentials: false,
          rejectUnauthorized: false
        }.catch((err, res, body) => {
          if (err) return cb(err)})


        function (err, res, body) {
          if (err) return cb(err)

          if (cancelled()) {
            clearInterval(interval)
            return cb(new Error('Request Cancelled'))
          }

          // parse response into raw account
          const data = body.message
          try {
            if (data.error) {
              clearInterval(interval)
              return cb(data.error)
            }
          } catch (err) {
            console.error(err.stack)
            clearInterval(interval)
            return cb(err)
          }
          // Check for param, stop polling and callback if present
          if (data && data[topicName]) {
            clearInterval(interval)
            clearTopic(topicURL)
            return cb(null, data[topicName])
          }
        })
      }, pollingInterval)
  }

  /**
   *  Clear a topic on the messaging server, typically used to remove data after a response is received
   *
   *  @param    {String}     topicURL           url endpoint which to clear topic
   */
  function clearTopic (topicURL) {
    // should we add a function to remove this from JSONGraph?
    axios({
      method: 'delete',
      url: topicURL,
      withCredentials: false,
      rejectUnauthorized: false
      }).catch(function (error) {
        console.log(error);
    })
  }

  /**
   *  Creates a topic and random url endpoint on the messaging server. Passes this
   *  url in requests to the mobile app. Starts polling for a response from the
   *  mobile app at that url. Returns a promise which resolves a response or rejects
   *  an error (or timeout).
   *  this makes little sense to me, where is the PUT request to create the topic here?
   *
   *  @param    {String}     topicName     the topic you are waiting for a response
   *  @return   {Promise<Object, Error>}   a promise which resolves with a response or rejects with an error.
   */
   function newTopic (topicName) {
     // cleaner to do with axios
     let isCancelled = false
     let topicID = Random.uuid4(Random.engines.mt19937().autoSeed())
     let url = chasquiUrl + topicID

     const topic = new Promise((resolve, reject) => {
       const cb = (error, response) => {
         if (error) return reject(error)
         resolve(response)
       }
         pollForResult(topicName, topicURL, cb, () => isCancelled)
     })
     topic.uri = topicURL
     topic.cancel = () => { isCancelled = true }
     return topic
   }

  return newTopic
}

export default TopicFactoryDesktop
