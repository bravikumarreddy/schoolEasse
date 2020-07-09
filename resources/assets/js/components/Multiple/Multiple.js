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

const TeacherSubjects = loadable(() => import('./TeacherSubjects'))

class Multiple extends React.Component {

    constructor(props) {
        super(props);


    }





    render() {

        return (
          <Router>
            <div>
                <Switch>
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
    //var classes =  document.getElementById('class').getAttribute('classes');
    ReactDOM.render(<Multiple />, document.getElementById('multiple'));
}
