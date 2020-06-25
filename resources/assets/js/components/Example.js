import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

class Example extends React.Component {

    constructor(props) {
        super(props);
        const classes = JSON.parse(props.classes);
        console.log(classes);
        this.state={
            class:"",
            sectionOptions:[],
            section:"",
            studentList:[]
        }
        this.getSectionsClasses = this.getSectionsClasses.bind(this);
        this.getStudents = this.getStudents.bind(this);
    }

    async getSectionsClasses(value){
        if(value==""){
            this.setState({"class":value});
            return;
        }
        var v= await axios.get(`/fees/api/sections/${value}`);
        console.log(v.data);
        this.setState({"class":value,"sectionOptions":v.data});

    }
    async getStudents(value){
        if(value==""){
            this.setState({"section":value,studentList:[]});
            return;
        }
        const classId= this.state.class;
        var v = await axios.get(`/fees/api/students/${classId}/${value}`);
        console.log(v);
        this.setState({"section":value,studentList:v.data});
    }

    render() {
        const classes = JSON.parse(this.props.classes);
        return (
            <div>
                <div className="panel panel-info ">
                    <div className="panel-heading">Select Class And Section</div>
                    <div className="panel-body">
                        <div className="form-group">
                            <div className="col-md-4 mb-3">
                                <label htmlFor="fee_structure" className="control-label">Select Class</label>
                                <select value={this.state.class} id="fee_structure"  className="form-control" name="fee_structure"
                                 onChange={ (event)=> this.getSectionsClasses(event.target.value)}>
                                    <option value="">Class</option>
                                    { classes.map( val => (
                                        <option key={val.id} value={val.id}>{val.class_number}</option>
                                    ) ) }
                                </select>

                            </div>
                            <div className="col-md-4 mb-3">
                                <label htmlFor="fee_structure" className="control-label">Select Section</label>
                                <select disabled= { this.state.class ? false:true } value={this.state.section} id="fee_structure"  className="form-control" name="fee_structure"
                                        onChange={(event)=> this.getStudents(event.target.value)}>
                                    <option value="">Section</option>
                                    { this.state.sectionOptions.map( val => (
                                        <option key={val.id} value={val.id}>{val.section_number}</option>
                                    ) ) }
                                </select>

                            </div>
                     </div>

                    </div>

                </div>
                {this.state.studentList.length ?
                    <div className="panel panel-warning ">
                        <div className="panel-heading">Student List</div>
                        <div className="panel-body">

                            <table className="table table-data-div table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Student Code</th>
                                    <th>Father's Name</th>
                                    <th></th>


                                </tr>
                                </thead>
                                <tbody>
                                { this.state.studentList.map( val => (
                                    <tr key={val.student_id}>
                                        <td>{val.name}</td>
                                        <td>{val.email}</td>
                                        <td>{val.class_id}</td>
                                        <td>{val.section_number}</td>
                                        <td>{val.student_code}</td>
                                        <td>{val.father_name}</td>
                                        <td>
                                            <form id="form-id" method="get" action={"/fees/student/"+val.student_id}>
                                                <button className="btn-xs btn-success">
                                                    <small>Collect</small>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                ))}


                                </tbody>
                            </table>


                        </div>
                    </div>
                    :
                    ""
                }
            </div>
        )
    }
}

export default Example;

if (document.getElementById('example')) {
    var classes =  document.getElementById('example').getAttribute('classes');
    ReactDOM.render(<Example classes={classes}/>, document.getElementById('example'));
}
