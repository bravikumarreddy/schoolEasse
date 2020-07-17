import React, { useState, useEffect } from 'react';
import axios from "axios";
import Loader from '../Loader';
function ClassSection(props) {
    const [classes,setClasses] = useState([]);
    const [sections,setSections] = useState([]);
    const [class_id,setClass] = useState("");
    const [classLoading,setClassLoading] = useState(false);
    const [selectSections,setSelectSections] = useState({});

    const getClasses = async () =>{
        setClassLoading(true);
        let res = await axios.get(`/api/classes`);
        setClasses(res.data);
        setClassLoading(false);
    }

    const getSections = async (class_id) =>{
        if(class_id=="") return
        let res = await axios.get(`/api/sections`,{
            params:{
                class_id : class_id,
            }
        });
        setSections(res.data);
        var selectSections = {};
        res.data.map(val=>{
            selectSections[val.id]=false;
        })
        setSelectSections(selectSections);
        props.setSections(selectSections);
    }

    const handleChange = (section_id) =>{
        let newObj = {...selectSections,[section_id]:!selectSections[section_id]}
        setSelectSections(newObj);
        props.setSections(newObj);
    }




    useEffect( ()=>{
        getClasses();

        return ()=>{ props.setSections({})}
    },[])

    useEffect( ()=>{
        getSections(class_id);
    },[class_id])

    return (

        <div className="form-group">
            {classLoading ?
                <Loader size="2rem" margin="3" ></Loader>
                :
                <div className="col-md-4 mb-3 ">
                    <label htmlFor="fee_structure" className="col-form-label">Select Class</label>
                    <select value={class_id} id="fee_structure"
                            className="form-control custom-select" name="fee_structure"
                            onChange={(event) => setClass(event.target.value)}

                            >
                        <option value="">Class</option>
                        {classes.map(val => (
                            <option key={val.id} value={val.id}>{val.class_number}</option>
                        ))}
                    </select>

                </div>

            }
            { class_id ?


                    <div className="col-md-4 mb-3 ">
                    {sections.length
                        ?

                        <React.Fragment>
                            <h6><b>Sections</b></h6>
                            {sections.map(val => (
                                <div key={val.id} className="custom-control mb-2 custom-checkbox">
                                    <input type="checkbox"
                                           className="custom-control-input"
                                           id={`{customCheck${val.id}`}
                                           checked={selectSections[val.id] ? true:false  }
                                           onChange={()=>handleChange(val.id)}


                                    />
                                    <label className="custom-control-label" htmlFor={`{customCheck${val.id}`} > {val.section_number}</label>
                                </div>
                            ))}
                        </React.Fragment>
                        :
                        <p className="text-danger">No sections under this class</p>




                    }
                    </div>


                :

                ""

            }


       </div>

    )
}

export default ClassSection;




