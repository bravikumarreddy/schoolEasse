import React from 'react';
import Loader from './Components/Loader'
import axios from "axios";

class TeacherSubjects extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            mySubjects:[],
            mySubjectsLoading:false,
            subjectId:"",
            classId:"",
            className:"",
            sectionId:"",
            classExams:[],
            exam:"",
            studentList:[],
            maxMarks:0,
            studentMarksList:[],
            gradeList:[],
            gradeSystems:{},
            gradeSystem:"",


        }
        this.getExams = this.getExams.bind(this);
        this.changeMarks = this.changeMarks.bind(this);
        this.getStudents = this.getStudents.bind(this);
        this.submitMarks = this.submitMarks.bind(this);
        this.removeMarks = this.removeMarks.bind(this);

    }

    async componentDidMount() {
        this.setState({mySubjectsLoading:true} );
        var res = await axios.get(`/api/teacher_subjects/my_subjects`);
        this.setState({mySubjects:res.data,mySubjectsLoading:false});
    }

    async getExams(subject_id,class_id,section_id,className){
        this.setState({exam:"",maxMarks:0});
        var res = await axios.get(`/api/class_exams`,{
            params:{
                class_id : class_id,
            }

        });
        let gradeSystems = await axios.get(`/api/exams/grade-system/get`);

        this.setState({classId:class_id,
            className:className,
            subjectId:subject_id,
            sectionId:section_id,
            gradeSystems:gradeSystems.data,
            classExams:res.data
        })
        console.log(gradeSystems.data);
        window.scrollTo({
            top: document.body.scrollHeight,
            left: 0,
            behavior: 'smooth'
        });
    }

    async getStudents(exam_id){

        var res = await axios.get(`/api/exam_marks/get_students`, {
            params:{
                exam_id : exam_id,
                section_id:this.state.sectionId,
                subject_id:this.state.subjectId,

            }

        });
        let arr =[];
        let gradeList = [];

        for(let i=0;i<res.data.length;i++){
            arr.push(0);
            gradeList.push("None")
        }
        this.setState({exam:exam_id,studentList:res.data,studentMarksList:arr,gradeList:gradeList})

    }

    async submitMarks(marks,student_id,grade ){
        console.log(marks);
        console.log(this.state.studentMarksList);
        var res = await axios.get(`/api/exam_marks/submit_marks`, {
            params:{
                exam_id : this.state.exam,
                section_id:this.state.sectionId,
                subject_id:this.state.subjectId,
                student_id:student_id,
                marks:marks,
                grade:grade,
                max_marks:this.state.maxMarks
            }

        });
        let arr =[];
        let gradeList = [];

        for(let i=0;i<res.data.length;i++){
            arr.push(0);
            gradeList.push("None")
        }
        this.setState({studentList:res.data,studentMarksList:arr,gradeList:gradeList})
    }
    async removeMarks(id){

        var res = await axios.get(`/api/exam_marks/remove_marks`, {
            params:{
                exam_id : this.state.exam,
                section_id:this.state.sectionId,
                subject_id:this.state.subjectId,
                record_id:id
            }

        });
        let arr =[];
        let gradeList = [];

        for(let i=0;i<res.data.length;i++){
            arr.push(0);
            gradeList.push("None")
        }
        this.setState({studentList:res.data,studentMarksList:arr,gradeList:gradeList})
    }
    changeMarks(index,value){
        let studentMarksList = this.state.studentMarksList;
        let gradeList = this.state.gradeList;
        let maxMarks = parseFloat(this.state.maxMarks);
        let grade = 'None'
        console.log(maxMarks);
        if( maxMarks != 0){
            var percent = (parseFloat(value)/maxMarks) * 100 ;
            console.log(percent);
            if(this.state.gradeSystem){
                console.log(this.state.gradeSystem)
              let gradeSystem = this.state.gradeSystems[this.state.gradeSystem];
                for(let i=0;i<gradeSystem.length; i++ ){
                    if(percent >= parseFloat(gradeSystem[i].from) && percent < parseFloat(gradeSystem[i].to)){
                        grade = gradeSystem[i].grade
                    }
                }
            }
        }
        studentMarksList[index] = value;
        gradeList[index] = grade;
        console.log(gradeList,grade);
        this.setState({studentMarksList: studentMarksList,gradeList:gradeList});
    }



    render() {
        let gradeSystems = this.state.gradeSystems;
        let gradeSystemsKeys = Object.keys(this.state.gradeSystems);
        console.log(gradeSystemsKeys);
        return (

            <React.Fragment>

                {
                    this.state.mySubjectsLoading?
                    <Loader></Loader> :
                        <React.Fragment>
                            {
                                this.state.mySubjects ?
                                    <div className="card border-dark mb-5 mt-4">
                                        <div className="card-header text-white bg-dark "> My Subjects</div>
                                        <div className="card-body">

                                            <ul className="list-group col-12">
                                                {this.state.mySubjects.map( (val,index) => (

                                                    <li key={index} className="list-group-item ">
                                                        <div className="row">
                                                            <span className="col-2 d-flex justify-content-between align-items-center"> {val.name}</span>
                                                            <span className="col-2 d-flex justify-content-between align-items-center">Class - {val.class_number}</span>
                                                            <span className="col-2 d-flex justify-content-between align-items-center">Section - {val.section_number}</span>

                                                            <span className="col-2 d-flex justify-content-between align-items-center">
                                                                    <button className="btn btn-sm btn-success" onClick={( )=>{ this.getExams(val.subject_id,val.class_id,val.section_id,val.class_number)}} >
                                                                            Assign Marks
                                                                        </button>
                                                            </span>

                                                            <span className="col-2 d-flex justify-content-between align-items-center">
                                                                    <a className="btn btn-sm btn-orange" href={`attendance/daily-attendance/${val.class_id}/${val.section_id}` }  >
                                                                            Take Attendance
                                                                    </a>
                                                            </span>

                                                            <span className="col-2 d-flex justify-content-between align-items-center">
                                                                    <a className="btn btn-sm btn-messenger" href={`/assignment/${val.teacher_subject_id}` }  >
                                                                            Assignments
                                                                    </a>
                                                            </span>

                                                            </div>
                                                    </li>

                                                ))}
                                            </ul>






                                        </div>

                                    </div>
                                    :

                                    " No subjects are assigned "
                            }
                        </React.Fragment>
                }
                {
                    this.state.classId ?
                        <div className="card border-indigo mt-4 mb-5">
                        <div className="card-header text-white bg-indigo">Class {this.state.className} </div>
                            <div className="card-body">
                                <div className="row m-1">
                                    <div className="col-md-4 ">
                                        <label htmlFor="classExams" className="col-form-label">Select exam to assign Marks</label>
                                        <select value={this.state.exam} id="classExams"  className="form-control custom-select" name="teachers"
                                                onChange={ (event)=> { this.getStudents(event.target.value )}} required>
                                            <option value="">Teacher</option>
                                            {
                                                this.state.classExams.map( val => (
                                                    <option key={val.id} value={val.id}>{val.exam_name}</option>

                                                ) )
                                            }
                                        </select>
                                    </div>
                                    {
                                        this.state.exam
                                            ?
                                            <React.Fragment>
                                                <div className="col-md-4 ">

                                                    <label htmlFor="maxValue" className="col-form-label text-danger">Maximum
                                                        Marks for this
                                                        test</label>
                                                    <input type="number" value={this.state.maxMarks} id="maxValue"
                                                           className="form-control" min={0}
                                                           onChange={(event) => this.setState({maxMarks: event.target.value})}
                                                    />

                                                </div>
                                                <div className="col-md-4 mb-3">
                                                    <label htmlFor="fee_structure" className="col-form-label">Select Grade System</label>
                                                    <select value={this.state.gradeSystem} id="fee_structure"
                                                            className="form-control custom-select" name="fee_structure"
                                                            onChange={(event) => this.setState({gradeSystem: event.target.value})}>
                                                        <option value="">Grade System</option>
                                                        {gradeSystemsKeys.map(val => (
                                                            <option key={val} value={val}>{gradeSystems[val][0].grade_system_name}</option>
                                                        ))}
                                                    </select>

                                                </div>


                                            </React.Fragment>:""
                                    }
                                </div>
                                {
                                    this.state.exam ?



                                        <ul className="list-group col-12 m-3">
                                            <li  className="list-group-item ">

                                                <div className="row">
                                                    <form className="form-row col-12 m-0 b-0 ">
                                                <span
                                                    className="col-2 d-flex justify-content-between align-items-center text-center"> <b>Name</b> </span>
                                                <span
                                                    className="col-2 d-flex justify-content-between align-items-center"> <b>Code</b> </span>
                                                <span
                                                    className="col-4 d-flex justify-content-between align-items-center"> <b>marks / maxMarks </b></span>

                                                <span
                                                    className="col-2 d-flex justify-content-between align-items-center"> <b>Grade </b></span>
                                                <span
                                                    className="col-2 d-flex justify-content-between align-items-center"> <b>Action</b> </span>
                                                    </form>
                                                </div>

                                            </li>
                                            {this.state.studentList.map( (val,index) => (

                                                <li key={index} className="list-group-item ">
                                                    <div className="row text-center">
                                                        <form className="form-row col-12 m-0 b-0 " onSubmit={(event => {event.preventDefault();this.submitMarks(this.state.studentMarksList[index],val.student_user_id,this.state.gradeList[index]) })}>
                                                        <span className="col-2 d-flex justify-content-between align-items-center"> {val.name}</span>
                                                        <span className="col-2 d-flex justify-content-between align-items-center">{val.student_code}</span>
                                                        {val.id == null ?
                                                            <React.Fragment>
                                                                <div className="input-group col-4  pr-3 d-flex justify-content-between align-items-center">
                                                                            <input type="hidden" name="grade" value={this.state.gradeList[index]} />
                                                                            <input
                                                                            type="number" className="form-control" aria-label="Small" min={0} max={this.state.maxMarks}
                                                                            aria-describedby="inputGroup-sizing-sm" value={this.state.studentMarksList[index] || 0}
                                                                            onChange={(event => this.changeMarks(index,event.target.value))} required name="marks"

                                                                            />
                                                                    <div className="input-group-append">
                                                                            <span class="input-group-text" >/</span> <span class="input-group-text">{this.state.maxMarks}</span>
                                                                    </div>
                                                                </div>


                                                                    <span className="col-2 d-flex justify-content-between align-items-center">{this.state.gradeList[index]}</span>

                                                                    <span className="col-2 d-flex justify-content-between align-items-center">
                                                                            <button className="btn btn-sm btn-success" onClick={( )=>{ }} >
                                                                                    Submit
                                                                                </button>
                                                                    </span>

                                                            </React.Fragment>
                                                        :

                                                            <React.Fragment>
                                                                 <span className="col-4 d-flex justify-content-between align-items-center"> {val.marks} / {val.max_marks} </span>
                                                                <span className="col-2 d-flex justify-content-between align-items-center">{val.grade}</span>
                                                                <span className="col-2 d-flex justify-content-between align-items-center">
                                                                                <button className="btn btn-sm btn-danger" onClick={( )=>{ this.removeMarks(val.id)}} >
                                                                                        Remove
                                                                                </button>
                                                                        </span>

                                                            </React.Fragment>
                                                        }
                                                        </form>
                                                    </div>
                                                </li>

                                            ))}
                                        </ul>


                                        :


                                        ""
                                }
                            </div>
                        </div>
                        :
                        ""


                }



            </React.Fragment>
        )
    }
}

export default TeacherSubjects;
