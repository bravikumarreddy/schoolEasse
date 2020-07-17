import React from 'react';
import Loader from './Components/Loader'
import Group from "./Components/Selectors/Group";
import Individual from "./Components/Selectors/Individual";
import ClassSection from "./Components/Selectors/ClassSection";
import axios from "axios";
import DatePicker from "react-datepicker";
import dateformat from 'dateformat';
import "react-datepicker/dist/react-datepicker.css";

class SchoolEvent extends React.Component {

    constructor(props) {
        super(props);

        this.state={
            category:"individual",
            group:"",
            section_ids:{},
            individual_ids:[],
            to:"",
            from:"",
            title:"",
            color:"#ff6245",
            eventList:[]
        }
        this.getEventList = this.getEventList.bind(this);
        this.deleteEvent = this.deleteEvent.bind(this);
        this.createEvent = this.createEvent.bind(this);

    }

    async componentDidMount() {
        await this.getEventList();
    }

    async createEvent(){
        if(this.state.category == 'class'){
            let section_ids = this.state.section_ids;
            let awaitArray = [];
            for (let key in section_ids) {
                if(section_ids[key]) {
                    awaitArray.push(axios.get(`/api/school_event/create`,{
                        params:{
                            category : this.state.category,
                            group:this.state.group,
                            title:this.state.title,
                            from:this.state.from,
                            to:this.state.to,
                            color:this.state.color,
                            section_id:key

                        }
                    }));
                }
            }
            await Promise.all(awaitArray);
        }
        else if(this.state.category == 'individual'){
            let individual_ids = this.state.individual_ids;
            let awaitArray = [];
            for (let i=0;i<individual_ids.length;i++) {
                let individual = individual_ids[i];

                    awaitArray.push(axios.get(`/api/school_event/create`,{
                        params:{
                            category : this.state.category,
                            group:this.state.group,
                            title:this.state.title,
                            from:this.state.from,
                            to:this.state.to,
                            color:this.state.color,
                            individual_id:individual.id

                        }
                    }));

            }
            await Promise.all(awaitArray);
        }
        else{
            let res = await axios.get(`/api/school_event/create`,{
                params:{
                    category : this.state.category,
                    group:this.state.group,
                    title:this.state.title,
                    from:this.state.from,
                    to:this.state.to,
                    color:this.state.color

                }
            });
        }

        await  this.getEventList();
    }

    async deleteEvent(id){
        let res = await axios.get(`/api/school_event/delete`,{
            params:{
                id : id,
            }
        });
        await  this.getEventList();
    }
    async getEventList(){

        let res = await axios.get(`/api/school_event/get`);
        this.setState({eventList:res.data});

    }



    render() {
        console.log(Object.keys(this.state.section_ids).length);
        return (
            <React.Fragment>
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

                <div className="card border-indigo mt-3 mb-3">

                    <div className="card-header text-white bg-indigo border-0">
                        Event List
                    </div>
                    <div className="card-body">
                        <ul className="list-group col-10">
                        {

                            this.state.eventList.map((val,index )=>(


                                <li key={val.id} className="list-group-item  d-flex justify-content-between align-items-center ">



                                        <div className="col-3">

                                                <span>{val.title} </span>


                                        </div>
                                    <div className="col-4">

                                        <span>{dateformat(val.from,'mmm d, yyyy h:mm ')} - { dateformat(val.to ,'mmm d, yyyy h:mm ')} </span>


                                    </div>
                                        <div className="col-3">
                                            {val.category =='groups'?
                                                <span>{val.group_name} </span>
                                                :
                                                ""
                                            }
                                            {val.category =='class'?
                                                <span> Class-{val.class_name} Sec-{val.section_name}  </span>
                                                :
                                                ""
                                            }
                                            {val.category =='individual'?
                                                <span> {val.user_name}  </span>
                                                :
                                                ""
                                            }
                                        </div>
                                        <div className="col-2">

                                                <button type="button" className="btn btn-sm btn-danger ml-2 mr-2 "  onClick={()=>{this.deleteEvent(val.id)}}>
                                                    delete
                                                </button>

                                        </div>



                                </li>

                            )
                            )

                        }
                        </ul>
                    </div>
                </div>
                { this.state.category=='groups' && this.state.group ||
                this.state.category=='individual' && this.state.individual_ids.length !== 0  ||
                this.state.category=='class' && Object.keys(this.state.section_ids).length !== 0 ?
                    <div className="card border-messenger mt-3 mb-3">

                        <div className="card-header text-white bg-messenger border-0">

                            Event Input
                        </div>
                        <div className="card-body">
                            <form onSubmit={(event)=> {
                                event.preventDefault();
                                this.createEvent();
                            }}>

                                <div className="col-6 mb-3 form-group row">
                                    <label className=" col-4 col-form-label" htmlFor="title">Event Title</label>
                                    <div className="col-6">
                                        <input className="form-control" id="title" type="text" required={true}
                                               value={this.state.title} onChange={(event)=>{this.setState({title:event.target.value})}}
                                               placeholder="Title"/>
                                    </div>
                                </div>

                                <div className="form-group row col-6 mb-3">
                                    <label className="col-4  col-form-label" htmlFor="from">From</label>
                                    <div className="col-8">
                                     <DatePicker
                                         className="form-control"
                                         selected={this.state.from}
                                        onChange={(value) => this.setState({from: value})}
                                        showTimeSelect

                                        dateFormat="MMMM d, yyyy h:mm aa"
                                    />
                                    </div>


                                </div>
                                <div className="form-group row col-6 mb-3">
                                    <label className="col-4  col-form-label" htmlFor="to">To</label>
                                    <div className="col-8">
                                    <DatePicker
                                        className="form-control"
                                        selected={this.state.to}
                                        onChange={(value) => this.setState({to: value})}
                                        showTimeSelect

                                        dateFormat="MMMM d, yyyy h:mm aa"
                                    />
                                    </div>

                                </div>
                                <div className="form-group row col-6 mb-3">
                                    <label className="col-4  col-form-label" htmlFor="to">Color</label>
                                    <div className="col-2">
                                    <input className="form-control" id="color" type="Color"
                                           value={this.state.color}
                                           onChange={(event)=>{this.setState({color:event.target.value})}}
                                           placeholder="Default input"/>
                                    </div>

                                </div>




                        <button type="submit" className="btn btn-success ml-2">
                            Create Event
                        </button>

                    </form>
                        </div>
                    </div>

                    :

                    ""

                }
            </React.Fragment>

        )
    }
}

export default SchoolEvent;
