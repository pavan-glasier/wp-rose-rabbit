/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
    if( 'undefined' === typeof window){
        importScripts('https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js');
        importScripts('https://www.gstatic.com/firebasejs/8.1.1/firebase-messaging.js');
    }
    /*
    Initialize the Firebase app in the service worker by passing in the messagingSenderId.
    * New configuration for app@pulseservice.com
    */
    // let config = push_notification_ajax_object.push_notification_firebase_config;
    // firebase.initializeApp(config);
    // console.log('config :>> ', config);
    
    firebase.initializeApp({
        apiKey: "AIzaSyAd472CShCMonQPhYd-jVJo_WzOL9Q4yxM",
        authDomain: "push-notification-wordpress.firebaseapp.com",
        projectId: "push-notification-wordpress",
        storageBucket: "push-notification-wordpress.appspot.com",
        messagingSenderId: "164377572488",
        appId: "1:164377572488:web:024c5721eaf6ade0c91b3d",
        measurementId: "G-JEFNW1FP0Y"
    });
    
    /*
    Retrieve an instance of Firebase Messaging so that it can handle background messages.
    */
    const messaging = firebase.messaging();
    messaging.setBackgroundMessageHandler(function(payload) {
        console.log(
            "[firebase-messaging-sw.js] Received background message ",
            payload,
        );
        /* Customize notification here */
        const notificationTitle = "Background Message Title";
        const notificationOptions = {
            body: "Background Message body.",
            icon: "/",
            click_action:"/"
        };
      
        return self.registration.showNotification(
            notificationTitle,
            notificationOptions,
        );
    });
    self.addEventListener('notificationclick', function(event) {
        let url = 'https://example.com/some-path/';
        event.notification.close(); // Android needs explicit close.
        console.log('event :>> ', event);
        console.log('event.reply :>> ', event.target.value);
        event.waitUntil(
            clients.matchAll({type: 'window'}).then( windowClients => {
                console.log('windowClients :>> ', windowClients);
                // Check if there is already a window/tab open with the target URL
                for (var i = 0; i < windowClients.length; i++) {
                    var client = windowClients[i];
                    // If so, just focus it.
                    if (client.url === url && 'focus' in client) {
                        return client.focus();
                    }
                }
                // If not, then open the target URL in a new window/tab.
                // if (clients.openWindow) {
                //     return clients.openWindow(url);
                // }
            })
        );
    });