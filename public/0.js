(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./resources/js/partials/navbar_scroll.js":
/*!************************************************!*\
  !*** ./resources/js/partials/navbar_scroll.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var _this = this;

/* var navbar = document.getElementById('top_nav'); // Identify target
console.log(navbar);
    */
var height = document.documentElement.clientHeight * 0.96;

window.onscroll = function () {
  var nav = document.querySelector('#top_nav');
  if (_this.scrollY <= 55) nav.className = 'navbar navbar-expand-md navbar-light shadow-sm fixed-top';else nav.className = 'nav_colored navbar navbar-expand-md navbar-light shadow-sm fixed-top';
};

/***/ })

}]);