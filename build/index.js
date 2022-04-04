/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/scripts/MobileDrop.js":
/*!***********************************!*\
  !*** ./src/scripts/MobileDrop.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
class MobileDrop {
  constructor() {
    this.openButton = document.querySelector(".mobileMenu__icon");
    this.menu = document.querySelector(".menuShow");
    this.events();
  }

  events() {
    this.openButton.addEventListener("click", () => this.openMenu());
  }

  openMenu() {
    this.openButton.classList.toggle("fa-bars");
    this.openButton.classList.toggle("fa-window-close");
    this.menu.classList.toggle("menuShow--active");
  }

}

/* harmony default export */ __webpack_exports__["default"] = (MobileDrop);

/***/ }),

/***/ "./src/scripts/SpoilerBar.js":
/*!***********************************!*\
  !*** ./src/scripts/SpoilerBar.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
class SpoilerBar {
  constructor() {
    this.toggleButton = document.getElementById("toggleSpoiler");
    this.spoilerBar = jQuery(".spoilerBar");
    this.playerDiv = jQuery(".playerDiv");
    this.body = jQuery(".bodyContainer"); //this.spoilerSet = window.localStorage;
    //this.showBar = window.localStorage("spoilerbar");
    //console.log(this.showBar);

    this.events();
  }

  events() {
    this.toggleButton.addEventListener("click", () => this.spoilerToggle());
  }

  spoilerToggle() {
    this.toggleButton.classList.toggle("fa-toggle-off");
    this.toggleButton.classList.toggle("fa-toggle-on");
    this.playerDiv.slideToggle(); // Do an if statement and add padding if it's expanded
    //this.body.css("padding-top: 50px");
  }

}

/* harmony default export */ __webpack_exports__["default"] = (SpoilerBar);

/***/ }),

/***/ "./src/assets/css/main.scss":
/*!**********************************!*\
  !*** ./src/assets/css/main.scss ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _assets_css_main_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./assets/css/main.scss */ "./src/assets/css/main.scss");
/* harmony import */ var _scripts_MobileDrop__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./scripts/MobileDrop */ "./src/scripts/MobileDrop.js");
/* harmony import */ var _scripts_SpoilerBar__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./scripts/SpoilerBar */ "./src/scripts/SpoilerBar.js");
 //import ExampleReactComponent from "./scripts/ExampleReactComponent";

 //import React from "react";
//import ReactDOM from "react-dom";


const mobileDrop = new _scripts_MobileDrop__WEBPACK_IMPORTED_MODULE_1__["default"]();
const spoilerBar = new _scripts_SpoilerBar__WEBPACK_IMPORTED_MODULE_2__["default"]();
console.log("test"); //ReactDOM.render(<ExampleReactComponent />, document.querySelector("#render-react-example-here"));
}();
/******/ })()
;
//# sourceMappingURL=index.js.map