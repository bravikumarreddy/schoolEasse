import React from 'react';
import axios from "axios";
import Loader from "./Components/Loader";


class GradeSystems extends React.Component {

    constructor(props) {
        super(props);

        this.state= {
            grade_systems:{},
            name:"",
            from:{
                1:0
            },
            to :{
                1:100
            },
            grade:{
                1:""
            }
        }

    }

    getGradeSystems = async () =>{
        let res = await axios.get(`/api/exams/grade-system/get`);
        this.setState({grade_systems:res.data});
    }

    async componentDidMount() {
        this.getGradeSystems();
    }

     deleteGradeSystem = async (id) =>{
        let res = await axios.get(`/api/exams/grade-system/delete/${id}`);
        this.getGradeSystems();
    }

    handleGradeChange = (value,index) => {

            let grade =  {...this.state.grade };
            grade[index]=value;
            console.log(grade)
        this.setState({grade:grade})
    }
    handleToChange = (value,index) =>{
        index = parseInt(index);
        let from = {};
        let to = {};
        let grade = {};

        console.log(index);
        if(value < 100){

            from =  {...this.state.from };
            to =  {...this.state.to };
            grade =  {...this.state.grade };

            to[index]=value;
            from[index + 1] = value;

            if(!this.state.from[index+1]) {

                to[index + 1] = 100;
                grade[index + 1] = this.state.grade[index + 1] ? this.state.grade[index + 1] : ""
            }

            this.setState({from:from,to:to,grade:grade})

            return
        }
        else if(value == 100){

            for(let i=1; i<index;i++){
                from[i] = this.state.from[i];
                to[i] = this.state.to[i];
                grade[i] = this.state.grade[i];
            }

            to[index]=value;
            from[index]=this.state.from[index];
            grade[index] = this.state.grade[index];

            this.setState({from:from,to:to,grade:grade})

            return
        }






    }



    render() {
        let gradeSystems = Object.keys(this.state.grade_systems)
        let gradeKeys= Object.keys(this.state.from);
        let from = this.state.from;
        let to = this.state.to;
        let grade = this.state.grade;
        return (
            <div>

                <div className="card mt-4">
                    <div className="card-header text-white bg-yellow">Create Grade System</div>
                    <div className="card-body">
                        <form  action={"/exams/grade-system/submit"} method="post">
                            <input type="hidden" name="_token" value={csrf_token} />

                            <div className="form-group">
                                <div className="col-md-4 pl-0">
                                    <label htmlFor="name">Grade System Name</label>
                                    <input type="text" className="form-control" id="name"
                                           aria-describedby="name" placeholder="Name" name="name" required/>


                                </div>


                            </div>
                            {
                                gradeKeys.map(value => (
                                    <div key={value} className="form-group row" >

                                        <React.Fragment >
                                            <div className="col-md-4 ">
                                                <div className="input-group">
                                                    <div className="input-group-prepend">
                                                        <span
                                                            className="input-group-text bg-messenger text-white">From</span>
                                                    </div>

                                                    <input type="number" className="form-control"
                                                           value={from[value]}
                                                           disabled
                                                    />
                                                    <input type="hidden" name="from[]" value={from[value]} />
                                                    <div className="input-group-append">
                                                        <span
                                                            className="input-group-text bg-secondary text-white">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-md-4 ">
                                                <div className="input-group">
                                                    <div className="input-group-prepend">
                                                        <span
                                                            className="input-group-text bg-orange text-white">To</span>

                                                    </div>

                                                    <input type="number" className="form-control"
                                                           value={to[value]}
                                                           min={ parseFloat(from[value]) +1  }
                                                           name="to[]"
                                                           onChange={(event) => {
                                                               this.handleToChange(event.target.value, value)
                                                           }}

                                                    />
                                                    <div className="input-group-append">
                                                        <span
                                                            className="input-group-text bg-secondary text-white">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-md-4 ">
                                                <div className="input-group">
                                                    <div className="input-group-prepend">
                                                        <span
                                                            className="input-group-text bg-success text-white">Grade</span>
                                                    </div>
                                                    <input type="text" className="form-control"
                                                           value={grade[value]}
                                                           name="grade[]"
                                                           onChange={(event) => {

                                                               this.handleGradeChange(event.target.value, value)
                                                           }}

                                                           required

                                                    />
                                                </div>
                                            </div>
                                        </React.Fragment>


                                    </div>
                                ))
                            }

                                <button type="submit" className="btn align-self-center btn-primary" >
                                    Save Changes
                                </button>



                        </form>
                    </div>
                </div>
                <div className="card mt-4">
                    <div className="card-header bg-orange text-white">Grade Systems</div>
                    <div className="card-body m-4">
                        <div className="row justify-content-start" >{
                            gradeSystems.map(value => {
                                return (
                                    <React.Fragment key={value}>
                                        <div className="card col-4 p-0 m-2">
                                            <div className="card-header bg-messenger text-white">
                                                <h5 className="mb-0 d-inline">{this.state.grade_systems[value][0].grade_system_name}</h5>
                                                <button className="btn btn-xs p-1 m-0 btn-danger float-right" onClick={( )=>{this.deleteGradeSystem(value)}} >
                                                    <small>Delete</small>
                                                </button>

                                            </div>
                                            <div className="card-body">
                                                <table className="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Index</th>
                                                        <th scope="col">Marks</th>

                                                        <th scope="col">Grade</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {this.state.grade_systems[value].map((row,index)=>{

                                                        return(

                                                            <tr key={index}>
                                                                <th scope="row">{index+1}</th>
                                                                <td>{row.from} - {row.to}</td>
                                                                <td>{row.grade}</td>
                                                            </tr>)

                                                    })}

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </React.Fragment>
                                )


                            })
                        }</div>

                    </div>
                </div>
            </div>
        )
    }
}

export default GradeSystems;
