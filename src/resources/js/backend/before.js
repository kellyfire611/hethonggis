/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Loaded before CoreUI app.js
import '../bootstrap';
import 'pace';
//import '@ckeditor/ckeditor5-build-classic/build/ckeditor.js';
//import '@ckeditor/ckeditor5-build-classic';
// Core - these two are required :-)
// import 'tinymce/tinymce';
// import 'tinymce/themes/silver/theme';

// // Plugins
// import 'tinymce/plugins/paste/plugin';
// import 'tinymce/plugins/link/plugin';
// import 'tinymce/plugins/autoresize/plugin';

import Quill from 'quill';
window.Quill = Quill;

/* bootstrap-fileinput plugin
*/
import 'bootstrap-fileinput';
import 'bootstrap-fileinput/themes/fas/theme';
import 'bootstrap-fileinput/themes/explorer-fas/theme';

import 'bootstrap-star-rating/js/star-rating';
import 'bootstrap-star-rating/js/locales/vi';
import 'bootstrap-star-rating/themes/krajee-svg/theme';

/* cleaver.js plugin
*/
import 'cleave.js';
import 'cleave.js/dist/addons/cleave-phone.vn';

import '../plugins';
