import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import $ from 'jquery';
import dateformatter from 'dateformat';

class TeacherAttendance extends React.Component {

    constructor(props) {
        super(props)
        this.state={

            departmentOptions:[],
            department:"",
            session:"",
            teacherList:[],
            selectAll:true,
            selectTeachersList:[],
            date:Date.now(),
            checkAttendance:null

        }


        this.getSectionsClasses = this.getSectionsClasses.bind(this);
        this.getTeachers = this.getTeachers.bind(this);
        this.selectAll = this.selectAll.bind(this);
        this.setDepartment = this.setDepartment.bind(this);
        this.changeSelection = this.changeSelection.bind(this);
        this.getDateString = this.getDateString.bind(this);
    }

    async componentDidMount() {
        let v= await axios.get(`/api/attendance/daily-attendance/teachers/departments`);
        console.log(v.data);
        this.setState({departmentOptions:v.data});
    }


    selectAll(event){
        var selectTeachersList=[];
        for(var i=0;i<this.state.selectTeachersList.length;i++){
            selectTeachersList.push(!this.state.selectAll);
        }
        console.log((event.target.value))
        this.setState({"selectAll":!this.state.selectAll,selectTeachersList:selectTeachersList});
    }

    async getSectionsClasses(value){
        if(value==""){
            this.setState({"class":value,"teacherList":[]});
            return;
        }
        let v= await axios.get(`/api/sections`,{
            params:{
                class_id : value,
            }

        });
        console.log(v.data);
        this.setState({"class":value,"sectionOptions":v.data,"section":"","teacherList":[]});

    }

    async setDepartment(value){

        this.setState({"department":value,"teacherList":[],date:Date.now() ,'session':"" });
    }

    changeSelection(index){
        var selectTeachersList = this.state.selectTeachersList;
        selectTeachersList[index] = !this.state.selectTeachersList[index];
        this.setState({selectTeachersList:selectTeachersList});
    }

    async getTeachers(value){

        if(value==""){
            this.setState({"session":value,"teacherList":[]});
            return;
        }

        const departmentId =  this.state.department;
        const session =  value
        const date =  this.getDateString(this.state.date);


        var v = await axios.get(`/api/attendance/daily-attendance/teachers/getTeachers`,{
            params:{
                department_id :departmentId
            }
        });
        console.log(v);

        var selectTeachersList=[];
        for(var i=0;i<v.data.length;i++){
            selectTeachersList.push(true);
        }

        this.setState({"session":value,teacherList:v.data,selectTeachersList:selectTeachersList});
    }
    getDateString(str){
        return dateformatter( str,'dd-mm-yyyy')
    }
    render() {


        if(this.state.date){

            var formattedDate=  this.getDateString(this.state.date);

        }

        return (
            <div>
                <div className="card border-info mt-4">
                    <div className="card-header text-white bg-info">Select Department </div>
                    <div className="card-body">
                        <div className="form-group row">
                            <div className="col-md-3 mb-3">
                                <label htmlFor="fee_structure" className="col-form-label">Select Department</label>
                                <select value={this.state.department} id="fee_structure"  className="custom-select form-control" name="fee_structure"
                                        onChange={ (event)=> this.setDepartment(event.target.value)}>
                                    <option value="">Class</option>
                                    { this.state.departmentOptions.map( val => (
                                        <option key={val.id} value={val.id}>{val.department_name}</option>
                                    ) ) }
                                </select>

                            </div>

                            {this.state.department ?
                                <div className="col-md-2 mb-3">
                                    <label
                                        className="col-md-12 col-form-label pl-0"
                                    >Select Date</label>
                                    <DatePicker
                                        className="form-control"
                                        name="Instalment[]"
                                        selected={this.state.date}
                                        dateFormat="dd-M-yyyy"

                                        onChange={(date => {this.setState({date:date,teacherList:[],session:""})})}
                                    />
                                </div>
                                : " "
                            }

                            {this.state.date && this.state.department ?
                                <div className="col-md-3 mb-3">
                                    <label htmlFor="fee_structure" className="col-form-label">Select Session</label>
                                    <select value={this.state.session} id="fee_structure" className=" custom-select form-control"
                                            name="fee_structure"
                                            onChange={(event) => this.getTeachers(event.target.value)}>
                                        <option value="">Session</option>

                                        <option  value="Morning">Morning</option>
                                        <option  value="After-Noon">After-Noon</option>
                                    </select>


                                </div>
                                : " "
                            }

                        </div>

                    </div>

                </div>

                {this.state.teacherList.length ?
                    <form action="/attendance/daily-attendance/teachers/submit" method="post" >
                        <div className="card border-orange mt-4 mb-4">
                            <div className="card-header text-white bg-orange">Student List</div>

                            <div className="card-body">

                                <input type="hidden" name="_token" value={csrf_token} />
                                <input type="hidden" name="department" value={this.state.department}/>
                                <input type="hidden" name="date" value={formattedDate}/>
                                <input type="hidden" name="session" value={this.state.session}/>


                                <table ref={el => this.el = el} className="table table-bordered  table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>email</th>

                                        <th>role</th>
                                        <th>status</th>

                                        <th>
                                            <div className="custom-control  custom-checkbox">
                                                <input type="checkbox" className=" bg-success custom-control-input" id="selectAll"
                                                       checked={this.state.selectAll}
                                                       onChange={(event) => this.selectAll(event) }
                                                       value="val"
                                                /><label className="custom-control-label" htmlFor="selectAll">Select All</label>


                                            </div>
                                        </th>



                                    </tr>
                                    </thead>
                                    <tbody>
                                    { this.state.teacherList.map( (val,index) => (
                                        <tr key={val.id}>
                                            <td>{val.name}</td>

                                            <td>{val.email}</td>
                                            <td>{val.role}</td>
                                            <th>
                                                {this.state.selectTeachersList[index]?
                                                    <h5>  <span className="badge badge-pill badge-secondary badge-success" >Present </span></h5>:
                                                    <h5> <span className="badge badge-pill badge-secondary badge-danger" >Absent </span></h5>
                                                }
                                            </th>

                                            <td>

                                                <div className="custom-control custom-checkbox">


                                                    <input type="checkbox" className="custom-control-input" id={"selectTeachersList"+index}
                                                           name="selectTeachersList[]" value={val.id} checked={this.state.selectTeachersList[index]}
                                                           onChange={()=>this.changeSelection(index)}
                                                    />
                                                    <label className="custom-control-label" htmlFor={"selectTeachersList"+index}> Present</label>

                                                </div>

                                            </td>

                                        </tr>
                                    ))}


                                    </tbody>

                                </table>


                            </div>

                            <div className="card-footer bg-orange" >

                                <button type="submit" className="btn float-right btn-primary" >
                                    Save Changes
                                </button>

                            </div>

                        </div>
                    </form>
                    :
                    ""
                }
            </div>
        );

    };
}

export default TeacherAttendance;


