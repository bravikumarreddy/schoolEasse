import React from 'react';
import ReactDOM from 'react-dom';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
} from "react-router-dom";
//import Class from "./Class";
import loadable from '@loadable/component'

const Class = loadable(() => import('./Class'))

const Exam = loadable(() => import('./Exam'))

const StudentList = loadable(() => import('./StudentList'))

const TeacherSubjects = loadable(() => import('./TeacherSubjects'))

const TeacherAttendance = loadable(() => import('../Attendance/TeacherAttendance'))

const StaffAttendance = loadable(() => import('../Attendance/StaffAttendance'))

class Multiple extends React.Component {

    constructor(props) {
        super(props);


    }





    render() {

        return (
          <Router>
            <div>
                <Switch>
                    <Route path="/attendance/daily-attendance/teachers">

                        <TeacherAttendance />
                    </Route>
                    <Route path="/attendance/daily-attendance/staff">

                        <StaffAttendance />
                    </Route>
                    <Route path="/lists/students">

                        <StudentList role={this.props.role} />
                    </Route>
                    <Route path="/school/classes">

                        <Class />
                    </Route>
                    <Route path="/exams">
                        <Exam />
                    </Route>

                    <Route path="/teacher_subjects">
                        <TeacherSubjects />
                    </Route>

                </Switch>
            </div>
          </Router>
        )
    }
}

export default Multiple;

if (document.getElementById('multiple')) {
    var role =  document.getElementById('multiple').getAttribute('role');
    ReactDOM.render(<Multiple role={role} />, document.getElementById('multiple'));
}
