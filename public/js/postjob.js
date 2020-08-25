/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom/postjob.js":
/*!****************************************!*\
  !*** ./resources/js/custom/postjob.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var token = $('meta[name=csrf_token]').attr('content');
  var loader = $('.loader');
  var contents = $('.main-content');
  var posted__jobs = $('#posted__jobs');
  var live__jobs = $('#live__jobs');
  var progress__jobs = $('#progress__jobs');
  var archived__jobs = $('#archived__jobs');

  function queryParams(query) {
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + query;
    return window.history.pushState({
      path: newurl
    }, '', newurl);
  }

  function getQueryParams() {
    var queries = {};
    $.each(document.location.search.substr(1).split('&'), function (c, q) {
      var i = q.split('=');
      queries[i[0].toString()] = i[1].toString();
    });
    return queries.type;
  }

  if (!location.search) {
    queryParams('?type=posted-jobs');
  }

  if (getQueryParams() === 'posted-jobs' || getQueryParams() === 'live-jobs' || getQueryParams() === 'progress-jobs' || getQueryParams() === 'archived-jobs') {
    var params = getQueryParams();

    if (params === 'posted-jobs') {
      contents.addClass('posted__jobs');
      contents.closest('.content__area').addClass('posted_jobs_area');
      contents.removeClass('live__jobs');
      contents.removeClass('progress__jobs');
      contents.removeClass('archived__jobs');
      posted__jobs.addClass('active');
      live__jobs.removeClass('active');
      progress__jobs.removeClass('active');
      archived__jobs.removeClass('active');
      ajax_job('posted_job');
    } else if (params === 'live-jobs') {
      contents.removeClass('posted__jobs');
      contents.closest('.content__area').addClass('live__jobs_area');
      contents.addClass('live__jobs');
      contents.removeClass('progress__jobs');
      contents.removeClass('archived__jobs');
      posted__jobs.removeClass('active');
      live__jobs.addClass('active');
      progress__jobs.removeClass('active');
      archived__jobs.removeClass('active');
      ajax_job('job_status_show', 'Live');
    } else if (params === 'progress-jobs') {
      contents.removeClass('posted__jobs');
      contents.closest('.content__area').addClass('progress__jobs_area');
      contents.removeClass('live__jobs');
      contents.addClass('progress__jobs');
      contents.removeClass('archived__jobs');
      posted__jobs.removeClass('active');
      live__jobs.removeClass('active');
      progress__jobs.addClass('active');
      archived__jobs.removeClass('active');
      ajax_job('job_status_show', 'In-progress');
    } else if (params === 'archived-jobs') {
      contents.removeClass('posted__jobs');
      contents.closest('.content__area').addClass('archived__jobs_area');
      contents.removeClass('live__jobs');
      contents.removeClass('progress__jobs');
      contents.addClass('archived__jobs');
      posted__jobs.removeClass('active');
      live__jobs.removeClass('active');
      progress__jobs.removeClass('active');
      archived__jobs.addClass('active');
      ajax_job('job_status_show', 'Archived');
    }
  } else {
    contents.empty();
    contents.append('<div class="d-flex justify-content-center"> <p class="mt-4"><span class="alert alert-danger">404 Sorry!! Page not found !!</span></p> </div>');
  }

  posted__jobs.on('click', function () {
    if (!$(this).hasClass('active')) {
      contents.empty();
      loader.empty();
      contents.addClass('posted__jobs');
      contents.closest('.content__area').addClass('posted_jobs_area');
      contents.removeClass('live__jobs');
      contents.removeClass('progress__jobs');
      contents.removeClass('archived__jobs');
      posted__jobs.addClass('active');
      live__jobs.removeClass('active');
      progress__jobs.removeClass('active');
      archived__jobs.removeClass('active');
      queryParams('?type=posted-jobs');
      ajax_job('posted_job');
    }
  });
  live__jobs.on('click', function () {
    if (!$(this).hasClass('active')) {
      contents.empty();
      loader.empty();
      contents.removeClass('posted__jobs');
      contents.closest('.content__area').addClass('live__jobs_area');
      contents.addClass('live__jobs');
      contents.removeClass('progress__jobs');
      contents.removeClass('archived__jobs');
      posted__jobs.removeClass('active');
      live__jobs.addClass('active');
      progress__jobs.removeClass('active');
      archived__jobs.removeClass('active');
      queryParams('?type=live-jobs');
      ajax_job('job_status_show', 'Live');
    }
  });
  progress__jobs.on('click', function () {
    if (!$(this).hasClass('active')) {
      contents.empty();
      loader.empty();
      contents.removeClass('posted__jobs');
      contents.closest('.content__area').addClass('progress__jobs_area');
      contents.removeClass('live__jobs');
      contents.addClass('progress__jobs');
      contents.removeClass('archived__jobs');
      posted__jobs.removeClass('active');
      live__jobs.removeClass('active');
      progress__jobs.addClass('active');
      archived__jobs.removeClass('active');
      queryParams('?type=progress-jobs');
      ajax_job('job_status_show', 'In-progress');
    }
  });
  archived__jobs.on('click', function () {
    if (!$(this).hasClass('archived__jobs')) {
      contents.empty();
      loader.empty();
      contents.removeClass('posted__jobs');
      contents.closest('.content__area').addClass('archived__jobs_area');
      contents.removeClass('live__jobs');
      contents.removeClass('progress__jobs');
      contents.addClass('archived__jobs');
      posted__jobs.removeClass('active');
      live__jobs.removeClass('active');
      progress__jobs.removeClass('active');
      archived__jobs.addClass('active');
      queryParams('?type=archived-jobs');
      ajax_job('job_status_show', 'Archived');
    }
  });

  function ajax_job(method) {
    var status = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    var id = $('.content__area').attr('data-team');
    $.ajax({
      url: ajax_url,
      beforeSend: function beforeSend() {
        contents.empty();
        $('<div class="w-100 mt-lg-5 mt-2 loading"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>').appendTo(loader);
      },
      data: {
        action: method,
        status: status,
        id: id,
        _token: token
      },
      dataType: 'JSON',
      type: 'POST',
      async: false,
      success: function success(res) {
        if (res.status === 'success') {
          contents.append(res.html);
          $("#dataTable").dataTable();
        }
      },
      complete: function complete() {
        loader.empty();
      }
    });
  }
});

/***/ }),

/***/ 1:
/*!**********************************************!*\
  !*** multi ./resources/js/custom/postjob.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\XAMPP\htdocs\hiregalaxy\resources\js\custom\postjob.js */"./resources/js/custom/postjob.js");


/***/ })

/******/ });