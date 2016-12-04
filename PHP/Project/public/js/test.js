$(function() {
  window.pubnub = PUBNUB.init({
      channel: "Notification",
      publish_key: "pub-c-2e3d03f8-d8b4-4ab4-99af-7eb241d7f26c",
      subscribe_key: "sub-c-d7a6417a-b717-11e6-b37b-02ee2ddab7fe"
  });
  pubnub.subscribe({
    channel: "Notification",
    message: increment
  });

  function sendData(msg) {
    pubnub.publish({
        channel: "Notification",
        message: msg
    });
  }
  function increment(msg) {
    for (var i=0; i<window.data.length; i++) {
      var el = window.data[i];
      if (el.name == msg) {
        el.vote += 1;
      }
    }

  }
  

});
