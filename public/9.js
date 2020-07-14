(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./resources/assets/js/components/Attendance/StaffAttendance.js":
/*!**********************************************************************!*\
  !*** ./resources/assets/js/components/Attendance/StaffAttendance.js ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react_datepicker__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-datepicker */ "./node_modules/react-datepicker/dist/react-datepicker.min.js");
/* harmony import */ var react_datepicker__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(react_datepicker__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var react_datepicker_dist_react_datepicker_css__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-datepicker/dist/react-datepicker.css */ "./node_modules/react-datepicker/dist/react-datepicker.css");
/* harmony import */ var react_datepicker_dist_react_datepicker_css__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(react_datepicker_dist_react_datepicker_css__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_6__);


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








var StaffAttendance = /*#__PURE__*/function (_React$Component) {
  _inherits(StaffAttendance, _React$Component);

  var _super = _createSuper(StaffAttendance);

  function StaffAttendance(props) {
    var _this;

    _classCallCheck(this, StaffAttendance);

    _this = _super.call(this, props);
    _this.state = {
      session: "",
      staffList: [],
      selectAll: true,
      selectStaffList: [],
      date: Date.now(),
      checkAttendance: null
    };
    _this.getStaff = _this.getStaff.bind(_assertThisInitialized(_this));
    _this.selectAll = _this.selectAll.bind(_assertThisInitialized(_this));
    _this.changeSelection = _this.changeSelection.bind(_assertThisInitialized(_this));
    _this.getDateString = _this.getDateString.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(StaffAttendance, [{
    key: "selectAll",
    value: function selectAll(event) {
      var selectStaffList = [];

      for (var i = 0; i < this.state.selectStaffList.length; i++) {
        selectStaffList.push(!this.state.selectAll);
      }

      console.log(event.target.value);
      this.setState({
        "selectAll": !this.state.selectAll,
        selectStaffList: selectStaffList
      });
    }
  }, {
    key: "changeSelection",
    value: function changeSelection(index) {
      var selectStaffList = this.state.selectStaffList;
      selectStaffList[index] = !this.state.selectStaffList[index];
      this.setState({
        selectStaffList: selectStaffList
      });
    }
  }, {
    key: "getStaff",
    value: function () {
      var _getStaff = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(value) {
        var session, date, v, selectStaffList, i;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (!(value == "")) {
                  _context.next = 3;
                  break;
                }

                this.setState({
                  "session": value,
                  "staffList": []
                });
                return _context.abrupt("return");

              case 3:
                session = value;
                date = this.getDateString(this.state.date);
                _context.next = 7;
                return axios__WEBPACK_IMPORTED_MODULE_3___default.a.get("/api/attendance/daily-attendance/staff/getStaff");

              case 7:
                v = _context.sent;
                console.log(v);
                selectStaffList = [];

                for (i = 0; i < v.data.length; i++) {
                  selectStaffList.push(true);
                }

                this.setState({
                  "session": value,
                  staffList: v.data,
                  selectStaffList: selectStaffList
                });

              case 12:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function getStaff(_x) {
        return _getStaff.apply(this, arguments);
      }

      return getStaff;
    }()
  }, {
    key: "getDateString",
    value: function getDateString(str) {
      var d = new Date(this.state.date);
      var month = '' + (d.getMonth() + 1);
      var day = '' + d.getDate();
      var year = d.getFullYear();
      if (month.length < 2) month = '0' + month;
      if (day.length < 2) day = '0' + day;
      return [day, month, year].join('-');
    }
  }, {
    key: "render",
    value: function render() {
      var _this2 = this;

      if (this.state.date) {
        var formattedDate = this.getDateString(this.state.date);
      }

      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-info mt-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-info"
      }, "Select Department "), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "form-group row"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-md-2 mb-3"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        className: "col-md-12 col-form-label pl-0"
      }, "Select Date"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement(react_datepicker__WEBPACK_IMPORTED_MODULE_4___default.a, {
        className: "form-control",
        name: "Instalment[]",
        selected: this.state.date,
        onChange: function onChange(date) {
          _this2.setState({
            date: date,
            staffList: [],
            session: ""
          });
        }
      })), this.state.date ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "col-md-3 mb-3"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        htmlFor: "fee_structure",
        className: "col-form-label"
      }, "Select Session"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("select", {
        value: this.state.session,
        id: "fee_structure",
        className: " custom-select form-control",
        name: "fee_structure",
        onChange: function onChange(event) {
          return _this2.getStaff(event.target.value);
        }
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: ""
      }, "Session"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: "Morning"
      }, "Morning"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("option", {
        value: "After-Noon"
      }, "After-Noon"))) : " "))), this.state.staffList.length ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("form", {
        action: "/attendance/daily-attendance/staff/submit",
        method: "post"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card border-orange mt-4 mb-4"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-header text-white bg-orange"
      }, "Student List"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-body"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "hidden",
        name: "_token",
        value: csrf_token
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "hidden",
        name: "date",
        value: formattedDate
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "hidden",
        name: "session",
        value: this.state.session
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("table", {
        ref: function ref(el) {
          return _this2.el = el;
        },
        className: "table table-bordered  table-hover"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("thead", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", null, "Name"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", null, "email"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", null, "role"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", null, "status"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "custom-control  custom-checkbox"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
        type: "checkbox",
        className: " bg-success custom-control-input",
        id: "selectAll",
        checked: this.state.selectAll,
        onChange: function onChange(event) {
          return _this2.selectAll(event);
        },
        value: "val"
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
        className: "custom-control-label",
        htmlFor: "selectAll"
      }, "Select All"))))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tbody", null, this.state.staffList.map(function (val, index) {
        return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("tr", {
          key: val.id
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", null, val.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", null, val.email), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", null, val.role), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("th", null, _this2.state.selectStaffList[index] ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, "  ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "badge badge-pill badge-secondary badge-success"
        }, "Present ")) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("h5", null, " ", /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("span", {
          className: "badge badge-pill badge-secondary badge-danger"
        }, "Absent "))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("td", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
          className: "custom-control custom-checkbox"
        }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("input", {
          type: "checkbox",
          className: "custom-control-input",
          id: "selectStaffList" + index,
          name: "selectStaffList[]",
          value: val.id,
          checked: _this2.state.selectStaffList[index],
          onChange: function onChange() {
            return _this2.changeSelection(index);
          }
        }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("label", {
          className: "custom-control-label",
          htmlFor: "selectStaffList" + index
        }, " Present"))));
      })))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("div", {
        className: "card-footer bg-orange"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement("button", {
        type: "submit",
        className: "btn float-right btn-primary"
      }, "Save Changes")))) : "");
    }
  }]);

  return StaffAttendance;
}(react__WEBPACK_IMPORTED_MODULE_1___default.a.Component);

/* harmony default export */ __webpack_exports__["default"] = (StaffAttendance);

/***/ })

}]);