import React from 'react';
import Loader from './Components/Loader'
import axios from "axios";

class Class extends React.Component {

    constructor(props) {
        super(props);
        this.state={
            classes:"",
            class:"",
            classLoading:false,
            className:"",
            subjects:[],
            createSubjectName:"",
            sections:[],
            section:"",
            sectionName:"",
            teacherSubjects:[],
            teachers:[],
            selectedTeacher:"",
            subjectId:"",
            teachersLoading:false

        }
        this.getClasses = this.getClasses.bind(this);
        this.getSubjects = this.getSubjects.bind(this);
        this.createSubjects = this.createSubjects.bind(this);
        this.deleteSubjects = this.deleteSubjects.bind(this);
        this.getTeacherSubjects =  this.getTeacherSubjects.bind(this);
        this.getTeacherSubjects =  this.getTeacherSubjects.bind(this);
        this.assignTeacher = this.assignTeacher.bind(this);
        this.removeTeacher = this.removeTeacher.bind(this);


    }

    componentDidMount() {
        this.getClasses();
    }

    async getClasses(){
        var res = await axios.get(`/api/classes`);
        console.log(res.data);
        this.setState({classes:res.data});


    }

    async getSubjects(class_id,className){

        this.setState({className:className,section:"",classLoading:true });

        var res = await axios.get(`/api/subjects`,{
            params:{
                class_id : class_id,
            }

        });

        var sectionsRes = await axios.get(`/api/sections`,{
            params:{
                class_id : class_id,
            }

        });

        this.setState({class:class_id,subjects:res.data,sections:sectionsRes.data,classLoading:false});
        console.log(res.data);
    }

    async createSubjects(){
        this.setState({section:"",classLoading:true});
        var res = await axios.get(`/api/subjects/create`,{
            params:{
                class_id : this.state.class,
                name : this.state.createSubjectName
            }

        });
        console.log(res.data);
        this.setState({subjects:res.data,classLoading:false});

    }

    async deleteSubjects(subject_id){
        this.setState({section:"",classLoading:true});
        var res = await axios.get(`/api/subjects/delete`,{
            params:{
                class_id : this.state.class,
                subject_id : subject_id
            }
        });
        console.log(res.data);
        this.setState({subjects:res.data,classLoading:false});
    }

    async getTeacherSubjects(section_id,section_name){
        console.log(section_id,section_name);
        this.setState({teachersLoading:true});
        var res = await axios.get(`/api/teacher_subjects`,{
            params:{
                section_id : section_id
            }
        });

        var teachersRes = await axios.get(`/api/teachers`);

        this.setState({teachersLoading:false,section:section_id,sectionName:section_name,teacherSubjects:res.data,teachers:teachersRes.data})
        console.log(res);
    }

    async assignTeacher(event){
        event.preventDefault();
        console.log(this.state.subjectId);
        this.setState({teachersLoading:true})
        var res = await axios.get(`/api/teacher_subjects/assign`,{
            params:{
                section_id : this.state.section,
                subject_id : this.state.subjectId,
                teacher_id : this.state.selectedTeacher
            }
        });
        console.log(res);

        this.setState({teacherSubjects:res.data,teachersLoading:false})

    }

