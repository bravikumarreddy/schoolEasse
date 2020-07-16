import React, { useState } from 'react';

function Group(props) {
    const group = props.group;
    const setGroup = props.setGroup;
    console.log(group);
    const [value,setValue] = useState(group)
    return (
        <React.Fragment>
            <div className="custom-control custom-radio m-2">
                <input type="radio" id="all" name="customRadio" className="custom-control-input"
                       onChange={() => {
                           setValue('all');
                           setGroup('all');
                       }}

                       checked={value == 'all'}
                />
                <label className="custom-control-label" htmlFor="all">All</label>
            </div>
            <div className="custom-control custom-radio m-2">
                <input type="radio" id="students" name="customRadio" className="custom-control-input"
                       onChange={() => {
                           setValue('students');
                           setGroup('students');
                       }

                       } checked={value == 'students'}
                />
                <label className="custom-control-label" htmlFor="students" >Students</label>


            </div>
            <div className="custom-control custom-radio m-2">
                <input type="radio" id="teachers" name="customRadio" className="custom-control-input"
                       onChange={() => {
                           setValue('teachers');
                           setGroup('teachers');
                       }}

                       checked={value == 'teachers'}
                />
                <label className="custom-control-label" htmlFor="teachers">Teachers</label>
            </div>
            <div className="custom-control custom-radio m-2">
                <input type="radio" id="staff" name="customRadio" className="custom-control-input"
                       onChange={() => {
                           setValue('staff');
                           setGroup('staff');
                       }}

                       checked={value == 'staff'}
                />
                <label className="custom-control-label" htmlFor="staff">Staff</label>
            </div>


        </React.Fragment>

    )
}

export default Group;


