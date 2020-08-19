import React from 'react';
import Loader from './Components/Loader'
import axios from "axios";
import FullCalendar from '@fullcalendar/react'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import "react-datepicker/dist/react-datepicker.css";
import DatePicker from "react-datepicker";
import listPlugin from '@fullcalendar/list';
class TimeTable extends React.Component {

    constructor(props) {
        super(props);

        this.state={
            classes:[],
            class:"",
            sectionOptions:[],
            section:"",
            sectionName:"",

            filterText:"",
            teachersLoading:"",
            teacherSubjects:[],
            teacher_subject:"",
            teacherEvents:[],
            classEvents:[],
            dayOfTheWeek:"",
            from:"",
            teacher:"",
            to:"",
            teacherLoading:false
        }
        this.getSectionsClasses = this.getSectionsClasses.bind(this);
        this.getTimeTable = this.getTimeTable.bind(this);
        this.getClasses = this.getClasses.bind(this);
        this.getTeacherSubjects =  this.getTeacherSubjects.bind(this);
        this.createTimeTable = this.createTimeTable.bind(this);
        this.deleteTimeTable = this.deleteTimeTable.bind(this);
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

    addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    async getTeacherSubjects(section_id,section_name){
        console.log(section_id,section_name);
        this.setState({teachersLoading:true});
        var res = await axios.get(`/api/teacher_subjects`,{
            params:{
                section_id : section_id
            }
        });

        this.setState({teachersLoading:false,section:section_id,sectionName:section_name,teacherSubjects:res.data})

        console.log(res);
    }

    async getSectionsClasses(value){
        this.setState({section:""})
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
    async getTimeTable(value,teacher_id){

        this.setState({"teacher_subject": value,"teacher":teacher_id,"teacherLoading":true});
        let teacherEvents= await axios.get(`/api/time_table/teacher`, {
            params: {
                teacher_id: teacher_id,
                }
            }
        )
        console.log(teacherEvents);
        let classEvents= await axios.get(`/api/time_table/class`, {
                params: {
                    section_id: this.state.section,
                }
            }
        )
        console.log(classEvents);

        this.setState({"classEvents":classEvents.data , teacherEvents:teacherEvents.data,"teacherLoading":false});


    }

    async deleteTimeTable(id){
        console.log("delete Time Table")
        let teacherEvents= await axios.get(`/api/time_table/delete`, {
                params: {
                    time_table_id: id,
                }
            }
        )

        await this.getTimeTable(this.state.teacher_subject,this.state.teacher);

    }

    async createTimeTable(){
        let fromDate = new Date(this.state.from);
        let toDate = new Date(this.state.to);
        let from = `${this.addZero( fromDate.getHours())}:${this.addZero( fromDate.getMinutes())}`;
        let to = `${this.addZero(toDate.getHours())}:${this.addZero( toDate.getMinutes()) }`
        let v= await axios.get(`/api/time_table/create`,{
            params:{
                teacher_id:this.state.teacher,
                section_id : this.state.section,
                teacher_subjects_id:this.state.teacher_subject,
                from:from,
                to:to,
                day_of_the_week:this.state.dayOfTheWeek

            }
        });

        await this.getTimeTable(this.state.teacher_subject,this.state.teacher);


    }

    render() {
        const classes = this.state.classes;
        let teacherEvents =[];
        for(let i=0;i<this.state.teacherEvents.length;i++){
            teacherEvents.push({
                title:`c - ${this.state.teacherEvents[i].class_number} s - ${this.state.teacherEvents[i].section_number} ${this.state.teacherEvents[i].name} `,
                daysOfWeek: [this.state.teacherEvents[i].day_of_the_week],
                startTime:this.state.teacherEvents[i].from,
                endTime:this.state.teacherEvents[i].to
            })
        }

        let classEvents =[];
        for(let i=0;i<this.state.classEvents.length;i++){
            classEvents.push({
                title:` ${this.state.classEvents[i].name} (${this.state.classEvents[i].teacher_name})`,
                daysOfWeek: [this.state.classEvents[i].day_of_the_week],
                startTime:this.state.classEvents[i].from,
                endTime:this.state.classEvents[i].to
            })
        }
        var weekday = new Array(7);
        weekday[0] = "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";



        return (
            <React.Fragment>
                {this.state.classes ?
                    <div>
                        <h4>Class Time Table</h4>
                        <div className="card border-info mt-4 mb-3" >
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
                                                    onChange={(event) => this.getTeacherSubjects(event.target.value,event.target.options[event.target.options.selectedIndex].text)}>
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
                        {this.state.teacherSubjects.length && this.state.section?


                            <div className='m-3'>
                                <ul className="list-group col-10">
                                    {this.state.teacherSubjects.map(val => (

                                        <li key={val.teacher_subject_id} className="list-group-item">

                                            <div className="row justify-content-between align-items-center">
                                                <div className="col-sm-auto m-2">
                                                    {val.name}
                                                </div>
                                                <div className="col-sm-auto m-2">
                                                    {val.teacher_id ?
                                                        <span>{val.teacher_name} </span>
                                                        :
                                                        <span className="text-danger">Teacher not assigned</span>

                                                    }
                                                </div>
                                                <div className="col-sm-auto m-2">
                                                    {val.teacher_id ?
                                                        <button type="button" className="btn btn-sm btn-orange  "  onClick={()=>{this.getTimeTable(val.teacher_subject_id,val.teacher_id)}}>
                                                            Select Teacher
                                                         </button>
                                                        :
                                                        ""

                                                    }
                                                </div>
                                                <div className="col-sm-auto m-2">
                                                    {val.teacher_subject_id == this.state.teacher_subject?
                                                        <h5  >
                                                            <span className="badge badge-pill badge-success">Selected</span>
                                                        </h5>
                                                        :
                                                        ""

                                                    }
                                                </div>
                                            </div>

                                        </li>


                                    ))}
                                </ul>
                            </div>
                            :
                            ""
                        }
                        {
                            this.state.teacherLoading ?
                                <Loader></Loader>:""
                        }
                        {this.state.teacherLoading == false && this.state.teacher ?
                            <React.Fragment>
                                <div className="card border-indigo mt-4 mb-4">
                                    <div className="card-header text-white bg-indigo">Create Time Table</div>
                                    <div className="card-body">

                                        <div className='mt-4 mb-4'>
                                            <ul className="list-group col-10  ">
                                                {this.state.classEvents.map(val => (

                                                    <li key={val.time_table_id} className="list-group-item  d-flex justify-content-between align-items-center">
                                                        <div className="row">


                                                            <div className="col-sm-auto m-2">
                                                                {val.name}
                                                            </div>
                                                            <div className="col-sm-auto m-2">

                                                                <span>{val.teacher_name} </span>


                                                            </div>

                                                            <div className="col-sm-auto m-2">

                                                                <span> {val.from + " - " + val.to} </span>

                                                            </div>
                                                            <div className="col-sm-auto m-2">

                                                                <span> {weekday[val.day_of_the_week]} </span>

                                                            </div>
                                                            <div className="col-sm-auto m-2">

                                                                <button type="button"
                                                                        className="btn btn-sm btn-danger  "
                                                                        onClick={() => {
                                                                            this.deleteTimeTable(val.time_table_id)
                                                                        }}>
                                                                    Delete
                                                                </button>


                                                            </div>


                                                        </div></li>


                                                ))}
                                            </ul>
                                        </div>


                                        <div className="col-5 p-0 mt-4">

                                            <form onSubmit={(event) => {
                                                event.preventDefault();
                                                this.createTimeTable()
                                            }}>

                                                <div className="form-group">
                                                    <div className="col-sm-auto mb-3">
                                                        <label className="col-form-label" htmlFor="week">Day of the
                                                            week</label>
                                                        <select value={this.state.dayOfTheWeek} id="week"
                                                                className="form-control"
                                                                onChange={(event) => this.setState({dayOfTheWeek: event.target.value})}
                                                                required>
                                                            <option value="">Select</option>
                                                            <option value="0">Sunday</option>
                                                            <option value="1">Monday</option>
                                                            <option value="2">Tuesday</option>
                                                            <option value="3">Wednesday</option>
                                                            <option value="4">Thursday</option>
                                                            <option value="5">Friday</option>
                                                            <option value="6">Saturday</option>
                                                        </select>
                                                    </div>
                                                    <div className="col-sm-auto mb-3">
                                                        <label className=" d-inline-block pl-0 col-form-label" htmlFor="from">From</label>
                                                    <br/>
                                                        <DatePicker
                                                            selected={this.state.from}
                                                            onChange={(value) => this.setState({from: value})}
                                                            showTimeSelect
                                                            showTimeSelectOnly
                                                            timeIntervals={15}
                                                            timeCaption="Time"
                                                            dateFormat="h:mm aa"
                                                            className="form-control"
                                                            required={true}
                                                        />

                                                    </div>
                                                    <div className="col-sm-auto mb-3">
                                                        <label className=" d-inline-block pl-0 col-form-label" htmlFor="to">To</label>
                                                        <br/>
                                                        <DatePicker
                                                            selected={this.state.to}
                                                            onChange={(value) => this.setState({to: value})}
                                                            showTimeSelect
                                                            showTimeSelectOnly
                                                            timeIntervals={15}
                                                            timeCaption="Time"
                                                            dateFormat="h:mm aa"
                                                            className="form-control"
                                                            required={true}
                                                        />

                                                    </div>
                                                </div>

                                                <button type="submit" className="btn btn-success ml-3 ">
                                                    Create time table
                                                </button>

                                            </form>
                                        </div>


                                    </div>

                                </div>
                                <div className='row justify-content-center'>

                                    <div className='card col-sm-12 col-md-10 border-0 m-3'>
                                        <h4 className="card-header"> Teacher Time Table</h4>
                                        <div className='card-body'>

                                            <FullCalendar
                                                plugins={[timeGridPlugin, listPlugin]}
                                                initialView="timeGridWeek"
                                                themeSystem='bootstrap'
                                                expandRows={true}
                                                slotEventOverlap={true}

                                                scrollTime='09:00:00'
                                                titleFormat={{
                                                    month: 'short',
                                                    year: '2-digit',

                                                }}

                                                headerToolbar={
                                                    {
                                                        left: 'prev,next today',
                                                        center: 'title',
                                                        right:""

                                                    }
                                                }
                                                footerToolbar={
                                                    {
                                                        center: 'timeGridWeek,timeGridDay,listWeek',
                                                        right:""
                                                    }
                                                }
                                                events={
                                                    teacherEvents
                                                }
                                            />

                                        </div>
                                    </div>

                                    <div className='card  col-sm-12 col-md-10 border-0 m-3'>
                                        <h4 className="card-header"> Class Time Table</h4>
                                        <div className='card-body'>

                                            <FullCalendar
                                                plugins={[timeGridPlugin, listPlugin]}
                                                initialView="timeGridWeek"
                                                themeSystem='bootstrap'
                                                expandRows={true}
                                                slotEventOverlap={true}
                                                scrollTime='09:00:00'
                                                headerToolbar={
                                                    {
                                                        left: 'prev,next today',
                                                        center: 'title',
                                                        right:""

                                                    }
                                                }

                                                titleFormat={{
                                                    month: 'short',
                                                    year: '2-digit',
                                                }}

                                                footerToolbar={
                                                    {
                                                        center: 'timeGridWeek,timeGridDay,listWeek'
                                                    }
                                                }

                                                events={
                                                    classEvents
                                                }
                                            />

                                        </div>
                                    </div>

                                </div>




                            </React.Fragment>:""
                        }

                    </div>:
                    <Loader></Loader>
                }
            </React.Fragment>
        )
    }
}


export default TimeTable;
