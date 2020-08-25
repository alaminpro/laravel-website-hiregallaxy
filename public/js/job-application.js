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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom/job-application.js":
/*!************************************************!*\
  !*** ./resources/js/custom/job-application.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var token = $('meta[name=csrf_token]').attr('content');
  var loader = $('.loader');
  var contents = $('.main-content');
  var all_activity = $('#all_activity');
  var new_activity = $('#new_activity');
  var short_listed_activity = $('#short_listed_activity');
  var interview_activity = $('#interview_activity');
  var offered_activity = $('#offered_activity');
  var hired_activity = $('#hired_activity');
  var rejected_activity = $('#rejected_activity');

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
    queryParams('?type=all');
  }

  if (getQueryParams() === 'all' || getQueryParams() === 'new' || getQueryParams() === 'shortlisted' || getQueryParams() === 'interview' || getQueryParams() === 'offered' || getQueryParams() === 'hired' || getQueryParams() === 'rejected') {
    var params = getQueryParams();

    if (params === 'all') {
      contents.addClass('all_activity');
      contents.closest('.content__area').addClass('all');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.addClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      ajax_job('all_activity');
    } else if (params === 'new') {
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('new');
      contents.addClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.addClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      ajax_job('job_activity', 'New');
    } else if (params === 'shortlisted') {
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('shortlisted');
      contents.removeClass('new_activity');
      contents.addClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.addClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      ajax_job('job_activity', 'Shortlisted');
    } else if (params === 'interview') {
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('interview');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.addClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.addClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      ajax_job('job_activity', 'Interview');
    } else if (params === 'offered') {
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('offered');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.addClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.addClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      ajax_job('job_activity', 'Offered');
    } else if (params === 'hired') {
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('hired');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.addClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.addClass('active');
      rejected_activity.removeClass('active');
      ajax_job('job_activity', 'Hired');
    } else if (params === 'rejected') {
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('rejected');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.addClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.addClass('active');
      ajax_job('job_activity', 'Rejected');
    }
  } else {
    contents.empty();
    contents.append('<div class="d-flex justify-content-center"> <p class="mt-4"><span class="alert alert-danger">404 Sorry!! Page not found !!</span></p> </div>');
  }

  all_activity.on('click', function () {
    if (!$(this).hasClass('active')) {
      contents.empty();
      loader.empty();
      contents.addClass('all_activity');
      contents.closest('.content__area').addClass('all');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.addClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      queryParams('?type=all');
      ajax_job('all_activity');
    }
  });
  new_activity.on('click', function () {
    if (!$(this).hasClass('active')) {
      contents.empty();
      loader.empty();
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('new');
      contents.addClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.addClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      queryParams('?type=new');
      ajax_job('job_activity', 'New');
    }
  });
  short_listed_activity.on('click', function () {
    if (!$(this).hasClass('active')) {
      contents.empty();
      loader.empty();
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('shortlisted');
      contents.removeClass('new_activity');
      contents.addClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.addClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      queryParams('?type=shortlisted');
      ajax_job('job_activity', 'Shortlisted');
    }
  });
  interview_activity.on('click', function () {
    if (!$(this).hasClass('archived__jobs')) {
      contents.empty();
      loader.empty();
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('interview');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.addClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.addClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      queryParams('?type=interview');
      ajax_job('job_activity', 'Interview');
    }
  });
  offered_activity.on('click', function () {
    if (!$(this).hasClass('archived__jobs')) {
      contents.empty();
      loader.empty();
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('offered');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.addClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.addClass('active');
      hired_activity.removeClass('active');
      rejected_activity.removeClass('active');
      ajax_job('job_activity', 'Offered');
      queryParams('?type=offered');
    }
  });
  hired_activity.on('click', function () {
    if (!$(this).hasClass('archived__jobs')) {
      contents.empty();
      loader.empty();
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('hired');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.addClass('hired_activity');
      contents.removeClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.addClass('active');
      rejected_activity.removeClass('active');
      queryParams('?type=hired');
      ajax_job('job_activity', 'Hired');
    }
  });
  rejected_activity.on('click', function () {
    if (!$(this).hasClass('archived__jobs')) {
      contents.empty();
      loader.empty();
      contents.removeClass('all_activity');
      contents.closest('.content__area').addClass('rejected');
      contents.removeClass('new_activity');
      contents.removeClass('short_listed_activity');
      contents.removeClass('interview_activity');
      contents.removeClass('offered_activity');
      contents.removeClass('hired_activity');
      contents.addClass('rejected_activity');
      all_activity.removeClass('active');
      new_activity.removeClass('active');
      short_listed_activity.removeClass('active');
      interview_activity.removeClass('active');
      offered_activity.removeClass('active');
      hired_activity.removeClass('active');
      rejected_activity.addClass('active');
      queryParams('?type=rejected');
      ajax_job('job_activity', 'Rejected');
    }
  });

  function ajax_job(method) {
    var status = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    var slug = $('.content__area').attr('data-slug');
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
        slug: slug,
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

/***/ 2:
/*!******************************************************!*\
  !*** multi ./resources/js/custom/job-application.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\XAMPP\htdocs\hiregalaxy\resources\js\custom\job-application.js */"./resources/js/custom/job-application.js");


/***/ })

/******/ });