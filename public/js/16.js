(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[16],{

/***/ "./resources/assets/js/components/Multiple/Class.js":
/*!**********************************************************!*\
  !*** ./resources/assets/js/components/Multiple/Class.js ***!
  \**********************************************************/
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





var Class = /*#__PURE__*/function (_React$Component) {
  _inherits(Class, _React$Component);

  var _super = _createSuper(Class);

  function Class(props) {
    var _this;

    _classCallCheck(this, Class);

    _this = _super.call(this, props);
    _this.state = {
      classes: "",
      "class": "",
      classLoading: false,
      className: "",
      subjects: [],
      createSubjectName: "",
      sections: [],
      section: "",
      sectionName: "",
      teacherSubjects: [],
      teachers: [],
      selectedTeacher: "",
      subjectId: "",
      teachersLoading: false
    };
    _this.getClasses = _this.getClasses.bind(_assertThisInitialized(_this));
    _this.getSubjects = _this.getSubjects.bind(_assertThisInitialized(_this));
    _this.createSubjects = _this.createSubjects.bind(_assertThisInitialized(_this));
    _this.deleteSubjects = _this.deleteSubjects.bind(_assertThisInitialized(_this));
    _this.getTeacherSubjects = _this.getTeacherSubjects.bind(_assertThisInitialized(_this));
    _this.getTeacherSubjects = _this.getTeacherSubjects.bind(_assertThisInitialized(_this));
    _this.assignTeacher = _this.assignTeacher.bind(_assertThisInitialized(_this));
    _this.removeTeacher = _this.removeTeacher.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(Class, [{
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
    key: "getSubjects",
    value: function () {
      var _getSubjects = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(class_id, className) {
        var res, sectionsRes;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                this.setState({
                  className: className,
                  section: "",
                  classLoading: true
                });
                _context2.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/subjects", {
                  params: {
                    class_id: class_id
                  }
                });

              case 3:
                res = _context2.sent;
                _context2.next = 6;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/sections", {
                  params: {
                    class_id: class_id
                  }
                });

              case 6:
                sectionsRes = _context2.sent;
                this.setState({
                  "class": class_id,
                  subjects: res.data,
                  sections: sectionsRes.data,
                  classLoading: false
                });
                console.log(res.data);

              case 9:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, this);
      }));

      function getSubjects(_x, _x2) {
        return _getSubjects.apply(this, arguments);
      }

      return getSubjects;
    }()
  }, {
    key: "createSubjects",
    value: function () {
      var _createSubjects = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3() {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                this.setState({
                  section: "",
                  classLoading: true
                });
                _context3.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/subjects/create", {
                  params: {
                    class_id: this.state["class"],
                    name: this.state.createSubjectName
                  }
                });

              case 3:
                res = _context3.sent;
                console.log(res.data);
                this.setState({
                  subjects: res.data,
                  classLoading: false
                });

              case 6:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3, this);
      }));

      function createSubjects() {
        return _createSubjects.apply(this, arguments);
      }

      return createSubjects;
    }()
  }, {
    key: "deleteSubjects",
    value: function () {
      var _deleteSubjects = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4(subject_id) {
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
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/subjects/delete", {
                  params: {
                    class_id: this.state["class"],
                    subject_id: subject_id
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

      function deleteSubjects(_x3) {
        return _deleteSubjects.apply(this, arguments);
      }

      return deleteSubjects;
    }()
  }, {
    key: "getTeacherSubjects",
    value: function () {
      var _getTeacherSubjects = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5(section_id, section_name) {
        var res, teachersRes;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
          while (1) {
            switch (_context5.prev = _context5.next) {
              case 0:
                console.log(section_id, section_name);
                this.setState({
                  teachersLoading: true
                });
                _context5.next = 4;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/teacher_subjects", {
                  params: {
                    section_id: section_id
                  }
                });

              case 4:
                res = _context5.sent;
                _context5.next = 7;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/teachers");

              case 7:
                teachersRes = _context5.sent;
                this.setState({
                  teachersLoading: false,
                  section: section_id,
                  sectionName: section_name,
                  teacherSubjects: res.data,
                  teachers: teachersRes.data
                });
                console.log(res);

              case 10:
              case "end":
                return _context5.stop();
            }
          }
        }, _callee5, this);
      }));

      function getTeacherSubjects(_x4, _x5) {
        return _getTeacherSubjects.apply(this, arguments);
      }

      return getTeacherSubjects;
    }()
  }, {
    key: "assignTeacher",
    value: function () {
      var _assignTeacher = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6(event) {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
          while (1) {
            switch (_context6.prev = _context6.next) {
              case 0:
                event.preventDefault();
                console.log(this.state.subjectId);
                this.setState({
                  teachersLoading: true
                });
                _context6.next = 5;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/teacher_subjects/assign", {
                  params: {
                    section_id: this.state.section,
                    subject_id: this.state.subjectId,
                    teacher_id: this.state.selectedTeacher
                  }
                });

              case 5:
                res = _context6.sent;
                console.log(res);
                this.setState({
                  teacherSubjects: res.data,
                  teachersLoading: false
                });

              case 8:
              case "end":
                return _context6.stop();
            }
          }
        }, _callee6, this);
      }));

      function assignTeacher(_x6) {
        return _assignTeacher.apply(this, arguments);
      }

      return assignTeacher;
    }()
  }, {
    key: "removeTeacher",
    value: function () {
      var _removeTeacher = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee7(teacher_subject_id) {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee7$(_context7) {
          while (1) {
            switch (_context7.prev = _context7.next) {
              case 0:
                this.setState({
                  teachersLoading: true
                });
                console.log(this.state.subjectId);
                _context7.next = 4;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/teacher_subjects/remove", {
                  params: {
                    section_id: this.state.section,
                    teacher_subject_id: teacher_subject_id
                  }
                });

              case 4:
                res = _context7.sent;
                console.log(res);
                this.setState({
                  teacherSubjects: res.data,
                  teachersLoading: false
                });

              case 7:
              case "end":
                return _context7.stop();
            }
          }
        }, _callee7, this);
      }));

      function removeTeacher(_x7) {
        return _removeTeacher.apply(this, arguments);
      }

      return removeTeacher;
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
      })))))) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Components_Loader__WEBPACK_IMPORTED_MODULE_2__["default"], null), this.state["class"] && this.state.classLoading == false ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-dark mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-dark "
      }, "Class ", this.state.className, " - Subjects"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("ul", {
        className: "list-group col-6"
      }, this.state.subjects.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("li", {
          key: val.id,
          className: "list-group-item d-flex justify-content-between align-items-center "
        }, val.name, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          className: "btn btn-sm btn-danger ml-2",
          onClick: function onClick() {
            _this2.deleteSubjects(val.id);
          }
        }, "Delete"));
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-5 p-0 mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("form", {
        className: "form-inline ",
        onSubmit: function onSubmit(event) {
          event.preventDefault();

          _this2.createSubjects();
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "text",
        className: "form-control",
        id: "createSubjectName",
        placeholder: "Subject name",
        value: this.state.createSubjectName,
        required: true,
        onChange: function onChange(event) {
          return _this2.setState({
            createSubjectName: event.target.value
          });
        }
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
        type: "submit",
        className: "btn btn-success ml-2 "
      }, "Create subject"))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group row  mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-md-4 "
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "sections",
        className: "col-form-label"
      }, "Select Section"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("select", {
        id: "sections",
        value: this.state.section,
        className: "form-control custom-select",
        onChange: function onChange(event) {
          _this2.getTeacherSubjects(event.target.value, event.target.options[event.target.options.selectedIndex].text);
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: ""
      }, "Section"), this.state.sections.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
          key: val.id,
          value: val.id
        }, val.section_number);
      })))))) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, this.state.classLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Components_Loader__WEBPACK_IMPORTED_MODULE_2__["default"], null) : ""), this.state.section && this.state["class"] && this.state.teachersLoading == false ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-orange mt-4 mb-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-orange"
      }, "Class ", this.state.className, " Section ", this.state.sectionName, " - Assign Teachers"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("form", {
        onSubmit: function onSubmit(event) {
          return _this2.assignTeacher(event);
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group row"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-md-4 "
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "teachers",
        className: "col-form-label"
      }, "Select teacher"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("select", {
        value: this.state.selectedTeacher,
        id: "teachers",
        className: "form-control custom-select",
        name: "teachers",
        onChange: function onChange(event) {
          _this2.setState({
            selectedTeacher: event.target.value
          });
        },
        required: true
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: ""
      }, "Teacher"), this.state.teachers.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
          key: val.id,
          value: val.id
        }, val.name);
      })))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("ul", {
        className: "list-group col-8"
      }, this.state.teacherSubjects.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("li", {
          key: val.id,
          className: "list-group-item d-flex justify-content-between align-items-center "
        }, val.name, val.teacher_id ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: "row"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h4", {
          className: "m-0"
        }, " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "badge badge-secondary"
        }, val.teacher_name)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          type: "button",
          className: "btn btn-danger ml-2 mr-2 ",
          onClick: function onClick() {
            return _this2.removeTeacher(val.teacher_subject_id);
          }
        }, "Remove Teacher")) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          type: "submit",
          className: "btn btn-success ml-2 mr-2 ",
          onClick: function onClick() {
            _this2.setState({
              subjectId: val.id
            });
          }
        }, "Assign Selected Teacher"));
      }))))) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, this.state.teachersLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Components_Loader__WEBPACK_IMPORTED_MODULE_2__["default"], null) : ""));
    }
  }]);

  return Class;
}(react__WEBPACK_IMPORTED_MODULE_1___default.a.Component);

/* harmony default export */ __webpack_exports__["default"] = (Class);

/***/ }),

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

/***/ })

}]);