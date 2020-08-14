(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

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


function Loader(props) {
  var size = "3rem";
  var margin = "5";

  if (props.size) {
    size = props.size;
  }

  if (props.margin) {
    margin = props.margin;
  }

  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "d-flex justify-content-center"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "spinner-border   m-".concat(margin, " "),
    role: "status",
    style: {
      width: size,
      height: size
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("span", {
    className: "sr-only"
  }, "Loading...")));
}

/* harmony default export */ __webpack_exports__["default"] = (Loader);

/***/ }),

/***/ "./resources/assets/js/components/Multiple/Syllabus.js":
/*!*************************************************************!*\
  !*** ./resources/assets/js/components/Multiple/Syllabus.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _Components_Loader__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Components/Loader */ "./resources/assets/js/components/Multiple/Components/Loader.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_3__);


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





var Syllabus = /*#__PURE__*/function (_React$Component) {
  _inherits(Syllabus, _React$Component);

  var _super = _createSuper(Syllabus);

  function Syllabus(props) {
    var _this;

    _classCallCheck(this, Syllabus);

    _this = _super.call(this, props);
    _this.state = {
      classes: "",
      "class": "",
      classLoading: false,
      className: "",
      subjects: [],
      subject: "",
      createSubjectName: "",
      syllabus: [],
      topic: "",
      reference: "",
      comments: ""
    };
    _this.getClasses = _this.getClasses.bind(_assertThisInitialized(_this));
    _this.getSubjects = _this.getSubjects.bind(_assertThisInitialized(_this));
    _this.getSyllabus = _this.getSyllabus.bind(_assertThisInitialized(_this));
    _this.createSubjects = _this.createSubjects.bind(_assertThisInitialized(_this));
    _this.addSyllabus = _this.addSyllabus.bind(_assertThisInitialized(_this));
    _this.deleteSyllabus = _this.deleteSyllabus.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(Syllabus, [{
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
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/classes");

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
    key: "getSyllabus",
    value: function () {
      var _getSyllabus = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(subject_id, subject_name) {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.next = 2;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/syllabus/".concat(subject_id));

              case 2:
                res = _context2.sent;
                console.log(res);
                this.setState({
                  subject: subject_id,
                  syllabus: res.data
                });

              case 5:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, this);
      }));

      function getSyllabus(_x, _x2) {
        return _getSyllabus.apply(this, arguments);
      }

      return getSyllabus;
    }()
  }, {
    key: "getSubjects",
    value: function () {
      var _getSubjects = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(class_id, className) {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                this.setState({
                  className: className,
                  section: "",
                  classLoading: true
                });
                _context3.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/subjects", {
                  params: {
                    class_id: class_id
                  }
                });

              case 3:
                res = _context3.sent;
                this.setState({
                  "class": class_id,
                  subjects: res.data,
                  classLoading: false
                });
                console.log(res.data);

              case 6:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3, this);
      }));

      function getSubjects(_x3, _x4) {
        return _getSubjects.apply(this, arguments);
      }

      return getSubjects;
    }()
  }, {
    key: "createSubjects",
    value: function () {
      var _createSubjects = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4() {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                this.setState({
                  section: "",
                  classLoading: true
                });
                _context4.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/subjects/create", {
                  params: {
                    class_id: this.state["class"],
                    name: this.state.createSubjectName
                  }
                });

              case 3:
                res = _context4.sent;
                console.log(res.data);
                this.setState({
                  subjects: res.data,
                  classLoading: false
                });

              case 6:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4, this);
      }));

      function createSubjects() {
        return _createSubjects.apply(this, arguments);
      }

      return createSubjects;
    }()
  }, {
    key: "addSyllabus",
    value: function () {
      var _addSyllabus = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5() {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
          while (1) {
            switch (_context5.prev = _context5.next) {
              case 0:
                _context5.next = 2;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/syllabus/add/", {
                  params: {
                    subject_id: this.state.subject,
                    topic: this.state.topic,
                    reference: this.state.reference,
                    comments: this.state.comments
                  }
                });

              case 2:
                res = _context5.sent;
                _context5.next = 5;
                return this.getSyllabus(this.state.subject, "");

              case 5:
              case "end":
                return _context5.stop();
            }
          }
        }, _callee5, this);
      }));

      function addSyllabus() {
        return _addSyllabus.apply(this, arguments);
      }

      return addSyllabus;
    }()
  }, {
    key: "deleteSyllabus",
    value: function () {
      var _deleteSyllabus = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6(syllabus_id) {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
          while (1) {
            switch (_context6.prev = _context6.next) {
              case 0:
                _context6.next = 2;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/syllabus/delete", {
                  params: {
                    syllabus_id: syllabus_id
                  }
                });

              case 2:
                res = _context6.sent;
                _context6.next = 5;
                return this.getSyllabus(this.state.subject, "");

              case 5:
              case "end":
                return _context6.stop();
            }
          }
        }, _callee6, this);
      }));

      function deleteSyllabus(_x5) {
        return _deleteSyllabus.apply(this, arguments);
      }

      return deleteSyllabus;
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
          _this2.getSubjects(event.target.value, event.target.options[event.target.options.selectedIndex].text);
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: ""
      }, "Class"), this.state.classes.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
          key: val.id,
          value: val.id
        }, val.class_number);
      }))), this.state["class"] && this.state.classLoading == false ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-md-4 "
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "subject",
        className: "col-form-label"
      }, "Select Subject"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("select", {
        value: this.state.subject,
        id: "fee_structure",
        className: "form-control custom-select",
        name: "subject",
        onChange: function onChange(event) {
          _this2.getSyllabus(event.target.value, event.target.options[event.target.options.selectedIndex].text);
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: ""
      }, "Subject"), this.state.subjects.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
          key: val.id,
          value: val.id
        }, val.name);
      }))) : ""))) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Components_Loader__WEBPACK_IMPORTED_MODULE_2__["default"], null), this.state.subject ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-orange mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-orange"
      }, "Add Syllabus"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("form", {
        method: "post",
        autoComplete: "off",
        action: "/syllabus/add",
        onSubmit: function onSubmit(event) {
          event.preventDefault();

          _this2.addSyllabus();
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group col-6"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "topic"
      }, "Topic Name"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "text",
        className: "form-control",
        id: "topic",
        placeholder: "Enter Topic Name",
        value: this.state.topic,
        onChange: function onChange(event) {
          _this2.setState({
            topic: event.target.value
          });
        },
        required: true
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group col-6"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "reference"
      }, "References"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "text",
        className: "form-control",
        id: "reference",
        placeholder: "Textbook / article",
        value: this.state.reference,
        onChange: function onChange(event) {
          _this2.setState({
            reference: event.target.value
          });
        },
        required: true
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group col-6"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "Comments"
      }, "Comments"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("textarea", {
        type: "text",
        className: "form-control",
        id: "Comments",
        placeholder: "Info",
        value: this.state.comments,
        onChange: function onChange(event) {
          _this2.setState({
            comments: event.target.value
          });
        }
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-sm-8 "
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
        type: "submit",
        className: "btn btn-success"
      }, "Submit")))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-messenger mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-messenger"
      }, "Add Syllabus"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("ul", {
        className: " mt-3 list-group  mb-4"
      }, this.state.syllabus.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, {
          key: val.id
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("li", {
          className: "list-group-item"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: "d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", {
          className: "text-messenger"
        }, "Topic :  \xA0\xA0"), " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, " ", val.topic))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: " pt-3 d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", {
          className: "text-messenger"
        }, "Reference :  \xA0\xA0"), " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, " ", val.reference))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: " pt-3 d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("b", {
          className: "text-messenger"
        }, "Comments :  \xA0\xA0"), " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, " ", val.comments))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: " pt-3 d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          type: "button",
          className: "btn btn-danger",
          onClick: function onClick() {
            return _this2.deleteSyllabus(val.id);
          }
        }, "Delete"))));
      }))))) : "");
    }
  }]);

  return Syllabus;
}(react__WEBPACK_IMPORTED_MODULE_1___default.a.Component);

/* harmony default export */ __webpack_exports__["default"] = (Syllabus);

/***/ })

}]);