import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import FeeStructures from "./FeeStructures";
//import DatePicker from 'react-date-picker';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
//import DatePicker from "react-bootstrap-date-picker";


class FeeGroups extends React.Component {

    constructor(props) {
        super(props);
        const fee_groups = JSON.parse(props.fee_groups);
        console.log(fee_groups);
        this.state={
            fee_groups:fee_groups,
            fee_group_name:"",
            fee_group_text:"",
            fee_group:"",
            fee_structures:null,
            fee_structures_loading:false,
            fee_structure_name:"",
            fee_structures_records_data:[
                { name:"", value:0}
            ],
            fee_structure_installments:[
                {date:"",value:0}
            ]

        }
        this.getFeeStructures = this.getFeeStructures.bind(this);
        this.changeRecordName = this.changeRecordName.bind(this);
        this.changeRecordValue = this.changeRecordValue.bind(this);
        this.addRecord = this.addRecord.bind(this);
        this.deleteRecord = this.deleteRecord.bind(this);
        this.changeInstalmentDate = this.changeInstalmentDate.bind(this);
        this.changeInstalmentValue = this.changeInstalmentValue.bind(this);
        this.addInstallment = this.addInstallment.bind(this);
        this.deleteInstalment = this.deleteInstalment.bind(this);

    }

     changeRecordName(value,index){
        var arr = this.state.fee_structures_records_data;
        arr[index].name = value;
        this.setState(this.setState({fee_structures_records_data:arr}));
    }

    changeInstalmentDate(value,index){
        console.log(value);
        var arr = this.state.fee_structure_installments;
        arr[index].date = value;
        this.setState(this.setState({fee_structure_installments:arr}));
    }


     changeRecordValue(value,index){
        var arr = this.state.fee_structures_records_data;
        arr[index].value = value;
        this.setState(this.setState({fee_structures_records_data:arr}));
    }

    changeInstalmentValue(value,index){
        var arr = this.state.fee_structure_installments;
        arr[index].value = value;
        this.setState(this.setState({fee_structure_installments:arr}));
    }

     addRecord(){
        var arr = this.state.fee_structures_records_data;
        arr.push({name:"",value:0});
        this.setState(this.setState({fee_structures_records_data:arr}));
    }
    addInstallment(){
        var arr = this.state.fee_structure_installments;
        arr.push({date:"",value:0});
        this.setState(this.setState({fee_structure_installments:arr}));
    }

    deleteRecord(index){
        var arr = this.state.fee_structures_records_data;
        arr.splice(index, 1);
        this.setState(this.setState({fee_structures_records_data:arr}));
    }

    deleteInstalment(index){
        var arr = this.state.fee_structure_installments;
        arr.splice(index, 1);
        this.setState(this.setState({fee_structure_installments:arr}));
    }

    async getFeeStructures(value,text){
        console.log(text);
        if(value==""){
            this.setState({"fee_group":value,fee_structures:null,fee_group_text:""})
            return
        }
        this.setState({fee_structures_loading:true,fee_structures:null,"fee_group":value,fee_group_text:text});
        const fee_group_id = this.state.fee_group;
        var v = await axios.get(`/fees/fee_groups/api/fee_structures/${value}`);
        console.log(v);

        this.setState({"fee_structures":v.data , "fee_structures_loading":false});


    }






