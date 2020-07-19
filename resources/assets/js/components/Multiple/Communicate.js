import React from 'react';
import Loader from './Components/Loader'
import Group from "./Components/Selectors/Group";
import Individual from "./Components/Selectors/Individual";
import ClassSection from "./Components/Selectors/ClassSection";
import axios from "axios";
import DatePicker from "react-datepicker";
import dateformat from 'dateformat';
import "react-datepicker/dist/react-datepicker.css";

class Communicate extends React.Component {

    constructor(props) {
        super(props);

        this.state={
            category:"individual",
            group:"",
            section_ids:{},
            individual_ids:[],
            message:"",
            title:"",
            communicationList:[],
            pagination: {},
            success:false
        }
        this.getCommunications = this.getCommunications.bind(this);

        this.createMessage = this.createMessage.bind(this);

    }

    async componentDidMount() {
        await this.getCommunications();
    }

    async createMessage(){
            let section_ids = [];
            let individual_ids = [];

            if(this.state.category == 'individual'){
                for(let i=0;i< this.state.individual_ids.length ; i++){
                    individual_ids.push(this.state.individual_ids[i].id);
                }
            }

            for (let key in this.state.section_ids) {
                if(this.state.section_ids[key]) {
                    section_ids.push(key);
                }
            }
            let res = await axios.get(`/api/communicate/create`, {
                params: {
                    category: this.state.category,
                    group: this.state.group,
                    title: this.state.title,
                    message:this.state.message,
                    section_ids:section_ids,
                    individual_ids:individual_ids,
                }
            });



        await this.getCommunications();
        this.setState({success:true});
    }



    async getCommunications(url=null){


        console.log(url);
        if(url == null){

            url = `/api/communicate/get`;
        }
        else{
            let urlObj = new URL(url);
                url = urlObj.pathname +"?"+ urlObj.searchParams;
        }

        console.log(url);
        let res = await axios.get(url);
        this.setState({communicationList:res.data.data ,pagination:res.data});


    }




    render() {
        console.log(this.state.pagination);
        return (
            <React.Fragment>

                {this.state.success ?

                <div className="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>    Message sent  sucessfully </strong>
                    <button type="button" className="close" onClick={()=>{this.setState({success: false})}}>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>:
                    ""

                }

                <div className="card border-orange">

                    <div className="card-header  bg-orange border-0 text-white">
                        <ul className="nav nav-tabs card-header-tabs nav-fill bg-orange">
                            <li className="nav-item" >
                                <a className= { this.state.category == 'groups'? "nav-link active text-orange": "nav-link " }
                                   onClick={()=>this.setState({category:"groups"})}
                                >Groups</a>
                            </li>
                            <li className="nav-item">
                                <a className=
                                       { this.state.category == 'class'? "nav-link active text-orange": "nav-link " }
                                   onClick={()=>this.setState({category:"class"})}
                                >Class</a>
                            </li>
                            <li className="nav-item p-0">
                                <a className= { this.state.category == 'individual'? "nav-link active text-orange": "nav-link " }
                                   onClick={()=>this.setState({category:"individual"})}
                                >Individual</a>
                            </li>
                        </ul>
                    </div>

                    <div className="card-body">
                        {this.state.category =='groups'?
                            <Group group={this.state.group} setGroup={(group)=>{this.setState({group: group})}} />:
                            ""

                        }
                        {this.state.category =='class'?
                            <ClassSection
                                setSections={(section_ids)=>{this.setState({section_ids: section_ids})}}
                            />:
                            ""
                        }
                        {this.state.category =='individual'?
                            <Individual
                                individuals={this.state.individual_ids} setIndividuals={(individual_ids)=>{this.setState({individual_ids: individual_ids})}}
                            />:
                            ""
                        }

                    </div>


                </div>


                { this.state.category=='groups' && this.state.group ||
                this.state.category=='individual' && this.state.individual_ids.length !== 0  ||
                this.state.category=='class' && Object.keys(this.state.section_ids).length !== 0 ?
                    <div className="card border-messenger mt-3 mb-3">

                        <div className="card-header text-white bg-messenger border-0">

                            Message Input
                        </div>
                        <div className="card-body">
                            <form onSubmit={(event)=> {
                                event.preventDefault();
                                this.createMessage();
                            }}>

                                <div className="col-6 mb-3 form-group row">
                                    <label className=" col-4 col-form-label" htmlFor="title">Message Title</label>
                                    <div className="col-6">
                                        <input className="form-control" id="title" type="text" required={true}
                                               value={this.state.title} onChange={(event)=>{this.setState({title:event.target.value})}}
                                               placeholder="Title"/>
                                    </div>
                                </div>

                                <div className="form-group row col-6 mb-3">
                                    <label className="col-4  col-form-label" htmlFor="from">Message</label>
                                    <div className="col-8">
                                        <textarea className="form-control" id="message" placeholder="message" aria-label="With textarea"

                                        maxLength={1499} value={this.state.message}
                                                  onChange={(event)=>{this.setState({message:event.target.value})}}
                                        >


                                        </textarea>
                                    </div>


                                </div>





                                <button type="submit" className="btn btn-success ml-2">
                                    Send Message
                                </button>

                            </form>
                        </div>
                    </div>

                    :

                    ""

                }
                <div className="card border-indigo mt-3 mb-3">

                    <div className="card-header text-white bg-indigo border-0">
                        Communication Log
                    </div>
                    <div className="card-body">
                        <ul className="list-group col-10">
                            <li className="list-group-item  d-flex justify-content-between align-items-center ">

                                <div className="col-2">

                                    <b><span> Index </span></b>


                                </div>
                                <div className="col-8">

                                    <b><span> Title </span></b>


                                </div>


                                <div className="col-2">
                                    <b><span> Category </span></b>
                                </div>


                            </li>

                            {

                                this.state.communicationList.map((val,index )=>(

                                        <li key={val.id} className="list-group-item  d-flex justify-content-between align-items-center ">


                                            <div className="col-2">
                                                <span> {(this.state.pagination.current_page-1) * (this.state.pagination.per_page) + index + 1 }</span>
                                            </div>
                                            <div className="col-8">

                                                <span>{val.title} </span>


                                            </div>

                                            <div className="col-2">
                                                <span> {val.category} </span>
                                            </div>


                                        </li>

                                    )
                                )

                            }
                        </ul>
                        <nav aria-label="Page navigation example" className="mt-3">
                            <ul className="pagination d-inline-flex" >
                                { this.state.pagination.prev_page_url ?
                                    <li className="page-item"  onClick={()=>this.getCommunications(this.state.pagination.prev_page_url)}><a href="#" className="page-link ">Previous</a></li>
                                    :
                                    ""}

                                { this.state.pagination.next_page_url ?
                                    <li className="page-item" onClick={()=>this.getCommunications(this.state.pagination.next_page_url)}><a className="page-link text-white ">Next</a></li>
                                    :
                                    ""}




                            </ul>

                            <ul className="pagination float-right">
                                {
                                    this.state.pagination.first_page_url ?
                                    <li className="page-item float-right" onClick={()=>this.getCommunications(this.state.pagination.first_page_url)}><a className="page-link text-white ">First</a></li>
                                    :
                                    ""
                                }

                                {
                                    this.state.pagination.last_page_url ?
                                    <li className="page-item float-right"  onClick={()=>this.getCommunications(this.state.pagination.last_page_url)}><a href="#" className="page-link ">Last</a></li>
                                    :
                                    ""
                                }


                            </ul>

                        </nav>
                    </div>
                </div>
            </React.Fragment>

        )
    }
}

export default Communicate;

