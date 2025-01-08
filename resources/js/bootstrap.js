import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import jQuery and make it globally available
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// Import Bootstrap
import 'bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle';

// Import AdminLTE
import 'admin-lte';

// Import Bootstrap4 Duallistbox
import 'bootstrap4-duallistbox';

// Import Daterangepicker
import 'daterangepicker';

// Import Inputmask
import 'inputmask';

// Import Select2
import 'select2';
import 'select2/dist/css/select2.css'; // Ensure this matches the path in app.css