    render() {
        const total_records_sum = this.state.fee_structures_records_data.reduce((total,record) => total+parseFloat(record.value),0);
        const instalment_total = this.state.fee_structure_installments.reduce((total,record) => total+parseFloat(record.value),0);
        const isEqual = total_records_sum==instalment_total;
        const ExampleCustomInput = ({ value, onClick }) => (

        <input name="Instalment[]"
               type="text"
               className="form-control"
               onClick={onClick}
               value={value}
               onChange={()=>{}}
               required/>
        )
        return (

                <div>
                    <div className="card border-light mt-4">
                        <h5 className="card-header  bg-light">Fee Groups</h5>

                        <div className="card-body">
                            <div className="mb-3">
                                <select value={this.state.fee_group} className="custom-select col-4"
                                        onChange={(event)=>{this.getFeeStructures(event.target.value,event.nativeEvent.target[event.nativeEvent.target.selectedIndex].text)}}>
                                    <option value="" >Select Fee Group</option>
                                    { this.state.fee_groups.map( val => (
                                        <option key={val.id} value={val.id}>{val.name}</option>
                                    ) ) }
                                </select>
                            </div>
                            <div className="text-center">
                                <button type="button" className="btn btn-success text-center" data-toggle="modal" data-target="#FeeGroupCreate" >Create new Fee Group</button>

                                <div className="modal fade" id="FeeGroupCreate" tabIndex="-1" role="dialog"
                                     aria-labelledby="FeeGroupCenterTitle" data-backdrop="static" aria-hidden="true">
                                    <div className="modal-dialog modal-dialog-centered" role="document">
                                        <div className="modal-content">
                                            <div className="modal-header">
                                                <h5 className="modal-title" id="FeeGroupCenterTitle">Create Fee Group</h5>
                                                <button type="button" className="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="/fees/fee_groups/create">
                                                <div className="modal-body">
                                                    <div className="form-group">
                                                        <label className="float-left" htmlFor="groupName">Group Name</label>
                                                        <input type="hidden" name="_token" value={csrf_token} />

                                                        <input type="text"  name="name" className="form-control"
                                                               id="groupName" aria-describedby="emailHelp" required
                                                               value={this.state.fee_group_name}
                                                               onChange={event => {this.setState({fee_group_name:event.target.value})}}>

                                                        </input>

                                                    </div>
                                                </div>
                                                <div className="modal-footer">
                                                    <button type="button" className="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" className="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {this.state.fee_structures_loading ?
                        <div className="d-flex justify-content-center m-5">
                            <div className="spinner-border" role="status">
                                <span className="sr-only">Loading...</span>
                            </div>
                        </div>
                        :""
                    }
                    {




                        this.state.fee_structures ?







                            <div>


                                <div className="card border-light mt-4">
                                    <h5 className="card-header  bg-light">Fee Structures</h5>
                                    <div className="card-body">
                                        <h5 className="card-title"> Fee Group - <span className="text-info text" style={{"fontWeight": "bold"}} >{this.state.fee_group_text}</span> </h5>

                                        {this.state.fee_structures.length ?
                                            <table className="table table-data-div m-4 table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Fee Structure Name</th>
                                                    <th>Instalments</th>
                                                    <th>Total Amount</th>
                                                    <th></th>
                                                    <th></th>



                                                </tr>
                                                </thead>
                                                <tbody>
                                                {this.state.fee_structures.map(val => (
                                                    <tr key={val.id}>
                                                        <td>{val.name}</td>
                                                        <td>{val.total_instalments}</td>
                                                        <td>{val.total_amount}</td>
                                                        <td>
                                                            <form id="form-id" method="post" action="/fees/fee_groups/fee_structure/delete">
                                                                <input type="hidden" name="_token" value={csrf_token} />
                                                                <input type="hidden" name="id" value={val.id}/>
                                                                <button className="btn-sm btn-danger">
                                                                    <small>Delete</small>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>


                                                                <button className="btn-sm btn-warning">
                                                                    <small>View</small>
                                                                </button>

                                                        </td>

                                                    </tr>
                                                ))}


                                                </tbody>
                                            </table>:""
                                        }




                                        <div className="text-center">

                                            <button type="button" data-toggle="modal"  className="btn btn-success" data-target="#FeeStructureCreate"> Create new Fee Structure </button>
                                        </div>
                                        <div className="modal fade" id="FeeStructureCreate" tabIndex="-1" role="dialog"
                                             aria-labelledby="FeeStructureCenterTitle" data-backdrop="static" aria-hidden="true">
                                            <div className="modal-dialog modal-xl  modal-dialog-centered" role="document">
                                                <div className="modal-content">
                                                    <div className="modal-header">
                                                        <h5 className="modal-title" id="FeeStructureCenterTitle">Create Fee Structure</h5>
                                                        <button type="button" className="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="/fees/fee_groups/fee_structure/create">
                                                        <input type="hidden" name="_token" value={csrf_token} />
                                                        <div className="modal-body">

                                                                <div className="form-group row">
                                                                    <div className="col-md-4 mb-3">
                                                                        <label className="col-form-label"
                                                                               htmlFor="name">Fee Structure Name</label>
                                                                        <input id="name" type="text"
                                                                               className="form-control"
                                                                               name="name"
                                                                               placeholder="5th Class"
                                                                               value={this.state.fee_structure_name}
                                                                               onChange={event => {this.setState({fee_structure_name:event.target.value})} }
                                                                               required/>


                                                                    </div>
                                                                </div>
                                                            {
                                                                this.state.fee_structures_records_data.map((val,index) =>
                                                                    (
                                                                        <div
                                                                            key={index}
                                                                            className="form-group row">


                                                                            <div className="col-md-4 ">
                                                                                <label
                                                                                    className="col-form-label">
                                                                                    Fee name
                                                                                </label>
                                                                                <input name="FeeName[]"
                                                                                       type="text"
                                                                                       className="form-control"
                                                                                       placeholder="Books"
                                                                                       value={val.name}
                                                                                       onChange={(event => {this.changeRecordName(event.target.value,index)})}
                                                                                       required/>

                                                                            </div>
                                                                            <div className="col-md-4 ">
                                                                                <label
                                                                                    className="col-form-label"
                                                                                    >Amount</label>
                                                                                <input name="Amount[]"
                                                                                       type="number"
                                                                                       className="form-control"

                                                                                       placeholder="2000.50"
                                                                                       step="0.01"
                                                                                       onChange={(event => {this.changeRecordValue(event.target.value,index)})}
                                                                                       value={val.value}
                                                                                       required/>
                                                                            </div>
                                                                            {index>=1 ?
                                                                                <div className="col-md-2 ">
                                                                                   <br/>
                                                                                   <br/>
                                                                                            <button
                                                                                                className="btn-sm  btn-danger"
                                                                                                id="removeBtn"
                                                                                                onClick={()=>{this.deleteRecord(index)}}
                                                                                                type="button">

                                                                                                Delete
                                                                                            </button>

                                                                                </div>
                                                                                :
                                                                                ""
                                                                                }



                                                                        </div>

                                                                    ))


                                                            }

                                                            <div className="input-group offset-3 col-6 mt-4">
                                                                <div className="input-group-prepend">
                                                                    <span className="input-group-text">Total Amount</span>
                                                                    <input type="hidden" name="totalAmount" value={total_records_sum}/>
                                                                    <input type="hidden" name="totalInstalments" value={this.state.fee_structure_installments.length}/>
                                                                </div>
                                                                <input type="text"
                                                                       className="form-control" value={total_records_sum} disabled/>
                                                            </div>

                                                            {
                                                                this.state.fee_structure_installments.map((val,index) =>
                                                                (
                                                                    <div key={index*19} className="form-group mt-3 row">
                                                                        <div className="col-md-4 ">

                                                                            <label
                                                                                className="col-md-12 col-form-label pl-0"
                                                                              >Instalment {index+1} due date</label>
                                                                            <DatePicker
                                                                                className="form-control"
                                                                                name="Instalment[]"
                                                                                selected={val.date}
                                                                                customInput={<ExampleCustomInput />}
                                                                                onChange={(date => {this.changeInstalmentDate(date,index)})}
                                                                            />


                                                                        </div>
                                                                        <div className="col-md-4 ">
                                                                            <label
                                                                                className="col-form-label"
                                                                                >Instalment Amount</label>
                                                                            <input name="InsAmount[]"
                                                                                   type="number"
                                                                                   className="form-control"
                                                                                   placeholder="2000.50"
                                                                                   step="0.01"
                                                                                   onChange={(event => {this.changeInstalmentValue(event.target.value,index)})}
                                                                                   value={val.value}
                                                                                   required/>
                                                                        </div>
                                                                        {index>=1 ?
                                                                            <div className="col-md-2 ">
                                                                                <br/>
                                                                                <br/>
                                                                                <button
                                                                                    className="btn-sm  btn-danger"
                                                                                    id="removeBtn"
                                                                                    onClick={()=>{this.deleteInstalment(index)}}
                                                                                    type="button">

                                                                                    Delete
                                                                                </button>

                                                                            </div>
                                                                            :
                                                                            ""
                                                                        }

                                                                    </div>



                                                                ))




                                                            }

                                                            <div className="input-group offset-3 col-6 mt-4 mb-4">
                                                                <div className="input-group-prepend">
                                                                    <span className="input-group-text">Total Instalment Amount</span>
                                                                </div>
                                                                <input type="text"
                                                                       className="form-control" value={instalment_total} disabled/>
                                                            </div>
                                                            {isEqual ?

                                                                ""
                                                                :
                                                               <div className="input-group offset-3 col-6 mt-4 mb-4">
                                                                    <h4><span
                                                                        className="badge badge-danger">Total amounts does not match</span></h4>
                                                                </div>
                                                            }

                                                            <div className=" btn-group float-right mr-5 btn-toolbar" role="toolbar"
                                                                 aria-label="Toolbar with button groups">
                                                                <div className="btn-group mr-2" role="group"
                                                                     aria-label="First group">
                                                                    <button type="button"
                                                                            className=" btn btn-info  btn-sm"
                                                                            onClick={()=>{this.addRecord()}} >Add New Field
                                                                    </button>
                                                                </div>
                                                                <div className="btn-group mr-2" role="group"
                                                                     aria-label="Second group">
                                                                <button type="button"
                                                                        className=" btn btn-info  btn-sm"
                                                                        onClick={()=>{this.addInstallment()}} >Add New Instalment
                                                                </button>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <input type="hidden" name = "fee_group_id" value={this.state.fee_group}/>

                                                        <div className="modal-footer">
                                                            <button type="button" className="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" className="btn btn-primary"  disabled={ isEqual ? false:true } >Submit</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <form className="float-right" id="form-id" method="post" action="/fees/fee_groups/delete">
                                            <input type="hidden" name="_token" value={csrf_token} />
                                            <input type="hidden" name="id" value={this.state.fee_group}/>
                                            <button type="submit" className="btn-sm btn-danger">
                                                Delete Fee Group
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>:
                            ""
                    }
                </div>


        )


    }
}



export default FeeGroups;

if (document.getElementById('fee_groups')) {
    var fee_groups =  document.getElementById('fee_groups').getAttribute('fee_groups');
    console.log("fee_g");
    console.log(fee_groups);
    ReactDOM.render(<FeeGroups fee_groups={fee_groups}/>, document.getElementById('fee_groups'));
}
