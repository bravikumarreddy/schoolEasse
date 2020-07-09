(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

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

/***/ "./resources/assets/js/components/Multiple/TeacherSubjects.js":
/*!********************************************************************!*\
  !*** ./resources/assets/js/components/Multiple/TeacherSubjects.js ***!
  \********************************************************************/
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





var TeacherSubjects = /*#__PURE__*/function (_React$Component) {
  _inherits(TeacherSubjects, _React$Component);

  var _super = _createSuper(TeacherSubjects);

  function TeacherSubjects(props) {
    var _this;

    _classCallCheck(this, TeacherSubjects);

    _this = _super.call(this, props);
    _this.state = {
      mySubjects: [],
      mySubjectsLoading: false,
      subjectId: "",
      classId: "",
      className: "",
      sectionId: "",
      classExams: [],
      exam: "",
      studentList: [],
      maxMarks: 0,
      studentMarksList: []
    };
    _this.getExams = _this.getExams.bind(_assertThisInitialized(_this));
    _this.changeMarks = _this.changeMarks.bind(_assertThisInitialized(_this));
    _this.getStudents = _this.getStudents.bind(_assertThisInitialized(_this));
    _this.submitMarks = _this.submitMarks.bind(_assertThisInitialized(_this));
    _this.removeMarks = _this.removeMarks.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(TeacherSubjects, [{
    key: "componentDidMount",
    value: function () {
      var _componentDidMount = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                this.setState({
                  mySubjectsLoading: true
                });
                _context.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/teacher_subjects/my_subjects");

              case 3:
                res = _context.sent;
                this.setState({
                  mySubjects: res.data,
                  mySubjectsLoading: false
                });

              case 5:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function componentDidMount() {
        return _componentDidMount.apply(this, arguments);
      }

      return componentDidMount;
    }()
  }, {
    key: "getExams",
    value: function () {
      var _getExams = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(subject_id, class_id, section_id, className) {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                this.setState({
                  exam: "",
                  maxMarks: 0
                });
                _context2.next = 3;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/class_exams", {
                  params: {
                    class_id: class_id
                  }
                });

              case 3:
                res = _context2.sent;
                console.log(res.data);
                this.setState({
                  classId: class_id,
                  className: className,
                  subjectId: subject_id,
                  sectionId: section_id,
                  classExams: res.data
                });

              case 6:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, this);
      }));

      function getExams(_x, _x2, _x3, _x4) {
        return _getExams.apply(this, arguments);
      }

      return getExams;
    }()
  }, {
    key: "getStudents",
    value: function () {
      var _getStudents = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(exam_id) {
        var res, arr, i;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                _context3.next = 2;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/exam_marks/get_students", {
                  params: {
                    exam_id: exam_id,
                    section_id: this.state.sectionId,
                    subject_id: this.state.subjectId
                  }
                });

              case 2:
                res = _context3.sent;
                arr = [];

                for (i = 0; i < res.data.length; i++) {
                  arr.push(0);
                }

                this.setState({
                  exam: exam_id,
                  studentList: res.data,
                  studentMarksList: arr
                });

              case 6:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3, this);
      }));

      function getStudents(_x5) {
        return _getStudents.apply(this, arguments);
      }

      return getStudents;
    }()
  }, {
    key: "submitMarks",
    value: function () {
      var _submitMarks = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4(marks, student_id) {
        var res, arr, i;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                console.log(marks);
                console.log(this.state.studentMarksList);
                _context4.next = 4;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/exam_marks/submit_marks", {
                  params: {
                    exam_id: this.state.exam,
                    section_id: this.state.sectionId,
                    subject_id: this.state.subjectId,
                    student_id: student_id,
                    marks: marks,
                    max_marks: this.state.maxMarks
                  }
                });

              case 4:
                res = _context4.sent;
                arr = [];

                for (i = 0; i < res.data.length; i++) {
                  arr.push(0);
                }

                this.setState({
                  studentList: res.data,
                  studentMarksList: arr
                });

              case 8:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4, this);
      }));

      function submitMarks(_x6, _x7) {
        return _submitMarks.apply(this, arguments);
      }

      return submitMarks;
    }()
  }, {
    key: "removeMarks",
    value: function () {
      var _removeMarks = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5(id) {
        var res, arr, i;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
          while (1) {
            switch (_context5.prev = _context5.next) {
              case 0:
                _context5.next = 2;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/exam_marks/remove_marks", {
                  params: {
                    exam_id: this.state.exam,
                    section_id: this.state.sectionId,
                    subject_id: this.state.subjectId,
                    record_id: id
                  }
                });

              case 2:
                res = _context5.sent;
                arr = [];

                for (i = 0; i < res.data.length; i++) {
                  arr.push(0);
                }

                this.setState({
                  studentList: res.data,
                  studentMarksList: arr
                });

              case 6:
              case "end":
                return _context5.stop();
            }
          }
        }, _callee5, this);
      }));

      function removeMarks(_x8) {
        return _removeMarks.apply(this, arguments);
      }

      return removeMarks;
    }()
  }, {
    key: "changeMarks",
    value: function changeMarks(index, value) {
      var studentMarksList = this.state.studentMarksList;
      studentMarksList[index] = value;
      this.setState({
        studentMarksList: studentMarksList
      });
    }
  }, {
    key: "render",
    value: function render() {
      var _this2 = this;

      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, this.state.mySubjectsLoading ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(_Components_Loader__WEBPACK_IMPORTED_MODULE_2__["default"], null) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, this.state.mySubjects ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-dark mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-dark"
      }, " My Subjects"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("ul", {
        className: "list-group col-12"
      }, this.state.mySubjects.map(function (val, index) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("li", {
          key: index,
          className: "list-group-item "
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: "row"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, " ", val.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, "Class - ", val.class_number), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, "Section - ", val.section_number), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          className: "btn btn-sm btn-info",
          onClick: function onClick() {
            _this2.getExams(val.subject_id, val.class_id, val.section_id, val.class_number);
          }
        }, "Assign Marks")), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          className: "btn btn-sm btn-warning",
          onClick: function onClick() {}
        }, "View"))));
      })))) : " No subjects are assigned "), this.state.classId ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-indigo mt-4 mb-5"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-indigo"
      }, "Class ", this.state.className, " "), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "row m-1"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-md-4 "
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "classExams",
        className: "col-form-label"
      }, "Select exam to assign Marks"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("select", {
        value: this.state.exam,
        id: "classExams",
        className: "form-control custom-select",
        name: "teachers",
        onChange: function onChange(event) {
          _this2.getStudents(event.target.value);
        },
        required: true
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: ""
      }, "Teacher"), this.state.classExams.map(function (val) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
          key: val.id,
          value: val.id
        }, val.exam_name);
      }))), this.state.exam ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-md-4 "
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "maxValue",
        className: "col-form-label text-danger"
      }, "Maximum Marks for this test"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "number",
        value: this.state.maxMarks,
        id: "maxValue",
        className: "form-control",
        min: 0,
        onChange: function onChange(event) {
          return _this2.setState({
            maxMarks: event.target.value
          });
        }
      })) : ""), this.state.exam ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("ul", {
        className: "list-group col-12 m-3"
      }, this.state.studentList.map(function (val, index) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("li", {
          key: index,
          className: "list-group-item "
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: "row"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, " ", val.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, val.student_code), val.id == null ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("form", {
          className: "form-row col-5",
          onSubmit: function onSubmit(event) {
            event.preventDefault();

            _this2.submitMarks(_this2.state.studentMarksList[index], val.student_user_id);
          }
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-5 d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
          type: "number",
          className: "form-control col-9",
          "aria-label": "Small",
          min: 0,
          max: _this2.state.maxMarks,
          "aria-describedby": "inputGroup-sizing-sm",
          value: _this2.state.studentMarksList[index] || 0,
          onChange: function onChange(event) {
            return _this2.changeMarks(index, event.target.value);
          },
          required: true,
          name: "marks"
        }), " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, "/"), " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", null, _this2.state.maxMarks)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-4 d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          className: "btn btn-sm btn-success",
          onClick: function onClick() {}
        }, "Submit")))) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react__WEBPACK_IMPORTED_MODULE_1___default.a.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, " ", val.marks, " / ", val.max_marks, " "), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "col-2 d-flex justify-content-between align-items-center"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
          className: "btn btn-sm btn-danger",
          onClick: function onClick() {
            _this2.removeMarks(val.id);
          }
        }, "Remove")))));
      })) : "")) : "");
    }
  }]);

  return TeacherSubjects;
}(react__WEBPACK_IMPORTED_MODULE_1___default.a.Component);

/* harmony default export */ __webpack_exports__["default"] = (TeacherSubjects);

/***/ })

}]);