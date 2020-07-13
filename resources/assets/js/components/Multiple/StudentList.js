import React from 'react';
import Loader from './Components/Loader'
import axios from "axios";

class StudentList extends React.Component {

    constructor(props) {
        super(props);

        this.state={
            classes:[],
            class:"",
            sectionOptions:[],
            section:"",
            studentList:[],
            filterText:"",
        }
        this.getSectionsClasses = this.getSectionsClasses.bind(this);
        this.getStudents = this.getStudents.bind(this);
        this.getClasses = this.getClasses.bind(this);
    }

    componentDidMount() {
        console.log(this.props);

        this.getClasses();
    }

    async getClasses(){

        var res = await axios.get(`/api/classes`);
        console.log(res.data);
        this.setState({classes:res.data});


    }

    async getSectionsClasses(value){
        if(value==""){
            this.setState({"class":value});
            return;
        }
        let v= await axios.get(`/api/sections`,{
            params:{
                class_id : value,
            }

        });
        console.log(v.data);
        this.setState({"class":value,"sectionOptions":v.data});

    }
    async getStudents(value){
        if(value==""){
            this.setState({"section":value,studentList:[]});
            return;
        }
        const classId= this.state.class;
        var v = await axios.get(`/api/students/${value}`);
        console.log(v);
        this.setState({"section":value,studentList:v.data});
    }

    render() {
        const classes = this.state.classes;
        let filteredStudents = this.state.studentList;
        console.log(this.state.studentList);
        if(this.state.filterText){
            filteredStudents = this.state.studentList.filter(item => item.name && item.name.toLowerCase().includes(this.state.filterText.toLowerCase()));
        }
        return (
            <React.Fragment>
                {this.state.classes ?
                    <div>
                        <h4>Students List</h4>
                        <div className="card border-info mt-4">
                            <div className="card-header text-white bg-info">Select Class And Section</div>
                            <div className="card-body">
                                <div className="form-group row">
                                    <div className="col-md-4 mb-3">
                                        <label htmlFor="fee_structure" className="col-form-label">Select Class</label>
                                        <select value={this.state.class} id="fee_structure"
                                                className="form-control custom-select" name="fee_structure"
                                                onChange={(event) => this.getSectionsClasses(event.target.value)}>
                                            <option value="">Class</option>
                                            {classes.map(val => (
                                                <option key={val.id} value={val.id}>{val.class_number}</option>
                                            ))}
                                        </select>

                                    </div>
                                    {this.state.class ?
                                    <div className="col-md-4 mb-3">
                                        <label htmlFor="fee_structure" className="col-form-label">Select Section</label>
                                        <select value={this.state.section}
                                                id="fee_structure" className="form-control custom-select"
                                                name="fee_structure"
                                                onChange={(event) => this.getStudents(event.target.value)}>
                                            <option value="">Section</option>
                                            {this.state.sectionOptions.map(val => (
                                                <option key={val.id} value={val.id}>{val.section_number}</option>
                                            ))}
                                        </select>

                                    </div>:
                                        ""}

                                </div>

                            </div>

                        </div>
                        {this.state.studentList.length ?
                            <div className="card border-0 p-0 mt-4 mb-4">

                                <div className="card-body p-0 border-0">
                                    <div className="col-md-3 mb-3  float-right">
                                        <label htmlFor="filterText" className="col-form-label">Filter by name</label>
                                    <input type='text' id='filterText' className="form-control" placeholder="name" value={this.state.filterText} onChange={(event)=>{this.setState({filterText:event.target.value})}} />
                                    </div>
                                    <table className="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            {this.props.role == 'admin' ?
                                                <th scope="col">Action</th>:""
                                            }
                                            <th scope="col">Profile</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Student Code</th>
                                            <th scope="col">Father's Name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Blood</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>



                                        </tr>
                                        </thead>
                                        <tbody>
                                        {filteredStudents.map(val => (
                                            <tr key={val.student_id}>
                                                <td><small><a href={"/user/"+val.student_code}>{val.name}</a></small></td>
                                                {this.props.role == 'admin' ?
                                                    <td>
                                                        <a className="btn pl-1 pr-1 pt-0 pb-0 m-0 btn-sm btn-danger"
                                                           href={"/edit/user/"+val.student_id} >Edit</a>
                                                    </td>:""
                                                }
                                                <td>
                                                    <a className="btn pl-1 pr-1 pt-0 pb-0 m-0 btn-sm btn-info"
                                                       href={"/user/"+val.student_code} >Profile</a>
                                                </td>
                                                <td><small>{val.email}</small></td>
                                                <td><small>{val.class_id}</small></td>
                                                <td><small>{val.section_number}</small></td>
                                                <td><small>{val.student_code}</small></td>
                                                <td><small>{val.father_name}</small></td>
                                                <td>
                                                    <small>{val.gender}</small>
                                                </td>
                                                <td>
                                                    <small>{val.blood_group}</small>
                                                </td>
                                                <td>
                                                    <small>{val.phone_number}</small>
                                                </td>
                                                <td>
                                                    <small>{val.address}</small>
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
                    </div>:
                    <Loader></Loader>
                }
            </React.Fragment>
        )
    }
}

export default StudentList;
