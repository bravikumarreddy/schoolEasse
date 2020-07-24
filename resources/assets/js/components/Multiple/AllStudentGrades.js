import React, { useState } from 'react';
import axios from "axios";
import Loader from './Components/Loader';
import dateformat from "dateformat";

function AllStudentGrades() {

    const [search,setSearch] = useState("");
    const [loading,setLoading] = useState(false);
    const [users,setUsers] = useState([]);
    const [selectedUser,updateSelectedUser] = useState("");
    const [allExams ,setAllExams] = useState({});
    const handleSearch = async (value) => {
        if(value==""){
            setSearch(value);
            setUsers([]);
            return
        }
        setLoading(true);
        setSearch(value);
        let res = await axios.get(`/api/students/search/${value}`)
        setUsers(res.data);
        setLoading(false);
    }

    const addUser = async (item)=>{
        let res = await axios.get(`/api/exam-marks/student/${item.id}`)
        console.log(res.data);
        setAllExams(res.data);
        updateSelectedUser(item);
        setUsers([]);
    }

    return(
        <React.Fragment>
            <div className="col-md-8 mb-3 ">
                <label htmlFor="search" className="col-form-label">Search student name</label>
                <input id='search' autoComplete="off" className="form-control mr-sm-2" type="search" placeholder="Search"
                       aria-label="Search"
                       value={search}
                       onChange={(event) => {
                           handleSearch(event.target.value)
                       }}
                />
                <ul className="list-group col-10  dropdown-menu border-0 ">
                    {loading ?
                        <Loader size="2rem" margin="2"></Loader>
                        :


                        <React.Fragment>
                            {

                                users.map((val, index) => (


                                        <a key={val.id} onClick={() => addUser(val)}
                                           className=" list-group-item d-flex justify-content-between align-items-center cursor">

                                            <h5 className="m-0 p-0" ><span>{val.name} &nbsp;&nbsp; &nbsp;&nbsp;</span>
                                                <span className="badge badge-messenger"> class - {val.class_name} </span>
                                                &nbsp;&nbsp; &nbsp;&nbsp;
                                                <span className="badge badge-orange"> section - {val.section_name} </span>
                                            </h5>

                                        </a>

                                    )
                                )

                            }</React.Fragment>




                    }
                </ul>


            </div>

            <div className="col-md-8  mb-3 mt-3 ">
                {selectedUser ?
                        <ul className="list-group pt-1 ">

                                        <li key={selectedUser.id}
                                            className="list-group-item  d-flex justify-content-between align-items-center">

                                            <div className="col-6">
                                                <h5 className="m-0 p-0"><span>{selectedUser.name} &nbsp;&nbsp; &nbsp;&nbsp;</span>
                                                    <span className="badge badge-messenger"> class - {selectedUser.class_name} </span>
                                                    &nbsp;&nbsp; &nbsp;&nbsp;
                                                    <span className="badge badge-indigo"> section - {selectedUser.section_name} </span>
                                                </h5>
                                            </div>

                                        </li>
                        </ul>
                    :""
                }
            </div>
            {Object.keys(allExams).length ?

                <div className="row">

                    {Object.keys(allExams).map((value,index ) => {
                            let exam = allExams[value];

                            return (

                                    <div key={value} className="card border-0 col-5">
                                        <div className="card-body">
                                            <h4 className="card-title"> {Object.keys(exam)[0]}</h4>
                                            <table className="table table-bordered">

                                                <thead className="thead bg-orange text-white">
                                                <tr>

                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Marks</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                {exam[Object.keys(exam)[0]].map((val)=> {

                                                        return (
                                                            <tr key={val.id}>

                                                                <td>{val.name} </td>
                                                                <td>{val.marks} /{val.max_marks}</td>


                                                            </tr>
                                                        )
                                                    }

                                                )




                                                }
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                            )
                        }

                    )




                    }
                </div>
                :""

            }
        </React.Fragment>
    )
}

export default AllStudentGrades;
