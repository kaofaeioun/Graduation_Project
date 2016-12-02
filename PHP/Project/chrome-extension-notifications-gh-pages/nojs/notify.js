(function(){

    // -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Initialize PubNub Broadcast Receiver
    // -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    PUBNUB(PUBNUB.setup).subscribe({
        channel : PUBNUB.setup.channel,
        message : receiver
    });

    // -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Receiver of Remote Broadcast Events
    // -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    function receiver(message) {
        chrome.notifications.create("my_noti", message, function(notificationId) {
            setTimeout(function() {
                chrome.notifications.clear(notificationId, function(wasCleared) {
                    console.log(wasCleared);
                });
            }, 2000);
        });
    }

    // -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // User Clicked on a Button inside the Desktop Notification
    // -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // chrome.notifications.onButtonClicked.addListener(function(notificationId, buttonIndex){
    //     console.log("whatever you want here!")
    // });
})();
