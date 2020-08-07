import React, { useState, useEffect } from 'react';
import axios from "axios";
import Loader from '../Loader';

function ExamSelector(props) {

    const [classes,setClasses] = useState([] );
    const [class_id,setClass] = useState("");
    const [classLoading,setClassLoading] = useState(false);
    const [exams,setExams] = useState([]);
    const [exam_id,setExam] = useState('');
    const [examLoading,setExamLoading] = useState(false);
    const getClasses = async () =>{
        setClassLoading(true);
        let res = await axios.get(`/api/classes`);
        setClasses(res.data);
        setClassLoading(false);
    }

    const getExams = async ()=>{
        setExamLoading(true);
        let res = await axios.get(`/api/class_exams`,{
            params:{
                class_id : class_id,
            }

        });
        setExams(res.data);
        setExamLoading(false);
    }

    useEffect( ()=>{
        getClasses();

    },[])


    useEffect(()=>{
        getExams();
    },[class_id]);

    useEffect(()=>{
      props.setExam(exam_id);
    },[exam_id])

    return (

        <div className="form-group">
            {classLoading ?
                <Loader size="2rem" margin="3"></Loader>
                :
                <React.Fragment>
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



                </React.Fragment>

            }
            { examLoading ?
                <Loader size="2rem" margin="3"></Loader>
                :
                <React.Fragment>
                    {class_id?

                    <div className="col-md-4 mb-3 ">
                        <label htmlFor="fee_structure" className="col-form-label">Select Exam</label>
                        <select value={exam_id} id="fee_structure"
                                className="form-control custom-select" name="fee_structure"
                                onChange={(event) => {
                                    setExam(event.target.value);

                                }}
                        >
                            <option value="">Exam</option>
                            {exams.map(val => (
                                <option key={val.id} value={val.id}>{val.exam_name}</option>
                            ))}
                        </select>

                    </div>:""

                    }
                </React.Fragment>

            }

        </div>

    )
}

export default ExamSelector;
