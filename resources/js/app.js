import "./bootstrap";

import Alpine from "alpinejs";

import Chart from "chart.js/auto";

import {
    Html5QrcodeScanner,
    Html5QrcodeSupportedFormats,
    Html5QrcodeScanType,
} from "html5-qrcode";

window.Alpine = Alpine;

window.Chart = Chart;

window.Html5QrcodeScanner = Html5QrcodeScanner;

window.Html5QrcodeSupportedFormats = Html5QrcodeSupportedFormats;

window.Html5QrcodeScanType = Html5QrcodeScanType;

Alpine.start();
