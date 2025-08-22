// Import Firebase scripts (compat version for service workers)
importScripts('https://www.gstatic.com/firebasejs/10.12.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging-compat.js');

// Your Firebase configuration
firebase.initializeApp({
    apiKey: "AIzaSyBLOnKTDW2rbgEY-19q_DyB2Edot2YPNRY",
    authDomain: "login-app-4a65e.firebaseapp.com",
    projectId: "login-app-4a65e",
    storageBucket: "login-app-4a65e.appspot.com",
    messagingSenderId: "444785180257",
    appId: "1:444785180257:web:3e14ff06fe649528483420"
});

// Initialize Firebase Messaging
const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage((payload) => {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification?.title || "New Notification";
    const notificationOptions = {
        body: payload.notification?.body || "You have a new message.",
        icon: payload.notification?.icon || "/firebase-logo.png"
    };

    // Show the notification
    self.registration.showNotification(notificationTitle, notificationOptions);
});
