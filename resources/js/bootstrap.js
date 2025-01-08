import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import "admin-lte/plugins/jquery/jquery"
import $ from "admin-lte/plugins/jquery/jquery";
window.$ = $;  // Make $ available globally
window.jQuery = $;
import "admin-lte/plugins/bootstrap/js/bootstrap.bundle"
import "admin-lte/dist/js/adminlte"
import "admin-lte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox"
import "admin-lte/plugins/daterangepicker/daterangepicker";
import "admin-lte/plugins/inputmask/jquery.inputmask";
import "admin-lte/plugins/select2/js/select2.full";
import 'admin-lte/plugins/select2/css/select2.css';






