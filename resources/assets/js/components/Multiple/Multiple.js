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
const GradeSystems = loadable(() => import('./GradeSystems'))

const AllStudentGrades = loadable(() => import('./AllStudentGrades'))

const StudentList = loadable(() => import('./StudentList'))

const TeacherSubjects = loadable(() => import('./TeacherSubjects'))

const TeacherAttendance = loadable(() => import('../Attendance/TeacherAttendance'))

const StaffAttendance = loadable(() => import('../Attendance/StaffAttendance'))

const TimeTable = loadable(() => import('./TimeTable'))

const Communicate = loadable(() => import('./Communicate'))
const SchoolEvent = loadable(() => import('./SchoolEvent'))
const SliderSetting = loadable(() => import('./SliderSetting'))

class Multiple extends React.Component {

    constructor(props) {
        super(props);


    }





    render() {

        return (
          <Router>
            <div>
                <Switch>

                    <Route path="/grades/all-grades">

                        <AllStudentGrades />
                    </Route>
                    <Route path="/communicate">

                        <Communicate />
                    </Route>
                    <Route path="/school_event">

                        <SchoolEvent />
                    </Route>
                    <Route path="/time_table">

                        <TimeTable />
                    </Route>
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

                    <Route path="/exams/grade-system">
                        <GradeSystems />
                    </Route>

                    <Route exact path="/exams">
                        <Exam />
                    </Route>

                    <Route  path="/dashboard/setting">
                        <SliderSetting />
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
