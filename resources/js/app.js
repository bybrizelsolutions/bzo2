import $ from 'jquery';
window.$ = window.jQuery = $; // ✅ Ensure jQuery is available globally

import 'bootstrap/dist/css/bootstrap.min.css'; // Bootstrap CSS
import 'bootstrap'; // Bootstrap JS

import 'datatables.net-bs5'; // DataTables JS for Bootstrap 5
import 'datatables.net-buttons-bs5'; // Buttons Extension
import 'datatables.net-responsive-bs5'; // Responsive Tables

import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'; // DataTables Bootstrap 5 CSS

// ✅ DataTables Default Settings
$(document).ready(function () {
    console.log("DataTables loaded successfully");
});
