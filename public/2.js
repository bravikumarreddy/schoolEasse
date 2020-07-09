(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./resources/assets/js/components/Multiple/Components/Loader.js":
/*!**********************************************************************!*\
  !*** ./resources/assets/js/components/Multiple/Components/Loader.js ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);


function Loader() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex justify-content-center"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "spinner-border   m-5",
    role: "status",
    style: {
      width: "3rem",
      height: "3rem"
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "sr-only"
  }, "Loading...")));
}

/* harmony default export */ __webpack_exports__["default"] = (Loader);

/***/ }),

/***/ "./resources/assets/js/components/Multiple/Exam.js":
/*!*********************************************************!*\
  !*** ./resources/assets/js/components/Multiple/Exam.js ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _Components_Loader__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Components/Loader */ "./resources/assets/js/components/Multiple/Components/Loader.js");


function _typeof(obj) {
  "@babel/helpers - typeof";

  if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
    _typeof = function _typeof(obj) {
      return typeof obj;
    };
  } else {
    _typeof = function _typeof(obj) {
      return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    };
  }

  return _typeof(obj);
}

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
  try {
    var info = gen[key](arg);
    var value = info.value;
  } catch (error) {
    reject(error);
    return;
  }

  if (info.done) {
    resolve(value);
  } else {
    Promise.resolve(value).then(_next, _throw);
  }
}

function _asyncToGenerator(fn) {
  return function () {
    var self = this,
        args = arguments;
    return new Promise(function (resolve, reject) {
      var gen = fn.apply(self, args);

      function _next(value) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
      }

      function _throw(err) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
      }

      _next(undefined);
    });
  };
}

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function");
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      writable: true,
      configurable: true
    }
  });
  if (superClass) _setPrototypeOf(subClass, superClass);
}

function _setPrototypeOf(o, p) {
  _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };

  return _setPrototypeOf(o, p);
}

function _createSuper(Derived) {
  var hasNativeReflectConstruct = _isNativeReflectConstruct();

  return function _createSuperInternal() {
    var Super = _getPrototypeOf(Derived),
        result;

    if (hasNativeReflectConstruct) {
      var NewTarget = _getPrototypeOf(this).constructor;

      result = Reflect.construct(Super, arguments, NewTarget);
    } else {
      result = Super.apply(this, arguments);
    }

    return _possibleConstructorReturn(this, result);
  };
}

function _possibleConstructorReturn(self, call) {
  if (call && (_typeof(call) === "object" || typeof call === "function")) {
    return call;
  }

  return _assertThisInitialized(self);
}

function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

function _isNativeReflectConstruct() {
  if (typeof Reflect === "undefined" || !Reflect.construct) return false;
  if (Reflect.construct.sham) return false;
  if (typeof Proxy === "function") return true;

  try {
    Date.prototype.toString.call(Reflect.construct(Date, [], function () {}));
    return true;
  } catch (e) {
    return false;
  }
}

function _getPrototypeOf(o) {
  _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
    return o.__proto__ || Object.getPrototypeOf(o);
  };
  return _getPrototypeOf(o);
}





