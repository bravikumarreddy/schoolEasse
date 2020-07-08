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
