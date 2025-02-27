import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import $ from 'jquery';
import dateformatter from 'dateformat';

class DailyAttendance extends React.Component {

    constructor(props) {
        super(props)
        this.state={
            class:"",
            sectionOptions:[],
            section:"",
            session:"",
            studentList:[],
            selectAll:true,
            selectStudentsList:[],
            date:Date.now(),
            checkAttendance:null

        }
        console.log(this.props)

        this.getSectionsClasses = this.getSectionsClasses.bind(this);
        this.getStudents = this.getStudents.bind(this);
        this.selectAll = this.selectAll.bind(this);
        this.setSection = this.setSection.bind(this);
        this.changeSelection = this.changeSelection.bind(this);
        this.getDateString = this.getDateString.bind(this);
    }

    async componentDidMount() {
        if(this.props.class_id){
            this.setState({class:this.props.class_id});
        }

        await this.getSectionsClasses(this.props.class_id);

        if(this.props.section_id){
            this.setState({section:this.props.section_id});
        }
    }

    selectAll(event){
        var selectStudentsList=[];
        for(var i=0;i<this.state.selectStudentsList.length;i++){
            selectStudentsList.push(!this.state.selectAll);
        }
        console.log((event.target.value))
        this.setState({"selectAll":!this.state.selectAll,selectStudentsList:selectStudentsList});
    }

    async getSectionsClasses(value){
        if(value==""){
            this.setState({"class":value,"studentList":[]});
            return;
        }
        let v= await axios.get(`/api/sections`,{
            params:{
                class_id : value,
            }

        });
        console.log(v.data);
        this.setState({"class":value,"sectionOptions":v.data,"section":"","studentList":[]});

    }
    async setSection(value){
        console.log(value)
        this.setState({"section":value,"studentList":[],date:Date.now()});
    }
    changeSelection(index){
        var selectStudentsList = this.state.selectStudentsList;
        selectStudentsList[index] = !this.state.selectStudentsList[index];
        this.setState({selectStudentsList:selectStudentsList});
    }
    async getStudents(value){
        if(value==""){
            this.setState({"session":value,"studentList":[]});
            return;
        }
        const classId= this.state.class;
        const sectionId =  this.state.section;
        const session =  value
        const date =  this.state.date

        var checkAttendance = await axios.get(`/api/attendance/daily-attendance/checkAttendance`,{
            params:{
                section_id : sectionId,
                session:session,
                date:dateformatter( date,'dd-mm-yyyy')
            }
        });
        this.setState({checkAttendance:checkAttendance.data});
        console.log(checkAttendance)

        var v = await axios.get(`/api/students/${sectionId}`);
        console.log(v);

        var selectStudentsList=[];
        for(var i=0;i<v.data.length;i++){
            selectStudentsList.push(true);
        }

        this.setState({"session":value,studentList:v.data,selectStudentsList:selectStudentsList});
    }

    getDateString(str){
        return dateformatter( str,'dd-mm-yyyy')
    }

