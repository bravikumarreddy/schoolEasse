import React, { useState } from 'react';
import axios from "axios";
import Loader from '../Loader';
import dateformat from "dateformat";

function Individual(props) {

    const [search,setSearch] = useState("");
    const [loading,setLoading] = useState(false);
    const [users,setUsers] = useState([]);
    const [selectedUsers,updateSelectedUsers] = useState(props.individuals);

    const handleSearch = async (value) => {
        if(value==""){
            setSearch(value);
            setUsers([]);
            return
        }
        setLoading(true);
        setSearch(value);
        let res = await axios.get(`/api/users/search/${value}`)
        setUsers(res.data);
        setLoading(false);
    }

    const addUser = async (item)=>{

        let newList = selectedUsers.concat(item);
        updateSelectedUsers(newList);
        props.setIndividuals(newList);
        setUsers([]);
    }
    const deleteUser = async (index) =>{
        let newList  = Array.from(selectedUsers);
        console.log(newList);
        console.log(index);
        newList.splice(index, 1);
        console.log(newList);
        updateSelectedUsers(newList);
        props.setIndividuals(newList);
    }

    return(
        <React.Fragment>
            <div className="col-md-8 mb-3 ">
                <label htmlFor="search" className="col-form-label">Search name</label>
                <input id='search' autoComplete="off" className="form-control mr-sm-2" type="search" placeholder="Search"
                       aria-label="Search"
                       value={search}
                       onChange={(event) => {
                           handleSearch(event.target.value)
                       }}
                />
                <ul className="list-group col-5  dropdown-menu border-0 ">
                {loading ?
                    <Loader size="2rem" margin="2"></Loader>
                    :


                    <React.Fragment>
                        {

                        users.map((val, index) => (


                                <a key={val.id} onClick={() => addUser(val)}
                                   className=" list-group-item d-flex justify-content-between align-items-center cursor">

                                    <h5><span>{val.name} &nbsp;&nbsp; &nbsp;&nbsp;</span>
                                        <span className="badge badge-messenger">  {val.role}</span></h5>

                                </a>

                            )
                        )

                    }</React.Fragment>




                }
                </ul>


            </div>

            <div className="col-md-8  mb-3 mt-3 ">
                <ul className="list-group pt-1 ">
                            {
                                selectedUsers.map((val, index) => (


                                        <li key={val.id}
                                            className="list-group-item  d-flex justify-content-between align-items-center">

                                            <div className="col-6">
                                            <span>{val.name} &nbsp;&nbsp; &nbsp;&nbsp;</span>
                                                <span className="badge badge-messenger">  {val.role}</span>
                                            </div>
                                            <div className="col-3">
                                                <button type="button" className="btn btn-sm btn-danger ml-2 mr-2 "  onClick={()=>{deleteUser(index)}}>
                                                    delete
                                                </button>
                                            </div>

                                        </li>
                                    )
                                )

                            }



                </ul>
            </div>


        </React.Fragment>
    )
}

export default Individual;
