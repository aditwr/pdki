import "./bootstrap";

// import FilePond
import * as FilePond from "filepond";
import "filepond/dist/filepond.min.css";
// import FilePondPlugin
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";

// import plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";
// register the plugin
FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);
window.FilePond = FilePond;

// SweetAlert2
import Swal from "sweetalert2";
window.Swal = Swal;

// toastify
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
window.Toastify = Toastify;

// Chart.js
import Chart from "chart.js/auto";
window.Chart = Chart;