    render() {
        const classes = JSON.parse(this.props.classes);
        // console.log(this.state.date);
        // console.log(new Date());
         if(this.state.date){

             var formattedDate=  this.getDateString(this.state.date);

         }

        return (
            <div>
                <div className="card border-info mt-4 mb-3">
                    <div className="card-header text-white bg-info">Select Class And Section</div>
                    <div className="card-body">
                        <div className="form-group row">
                            <div className="col-md-3 mb-3">
                                <label htmlFor="fee_structure" className="col-form-label">Select Class</label>
                                <select value={this.state.class} id="fee_structure"  className="custom-select form-control" name="fee_structure"
                                        onChange={ (event)=> this.getSectionsClasses(event.target.value)}>
                                    <option value="">Class</option>
                                    { classes.map( val => (
                                        <option key={val.id} value={val.id}>{val.class_number}</option>
                                    ) ) }
                                </select>

                            </div>
                            {this.state.class ?
                                <div className="col-md-3 mb-3">
                                    <label htmlFor="fee_structure" className="col-form-label">Select Section</label>
                                    <select value={this.state.section} id="fee_structure" className=" custom-select form-control"
                                            name="fee_structure"
                                            onChange={(event) => this.setSection(event.target.value)}>
                                        <option value="">Section</option>
                                        {this.state.sectionOptions.map(val => (
                                            <option key={val.id} value={val.id}>{val.section_number}</option>
                                        ))}
                                    </select>


                                </div>
                                : " "
                            }
                            {this.state.section ?
                                <div className="col-md-2 mb-3">
                                    <label
                                        className="col-md-12 col-form-label pl-0"
                                    >Select Date</label>
                                    <DatePicker
                                        className="form-control"
                                        name="Instalment[]"
                                        selected={this.state.date}
                                        onChange={(date => {this.setState({date:date,studentList:[],session:""})})}
                                        dateFormat="MMMM d, yyyy "
                                    />
                                </div>
                                : " "
                            }

                            {this.state.date && this.state.section ?
                                <div className="col-md-3 mb-3">
                                    <label htmlFor="fee_structure" className="col-form-label">Select Session</label>
                                    <select value={this.state.session} id="fee_structure" className=" custom-select form-control"
                                            name="fee_structure"
                                            onChange={(event) => this.getStudents(event.target.value)}>
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
                {
                    this.state.checkAttendance?
                        <div className="alert alert-danger mt-3 mb-3" role="alert">
                            Attendance already taken by {this.state.checkAttendance}
                        </div>
                        :
                        ""
                }
                {this.state.studentList.length ?
                    <form action="/attendance/daily-attendance/submit" method="post" >
                    <div className="card border-warning mt-4 mb-4">
                        <div className="card-header text-white bg-warning">Student List</div>

                        <div className="card-body">

                            <input type="hidden" name="_token" value={csrf_token} />
                            <input type="hidden" name="section" value={this.state.section}/>
                            <input type="hidden" name="date" value={dateformatter( this.state.date,'dd-mm-yyyy')}/>
                            <input type="hidden" name="session" value={this.state.session}/>


                            <table ref={el => this.el = el} className="table table-bordered table-responsive-sm table-hover">
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
                                    <th>Status</th>
                                    <th>Student Code</th>
                                    <th>Class</th>
                                    <th>Section</th>







                                </tr>
                                </thead>
                                <tbody>
                                { this.state.studentList.map( (val,index) => (
                                    <tr key={val.student_id}>
                                        <td>{val.name}</td>
                                        <td>

                                            <div className="custom-control custom-checkbox">


                                                <input type="checkbox" className="custom-control-input" id={"selectStudent"+index}
                                                       name="selectStudents[]" value={val.student_id} checked={this.state.selectStudentsList[index]}
                                                       onChange={()=>this.changeSelection(index)}
                                                />
                                                <label className="custom-control-label" htmlFor={"selectStudent"+index}> Present</label>

                                            </div>

                                        </td>
                                        <th>
                                            {this.state.selectStudentsList[index]?
                                                <h5>  <span className="badge badge-pill badge-secondary badge-success" >Present </span></h5>:
                                                <h5> <span className="badge badge-pill badge-secondary badge-danger" >Absent </span></h5>
                                            }
                                        </th>
                                        <td>{val.student_code}</td>
                                        <td>{val.class_id}</td>
                                        <td>{val.section_number}</td>




                                    </tr>
                                ))}


                                </tbody>

                            </table>


                        </div>

                        <div className="card-footer bg-warning" >

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

export default DailyAttendance;

if (document.getElementById('daily-attendance')) {
    var classes =  document.getElementById('daily-attendance').getAttribute('classes');
    var class_id =  document.getElementById('daily-attendance').getAttribute('class');
    var section_id =  document.getElementById('daily-attendance').getAttribute('section');
    ReactDOM.render(<DailyAttendance classes={classes} class_id={class_id} section_id={section_id} />, document.getElementById('daily-attendance'));
}
