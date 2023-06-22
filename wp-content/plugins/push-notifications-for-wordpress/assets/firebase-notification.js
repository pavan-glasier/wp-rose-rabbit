document.addEventListener('DOMContentLoaded', function(){
let site_url = push_notification_ajax_object.site_url;
let ajax_url = push_notification_ajax_object.ajax_url;
let firebase_config = push_notification_ajax_object.config;
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register(`${site_url}/assets/firebase-messaging-sw.js`)
        .then((registration) => {
            console.log('registration :>> ', registration);
            messaging.useServiceWorker(registration);
            if ('pushManager' in registration) {
                console.log("The service worker supports push");
            } else {
                console.log("The service worker doesn't support push");
            }
        }).catch(function(err) {
            console.log('error' + err);
        });
} else {
    console.log("The browser doesn't support service workers");
}

firebase.initializeApp(firebase_config);
// firebase.initializeApp({
//     apiKey: "AIzaSyAd472CShCMonQPhYd-jVJo_WzOL9Q4yxM",
//         authDomain: "push-notification-wordpress.firebaseapp.com",
//         projectId: "push-notification-wordpress",
//         storageBucket: "push-notification-wordpress.appspot.com",
//         messagingSenderId: "164377572488",
//         appId: "1:164377572488:web:024c5721eaf6ade0c91b3d",
//         measurementId: "G-JEFNW1FP0Y"
// });
if (firebase.messaging.isSupported()) {
    messaging = firebase.messaging();
    function initFirebaseMessagingRegistration() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
                jQuery.ajax({
                    type : "post",
                    url : ajax_url,
                    data : {action: "save_device_token", device_token: token},
                    beforeSend: function() {
                        console.log('beforeSend :>> ');
                    },
                    success : function(data){
                    //    var obj = jQuery.parseJSON(data);
                      console.log('data :>> ', data);
                    },
                    complete: function() {
                        console.log('complete :>> ');
                    },
                });
            }).catch(function(err) {
                console.log('User Chat Token Error' + err);
            });
    }
    setTimeout(() => {
        initFirebaseMessagingRegistration();
		// console.log("messaging---->", messaging);
		// console.log("swRegistration---->", messaging.swRegistration);
    }, 300);

    messaging.onMessage(function(payload) {
		console.log("-=--", payload);
        // window.location.reload(); for reload page
        const notificationTitle = payload.notification.title;
        const notificationOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
            click_action: payload.notification.click_action,
			actions: [
                {
                    action: 'yes',
                    // icon: 'http://192.168.0.128/rose_and_rabbit/wp-content/uploads/2023/06/card-accepted.png',
                    type: 'button',
                    title: '👍',
                },
                {
                    action: 'submit',
                    type: 'text',
                    // icon: 'https://www.highenfintech.com/wp-content/uploads/2021/10/cropped-favicon-192x192.png',
                    title: '👎',
                    placeholder: 'Type here',
                },
            ],
        };
        console.log(payload.notification.click_action);
		messaging.swRegistration.showNotification(notificationTitle, notificationOptions)
        .then((res) => {
            console.log('res :>> ', res);
        }).catch(function(err) {
            console.log('error' + err);
        });
    });
} else {
    console.log("The browser doesn't support firebase messging");
}
// end firebase notification
});