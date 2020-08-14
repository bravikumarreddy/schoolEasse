import React from 'react';
import Loader from './Components/Loader'
import axios from "axios";

class Syllabus extends React.Component {

    constructor(props) {
        super(props);
        this.state={
            classes:"",
            class:"",
            classLoading:false,
            className:"",
            subjects:[],
            subject:"",
            createSubjectName:"",
            syllabus:[],
            topic:"",
            reference:"",
            comments:"",
        }

        this.getClasses = this.getClasses.bind(this);
        this.getSubjects = this.getSubjects.bind(this);
        this.getSyllabus = this.getSyllabus.bind(this);
        this.createSubjects = this.createSubjects.bind(this);
        this.addSyllabus = this.addSyllabus.bind(this);
        this.deleteSyllabus = this.deleteSyllabus.bind(this);



    }

    componentDidMount() {
        this.getClasses();
    }

    async getClasses(){
        var res = await axios.get(`/api/classes`);
        console.log(res.data);
        this.setState({classes:res.data});


    }

    async getSyllabus(subject_id,subject_name){
        var res = await axios.get(`/api/syllabus/${subject_id}`);
        console.log(res);
        this.setState({subject:subject_id,syllabus:res.data});
    }

    async getSubjects(class_id,className){

        this.setState({className:className,section:"",classLoading:true });

        var res = await axios.get(`/api/subjects`,{
            params:{
                class_id : class_id,
            }

        });



        this.setState({class:class_id,subjects:res.data,classLoading:false});
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

    async addSyllabus(){

        var res = await axios.get(`/api/syllabus/add/`,{
            params:{
                subject_id : this.state.subject,
                topic : this.state.topic,
                reference:this.state.reference,
                comments:this.state.comments
            }

        });
        await this.getSyllabus(this.state.subject,"");


    }

    async deleteSyllabus(syllabus_id){

        var res = await axios.get(`/api/syllabus/delete`,{
            params:{
                syllabus_id : syllabus_id,
            }

        });
        await this.getSyllabus(this.state.subject,"");


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

                                    {
                                        this.state.class && this.state.classLoading == false ?
                                            <div className="col-md-4 ">
                                                <label htmlFor="subject" className="col-form-label">Select
                                                    Subject</label>
                                                <select value={this.state.subject} id="fee_structure"
                                                        className="form-control custom-select" name="subject"
                                                        onChange={(event) => {
                                                            this.getSyllabus(event.target.value, event.target.options[event.target.options.selectedIndex].text)
                                                        }}>
                                                    <option value="">Subject</option>
                                                    {
                                                        this.state.subjects.map(val => (
                                                            <option key={val.id}
                                                                    value={val.id}>{val.name}</option>
                                                        ))}
                                                </select>
                                            </div>:""
                                    }

                                </div>
                            </div>
                        </div>:

                        <Loader/>

                }

                {
                    this.state.subject ?
                        <React.Fragment>
                            <div className="card border-orange mt-4">
                                <div className="card-header text-white bg-orange">Add Syllabus</div>
                                <div className="card-body">
                                    <form method="post" autoComplete="off" action="/syllabus/add"
                                          onSubmit={(event) => {
                                              event.preventDefault();
                                              this.addSyllabus()
                                          }}
                                    >

                                        <div className="form-group col-6">
                                            <label htmlFor="topic">Topic Name</label>
                                            <input type="text" className="form-control" id="topic"
                                                   placeholder="Enter Topic Name" value={this.state.topic}
                                                   onChange={(event => {
                                                       this.setState({topic: event.target.value})
                                                   })}
                                                   required
                                            />

                                        </div>

                                        <div className="form-group col-6">
                                            <label htmlFor="reference">References</label>
                                            <input type="text" className="form-control" id="reference"
                                                   placeholder="Textbook / article" value={this.state.reference}
                                                   onChange={(event => {
                                                       this.setState({reference: event.target.value})
                                                   })}
                                                   required
                                            />

                                        </div>

                                        <div className="form-group col-6">
                                            <label htmlFor="Comments">Comments</label>
                                            <textarea type="text" className="form-control" id="Comments"
                                                      placeholder="Info" value={this.state.comments}
                                                      onChange={(event => {
                                                          this.setState({comments: event.target.value})
                                                      })}
                                            ></textarea>

                                        </div>

                                        <div className="form-group">
                                            <div className="col-sm-8 ">
                                                <button type="submit" className="btn btn-success">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div className="card border-messenger mt-4">
                                <div className="card-header text-white bg-messenger">Add Syllabus</div>
                                <div className="card-body">

                                    <ul className=" mt-3 list-group  mb-4">
                                        {
                                            this.state.syllabus.map( val => (

                                                <React.Fragment key={val.id} >
                                                    <li className="list-group-item">
                                                        <div className="d-flex justify-content-between align-items-center">
                                                        <span> <b className="text-messenger">Topic :  &nbsp;&nbsp;</b> <span> {val.topic}</span></span>
                                                        </div>
                                                        <div className=" pt-3 d-flex justify-content-between align-items-center">
                                                            <span> <b className="text-messenger">Reference :  &nbsp;&nbsp;</b> <span> {val.reference}</span></span>
                                                        </div>

                                                        <div className=" pt-3 d-flex justify-content-between align-items-center">
                                                            <span> <b className="text-messenger">Comments :  &nbsp;&nbsp;</b> <span> {val.comments}</span></span>
                                                        </div>

                                                        <div className=" pt-3 d-flex justify-content-between align-items-center">
                                                            <button type="button" className="btn btn-danger"
                                                            onClick={()=>this.deleteSyllabus(val.id)}
                                                            >Delete</button>
                                                        </div>




                                                    </li>

                                                </React.Fragment>


                                                )
                                            )
                                        }
                                    </ul>


                                </div>
                            </div>
                        </React.Fragment>

                        :

                        ""

                }
            </div>
        )
    }
}

export default Syllabus;
