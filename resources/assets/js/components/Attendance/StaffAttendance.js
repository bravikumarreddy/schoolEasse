import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import $ from 'jquery';
import dateformatter from 'dateformat';
class StaffAttendance extends React.Component {

    constructor(props) {
        super(props)
        this.state={


            session:"",
            staffList:[],
            selectAll:true,
            selectStaffList:[],
            date:Date.now(),
            checkAttendance:null

        }



        this.getStaff = this.getStaff.bind(this);
        this.selectAll = this.selectAll.bind(this);

        this.changeSelection = this.changeSelection.bind(this);
        this.getDateString = this.getDateString.bind(this);
    }



    selectAll(event){
        var selectStaffList=[];
        for(var i=0;i<this.state.selectStaffList.length;i++){
            selectStaffList.push(!this.state.selectAll);
        }
        console.log((event.target.value))
        this.setState({"selectAll":!this.state.selectAll,selectStaffList:selectStaffList});
    }



    changeSelection(index){
        var selectStaffList = this.state.selectStaffList;
        selectStaffList[index] = !this.state.selectStaffList[index];
        this.setState({selectStaffList:selectStaffList});
    }

    async getStaff(value){

        if(value==""){
            this.setState({"session":value,"staffList":[]});
            return;
        }

        const session =  value
        const date =  this.getDateString(this.state.date);


        var v = await axios.get(`/api/attendance/daily-attendance/staff/getStaff`);
        console.log(v);

        var selectStaffList=[];
        for(var i=0;i<v.data.length;i++){
            selectStaffList.push(true);
        }

        this.setState({"session":value,staffList:v.data,selectStaffList:selectStaffList});
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
                <div className="card border-info mt-4 mb-3" >
                    <div className="card-header text-white bg-info">Select Department </div>
                    <div className="card-body">
                        <div className="form-group row">

                                <div className="col-md-2 mb-3">
                                    <label
                                        className="col-md-12 col-form-label pl-0"
                                    >Select Date</label>
                                    <DatePicker
                                        className="form-control"
                                        name="Instalment[]"
                                        selected={this.state.date}
                                        onChange={(date => {this.setState({date:date,staffList:[],session:""})})}
                                    />
                                </div>



                            {this.state.date ?
                                <div className="col-md-3 mb-3">
                                    <label htmlFor="fee_structure" className="col-form-label">Select Session</label>
                                    <select value={this.state.session} id="fee_structure" className=" custom-select form-control"
                                            name="fee_structure"
                                            onChange={(event) => this.getStaff(event.target.value)}>
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

                {this.state.staffList.length ?
                    <form action="/attendance/daily-attendance/staff/submit" method="post" >
                        <div className="card border-orange mt-4 mb-4">
                            <div className="card-header text-white bg-orange">Student List</div>

                            <div className="card-body">

                                <input type="hidden" name="_token" value={csrf_token} />

                                <input type="hidden" name="date" value={formattedDate}/>
                                <input type="hidden" name="session" value={this.state.session}/>


                                <table ref={el => this.el = el} className="table table-bordered table-responsive-sm  table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>
                                            <div className="custom-control  custom-checkbox">
                                                <input type="checkbox" className=" bg-success custom-control-input" id="selectAll"
                                                       checked={this.state.selectAll}
                                                       onChange={(event) => this.selectAll(event) }
                                                       value="val"
                                                /><label className="custom-control-label" htmlFor="selectAll">Select All</label>


                                            </div>
                                        </th>
                                        <th>status</th>
                                        <th>email</th>

                                        <th>role</th>






                                    </tr>
                                    </thead>
                                    <tbody>
                                    { this.state.staffList.map( (val,index) => (
                                        <tr key={val.id}>
                                            <td>{val.name}</td>
                                            <td>

                                                <div className="custom-control custom-checkbox">


                                                    <input type="checkbox" className="custom-control-input" id={"selectStaffList"+index}
                                                           name="selectStaffList[]" value={val.id} checked={this.state.selectStaffList[index]}
                                                           onChange={()=>this.changeSelection(index)}
                                                    />
                                                    <label className="custom-control-label" htmlFor={"selectStaffList"+index}> Present</label>

                                                </div>

                                            </td>
                                            <th>
                                                {this.state.selectStaffList[index]?
                                                    <h5>  <span className="badge badge-pill badge-secondary badge-success" >Present </span></h5>:
                                                    <h5> <span className="badge badge-pill badge-secondary badge-danger" >Absent </span></h5>
                                                }
                                            </th>
                                            <td>{val.email}</td>
                                            <td>{val.role}</td>




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

export default StaffAttendance;


