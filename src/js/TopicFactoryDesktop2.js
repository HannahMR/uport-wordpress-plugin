//@flow
import axios from 'axios'
import Random from 'random-js'
import AsyncPolling from 'async-polling'

/**  @module wp-uport/TopicFactoryDesktop
  *  @description
  *  Manages the communication channel between the uport-wordpress-plugin and a
  *  uPort mobile app, through a server. uPort offers a
  *  server called chasqui to implement this.
  */

function TopicFactoryDesktop (pollingInterval = 2000) {
  const baseURL = 'https://chasqui.uport.me/api/v1/topic/'


   function newTopic (baseURL) {
     let topicID = Random.uuid4(Random.engines.mt19937().autoSeed());
     console.log(topicID);
     return axios.get("/" + topicID); //axios adds baseURL

     // const topic = axios.get(topicID)
     // .then(function (response) {
     //   console.log(response);
     //   return response.data // this should return a JSON object
     // })
     // .catch(console.log(error))
     }
   function clearTopic (topicURL, baseURL) {
     axios.delete(topicURL)
       .then(console.log("Topic Deleted"))
       .catch(function (error) {console.log(error)})
       }

    var topic = AsyncPolling(function (end) {
    // here we are polling chasqui for the return message
    return newTopic;
    
    // Here I want to stop the polling:
    this.stop();
    end();
    }, 2000).run();

    topic.data
    topic.response

  }

export default TopicFactoryDesktop
