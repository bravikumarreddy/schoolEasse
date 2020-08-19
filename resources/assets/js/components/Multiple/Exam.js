import React from 'react';
import axios from "axios";
import Loader from "./Components/Loader";


class Exam extends React.Component {

    constructor(props) {
        super(props);

        this.state= {
            classes: "",
            class: "",
            classLoading: false,
            className: "",
            classExams:[],
            createExamName:""
        }
        this.getClasses = this.getClasses.bind(this);
        this.getExams = this.getExams.bind(this);
        this.deleteExam = this.deleteExam.bind(this);
        this.createExam = this.createExam.bind(this);
    }

    componentDidMount() {
        this.getClasses();
    }

    async getClasses(){
        var res = await axios.get(`/api/classes`);
        console.log(res.data);
        this.setState({classes:res.data});


    }
    async getExams(class_id,className){

        this.setState({className:className,classLoading:true });

        let res = await axios.get(`/api/class_exams`,{
            params:{
                class_id : class_id,
            }

        });


        console.log(res.data);
        this.setState({class:class_id,classExams:res.data, classLoading:false});

    }
    async deleteExam(exam_id){
        this.setState({classLoading:true});
        var res = await axios.get(`/api/class_exams/delete`,{
            params:{
                class_id : this.state.class,
                exam_id : exam_id
            }

        });

        console.log(res.data);
        this.setState({classExams:res.data,classLoading:false});
    }

    async createExam(){
        this.setState({classLoading:true});
        var res = await axios.get(`/api/class_exams/create`,{
            params:{
                class_id : this.state.class,
                exam_name : this.state.createExamName
            }

        });

        console.log(res.data);
        this.setState({classExams:res.data,classLoading:false});
    }



    render() {

        return (
            <div>
                {
                    this.state.classes ?

                        <div className="card border-info mt-4">
                            <div className="card-header text-white bg-info">Select Class</div>
                            <div className="card-body">
                                <div className="form-group row">
                                    <div className="col-md-4 ">
                                        <label htmlFor="fee_structure" className="col-form-label">Select Class</label>
                                        <select value={this.state.class} id="fee_structure"  className="form-control custom-select" name="fee_structure"
                                                onChange={ (event)=> { this.getExams(event.target.value,event.target.options[event.target.options.selectedIndex].text) } }>
                                            <option value="">Class</option>
                                            {
                                                this.state.classes.map( val => (
                                                    <option key={val.id} value={val.id}>{val.class_number}</option>

                                                ) ) }
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>:

                        <Loader/>

                }
                {
                    this.state.classLoading ?
                        <Loader></Loader>
                        :
                        <React.Fragment>
                            {
                                this.state.class ?
                                    <div className="card border-orange mt-4">
                                        <div className="card-header text-white bg-orange">Class {this.state.className} - Exams</div>
                                        <div className="card-body">

                                            <ul className="list-group col-12 ">
                                                {this.state.classExams.map( val => (

                                                    <li key={val.id} className="list-group-item d-flex justify-content-between align-items-center ">
                                                        <span className="col-sm-auto">{val.exam_name}</span>

                                                        <button className="btn btn-sm btn-danger ml-2" onClick={( )=>{this.deleteExam(val.id)}} >
                                                            Delete
                                                        </button>

                                                    </li>

                                                ))}
                                            </ul>


                                            <div className="col-5 p-0 mt-4">

                                                <form className="form-inline " onSubmit={(event)=> {event.preventDefault(); this.createExam()} }>

                                                    <div className="form-group">

                                                        <input type="text" className="form-control" id="createSubjectName"
                                                               placeholder="Exam name"  value={this.state.createExamName} required
                                                               onChange={event => this.setState({createExamName:event.target.value})}/>
                                                    </div>
                                                    <button type="submit"  className="btn btn-success ml-2 ">
                                                        Create Exam
                                                    </button>

                                                </form>
                                            </div>

                                        </div>

                                    </div>:""


                            }

                        </React.Fragment>
                }
            </div>
        )
    }
}

export default Exam;