var Exam = /*#__PURE__*/function (_React$Component) {
  _inherits(Exam, _React$Component);

  var _super = _createSuper(Exam);

  function Exam(props) {
    var _this;

    _classCallCheck(this, Exam);

    _this = _super.call(this, props);
    _this.state = {
      classes: "",
      "class": "",
      classLoading: false,
      className: "",
      classExams: [],
      createExamName: ""
    };
    _this.getClasses = _this.getClasses.bind(_assertThisInitialized(_this));
    _this.getExams = _this.getExams.bind(_assertThisInitialized(_this));
    _this.deleteExam = _this.deleteExam.bind(_assertThisInitialized(_this));
    _this.createExam = _this.createExam.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(Exam, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      this.getClasses();
    }
  }, {
    key: "getClasses",
    value: function () {
      var _getClasses = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return axios__WEBPACK_IMPORTED_MODULE_2___default.a.get("/api/classes");

              case 2:
                res = _context.sent;
                console.log(res.data);
                this.setState({
                  classes: res.data
                });

              case 5:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function getClasses() {
        return _getClasses.apply(this, arguments);
      }

      return getClasses;
    }()
  }, {
    key: "getExams",
    value: function () {
      var _getExams = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(class_id, className) {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                this.setState({
                  className: className,
                  classLoading: true
                });
                _context2.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_2___default.a.get("/api/class_exams", {
                  params: {
                    class_id: class_id
                  }
                });

              case 3:
                res = _context2.sent;
                console.log(res.data);
                this.setState({
                  "class": class_id,
                  classExams: res.data,
                  classLoading: false
                });

              case 6:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, this);
      }));

      function getExams(_x, _x2) {
        return _getExams.apply(this, arguments);
      }

      return getExams;
    }()
  }, {
    key: "deleteExam",
    value: function () {
      var _deleteExam = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(exam_id) {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                this.setState({
                  classLoading: true
                });
                _context3.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_2___default.a.get("/api/class_exams/delete", {
                  params: {
                    class_id: this.state["class"],
                    exam_id: exam_id
                  }
                });

              case 3:
                res = _context3.sent;
                console.log(res.data);
                this.setState({
                  classExams: res.data,
                  classLoading: false
                });

              case 6:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3, this);
      }));

      function deleteExam(_x3) {
        return _deleteExam.apply(this, arguments);
      }

      return deleteExam;
    }()
  }, {
    key: "createExam",
    value: function () {
      var _createExam = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4() {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                this.setState({
                  classLoading: true
                });
                _context4.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_2___default.a.get("/api/class_exams/create", {
                  params: {
                    class_id: this.state["class"],
                    exam_name: this.state.createExamName
                  }
                });

              case 3:
                res = _context4.sent;
                console.log(res.data);
                this.setState({
                  classExams: res.data,
                  classLoading: false
                });

              case 6:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4, this);
      }));

      function createExam() {
        return _createExam.apply(this, arguments);
      }

      return createExam;
    }()
  }, {
    key: "render",
    value: function render() {
      var _this2 = this;

      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, this.state.classes ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-info mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-info"
      }, "Select Class"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group row"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-md-4 "
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "fee_structure",
        className: "col-form-label"
      }, "Select Class"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("select", {
        value: this.state["class"],
        id: "fee_structure",
        className: "form-control custom-select",
        name: "fee_structure",
        onChange: function onChange(event) {
          _this2.getExams(event.target.value, event.target.options[event.target.options.selectedIndex].text);
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: ""
      }, "Class"), this.state.classes.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
          key: val.id,
          value: val.id
        }, val.class_number);
      })))))) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Components_Loader__WEBPACK_IMPORTED_MODULE_3__["default"], null), this.state.classLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Components_Loader__WEBPACK_IMPORTED_MODULE_3__["default"], null) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, this.state["class"] ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-orange mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-orange"
      }, "Class ", this.state.className, " - Exams"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("ul", {
        className: "list-group col-6"
      }, this.state.classExams.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("li", {
          key: val.id,
          className: "list-group-item d-flex justify-content-between align-items-center "
        }, val.exam_name, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          className: "btn btn-sm btn-danger ml-2",
          onClick: function onClick() {
            _this2.deleteExam(val.id);
          }
        }, "Delete"));
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-5 p-0 mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("form", {
        className: "form-inline ",
        onSubmit: function onSubmit(event) {
          event.preventDefault();

          _this2.createExam();
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "text",
        className: "form-control",
        id: "createSubjectName",
        placeholder: "Exam name",
        value: this.state.createExamName,
        required: true,
        onChange: function onChange(event) {
          return _this2.setState({
            createExamName: event.target.value
          });
        }
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
        type: "submit",
        className: "btn btn-success ml-2 "
      }, "Create subject"))))) : ""));
    }
  }]);

  return Exam;
}(react__WEBPACK_IMPORTED_MODULE_1___default.a.Component);

/* harmony default export */ __webpack_exports__["default"] = (Exam);

/***/ })

}]);