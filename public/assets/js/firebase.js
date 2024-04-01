importScripts('https://www.gstatic.com/firebasejs/10.1.0/firebase-app-compact.js')
importScripts('https://www.gstatic.com/firebasejs/10.1.0/firebase-messaging-compact.js')

 const firebaseConfig = {
    apiKey: "AIzaSyDIGLhy3wSY6WKqX8lqyRS3BKUl0Ks2v-Q",
    authDomain: "reyo-web-notification.firebaseapp.com",
    projectId: "reyo-web-notification",
    storageBucket: "reyo-web-notification.appspot.com",
    messagingSenderId: "112123447542",
    appId: "1:112123447542:web:3008c498176a03f700c4d7",
    measurementId: "G-3Y6BYGYWKL"
  };
  
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
  const messaging = firebase.messaging();
  
  