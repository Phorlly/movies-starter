import axios from 'axios';
// import Alpine from 'alpinejs';
// import InfiniteScroll from 'infinite-scroll';

// Attach libraries to the window object
window.axios = axios;
// window.Alpine = Alpine;
// window.InfiniteScroll = InfiniteScroll;

// Start Alpine.js
// Alpine.start();

// Set Axios headers
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
