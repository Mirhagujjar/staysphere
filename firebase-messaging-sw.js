  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
  import {
    getMessaging,
    getToken
  } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging.js";
  
  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyD_zZ4AcUMmXr3K86dHhdo6LeacNdgk7W4",
    authDomain: "staysphere-6a0b7.firebaseapp.com",
    projectId: "staysphere-6a0b7",
    storageBucket: "staysphere-6a0b7.firebasestorage.app",
    messagingSenderId: "863989000171",
    appId: "1:863989000171:web:1f53a2a1d879c43c551bae",
    measurementId: "G-Z1JJT7C6CY"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const messaging = getMessaging(app);

