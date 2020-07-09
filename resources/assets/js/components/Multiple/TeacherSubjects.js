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
            studentMarksList:[]


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
        console.log(res.data);
        this.setState({classId:class_id,
            className:className,
            subjectId:subject_id,
            sectionId:section_id,
            classExams:res.data
        })
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
        for(let i=0;i<res.data.length;i++){
            arr.push(0);
        }
        this.setState({exam:exam_id,studentList:res.data,studentMarksList:arr})
    }

    async submitMarks(marks,student_id){
        console.log(marks);
        console.log(this.state.studentMarksList);
        var res = await axios.get(`/api/exam_marks/submit_marks`, {
            params:{
                exam_id : this.state.exam,
                section_id:this.state.sectionId,
                subject_id:this.state.subjectId,
                student_id:student_id,
                marks:marks,
                max_marks:this.state.maxMarks
            }

        });
        let arr =[];
        for(let i=0;i<res.data.length;i++){
            arr.push(0);
        }
        this.setState({studentList:res.data,studentMarksList:arr})
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

        for(let i=0;i<res.data.length;i++){
            arr.push(0);


        }
        this.setState({studentList:res.data,studentMarksList:arr})
    }
    changeMarks(index,value){
        let studentMarksList = this.state.studentMarksList;
        studentMarksList[index] = value;
        this.setState({studentMarksList: studentMarksList});
    }



    render() {

        return (

            <React.Fragment>

                {
                    this.state.mySubjectsLoading?
                    <Loader></Loader> :
                        <React.Fragment>
                            {
                                this.state.mySubjects ?
                                    <div className="card border-dark mt-4">
                                        <div className="card-header text-white bg-dark"> My Subjects</div>
                                        <div className="card-body">

                                            <ul className="list-group col-12">
                                                {this.state.mySubjects.map( (val,index) => (

                                                    <li key={index} className="list-group-item ">
                                                        <div className="row">
                                                            <span className="col-2 d-flex justify-content-between align-items-center"> {val.name}</span>
                                                            <span className="col-2 d-flex justify-content-between align-items-center">Class - {val.class_number}</span>
                                                            <span className="col-2 d-flex justify-content-between align-items-center">Section - {val.section_number}</span>

                                                            <span className="col-2 d-flex justify-content-between align-items-center">
                                                                    <button className="btn btn-sm btn-info" onClick={( )=>{ this.getExams(val.subject_id,val.class_id,val.section_id,val.class_number)}} >
                                                                            Assign Marks
                                                                        </button>
                                                            </span>

                                                            <span className="col-2 d-flex justify-content-between align-items-center">
                                                                    <button className="btn btn-sm btn-warning" onClick={( )=>{ }} >
                                                                            View
                                                                    </button>
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
                                        <div className="col-md-4 ">
                                            <label htmlFor="maxValue" className="col-form-label text-danger">Maximum Marks for this
                                                test</label>
                                            <input type="number" value={this.state.maxMarks} id="maxValue"
                                                   className="form-control" min={0}
                                                   onChange={(event) => this.setState({maxMarks: event.target.value})}/>
                                        </div>:""
                                    }
                                </div>
                                {
                                    this.state.exam ?



                                        <ul className="list-group col-12 m-3">
                                            {this.state.studentList.map( (val,index) => (

                                                <li key={index} className="list-group-item ">
                                                    <div className="row">
                                                        <span className="col-2 d-flex justify-content-between align-items-center"> {val.name}</span>
                                                        <span className="col-2 d-flex justify-content-between align-items-center">{val.student_code}</span>
                                                        {val.id ==null ?
                                                            <React.Fragment>
                                                                <form className="form-row col-5" onSubmit={(event => {event.preventDefault();this.submitMarks(this.state.studentMarksList[index],val.student_user_id) })}>
                                                                    <span className="col-5 d-flex justify-content-between align-items-center">

                                                                            <input
                                                                            type="number" className="form-control col-9" aria-label="Small" min={0} max={this.state.maxMarks}
                                                                            aria-describedby="inputGroup-sizing-sm" value={this.state.studentMarksList[index] || 0}
                                                                            onChange={(event => this.changeMarks(index,event.target.value))} required name="marks"

                                                                            /> <span >/</span> <span>{this.state.maxMarks}</span>
                                                                    </span>



                                                                    <span className="col-4 d-flex justify-content-between align-items-center">
                                                                            <button className="btn btn-sm btn-success" onClick={( )=>{ }} >
                                                                                    Submit
                                                                                </button>
                                                                    </span>
                                                                </form>
                                                            </React.Fragment>
                                                        :

                                                            <React.Fragment>
                                                                 <span className="col-2 d-flex justify-content-between align-items-center"> {val.marks} / {val.max_marks} </span>
                                                                    <span className="col-2 d-flex justify-content-between align-items-center">
                                                                                <button className="btn btn-sm btn-danger" onClick={( )=>{ this.removeMarks(val.id)}} >
                                                                                        Remove
                                                                                </button>
                                                                        </span>
                                                            </React.Fragment>
                                                        }
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
