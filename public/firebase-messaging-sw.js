// ✅ CDN se Firebase SDK load karo
importScripts("https://www.gstatic.com/firebasejs/10.12.0/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging-compat.js");

// ✅ Config sahi likho
const firebaseConfig = {
    apiKey: "AIzaSyD_zZ4AcUMmXr3K86dHhdo6LeacNdgk7W4",
  authDomain: "staysphere-6a0b7.firebaseapp.com",
  projectId: "staysphere-6a0b7",
  storageBucket: "staysphere-6a0b7.firebasestorage.app",
  messagingSenderId: "863989000171",
  appId: "1:863989000171:web:1f53a2a1d879c43c551bae",
  measurementId: "G-Z1JJT7C6CY"
};

// ✅ Initialize Firebase inside SW
firebase.initializeApp(firebaseConfig);

// ✅ Messaging instance banao
const messaging = firebase.messaging();

// ✅ Background messages handle karo
messaging.onBackgroundMessage((payload) => {
  console.log("📩 Received background message ", payload);

  const notificationTitle = payload.notification?.title || payload.data?.title || "Notification";
  const notificationOptions = {
    body: payload.notification?.body || payload.data?.body || "",
    icon: "/build/assets/images/SSlogo9.png" // apna icon
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