    async removeTeacher(teacher_subject_id){
        this.setState({teachersLoading:true})
        console.log(this.state.subjectId);
        var res = await axios.get(`/api/teacher_subjects/remove`,{
            params:{
                section_id : this.state.section,
                teacher_subject_id : teacher_subject_id,

            }
        });
        console.log(res);

        this.setState({teacherSubjects:res.data,teachersLoading:false})

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
                                            onChange={ (event)=> { this.getSubjects(event.target.value,event.target.options[event.target.options.selectedIndex].text) } }>
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
                    this.state.class && this.state.classLoading==false ?
                        <div className="card border-dark mt-4 mb-3">
                            <div className="card-header text-white bg-dark ">Class {this.state.className} - Subjects</div>
                            <div className="card-body">

                                    <ul className="list-group col-10">
                                        {this.state.subjects.map( val => (

                                            <li key={val.id} className="list-group-item d-flex justify-content-between align-items-center ">{val.name}

                                                <button className="btn btn-sm btn-danger ml-2" onClick={( )=>{this.deleteSubjects(val.id)}} >
                                                    Delete
                                                </button>

                                            </li>

                                        ))}
                                    </ul>


                                <div className="col-12 p-0 mt-4">

                                        <form className="form-inline " onSubmit={(event)=> {event.preventDefault(); this.createSubjects()} }>

                                            <div className="form-group m-3 ">

                                                <input type="text" className="form-control" id="createSubjectName"
                                                       placeholder="Subject name"  value={this.state.createSubjectName} required
                                                       onChange={event => this.setState({createSubjectName:event.target.value})}/>
                                            </div>
                                                <button type="submit"  className="btn btn-success  m-3">
                                                    Create subject
                                                </button>

                                        </form>
                                    </div>

                                <div className="form-group row  mt-4">
                                    <div className="col-md-4 ">
                                        <label htmlFor="sections" className="col-form-label">Select Section</label>
                                        <select id="sections" value={this.state.section}  className="form-control custom-select"
                                                onChange={ (event)=> { this.getTeacherSubjects(event.target.value,event.target.options[event.target.options.selectedIndex].text) }}>
                                            <option value="">Section</option>
                                            {
                                                this.state.sections.map( val => (
                                                    <option key={val.id} value={val.id}>{val.section_number}</option>

                                                ) )
                                            }
                                        </select>
                                    </div>

                                </div>

                            </div>

                        </div>

                        :
                        <div>
                        { this.state.classLoading ?
                                <Loader></Loader>:""

                        }
                        </div>


                }
                {
                    this.state.section && this.state.class && this.state.teachersLoading==false ?
                        <div className="card border-orange mt-4 mb-4">
                            <div className="card-header text-white bg-orange">Class {this.state.className} Section {this.state.sectionName} - Assign Teachers</div>
                            <div className="card-body">
                                   <form onSubmit={(event) => this.assignTeacher(event) }>

                                       <div className="form-group row">
                                           <div className="col-sm-auto ">
                                               <label htmlFor="teachers" className="col-form-label">Select teacher</label>
                                               <select value={this.state.selectedTeacher} id="teachers"  className="form-control custom-select" name="teachers"
                                                       onChange={ (event)=> { this.setState({selectedTeacher:event.target.value}) }} required>
                                                   <option value="">Teacher</option>
                                                   {
                                                       this.state.teachers.map( val => (
                                                           <option key={val.id} value={val.id}>{val.name}</option>

                                                       ) ) }
                                               </select>
                                           </div>

                                       </div>
                                    <ul className="list-group col-12">
                                        {this.state.teacherSubjects.map( val => (

                                            <li key={val.id} className="list-group-item d-flex justify-content-between align-items-center ">
                                                <span className="col-sm-auto">{val.name}</span>
                                                {val.teacher_id ?
                                                    <div className="row">
                                                        <h4 className="m-0"> <span
                                                            className="badge badge-secondary">{val.teacher_name}</span></h4>
                                                        <button type="button" className="btn btn-danger ml-2 mr-2 "  onClick={()=>this.removeTeacher(val.teacher_subject_id)}>
                                                           Remove Teacher
                                                        </button>
                                                    </div>
                                                    :
                                                    <button type="submit"  className="btn btn-success ml-2 mr-2 " onClick={()=>{this.setState({subjectId:val.id})}}>
                                                        Assign Selected Teacher
                                                    </button>
                                                }


                                            </li>

                                        ))}
                                    </ul>

                                   </form>


                            </div>
                        </div>:
                    <div>
                        {
                            this.state.teachersLoading ?
                                <Loader>

                                </Loader>:""
                        }
                    </div>

                }
            </div>
        )
    }
}

export default Class;
