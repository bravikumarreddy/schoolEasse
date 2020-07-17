import React from 'react';
function Loader(props) {
  let size = "3rem";
  let margin = "5"
  if(props.size){
     size=props.size;
  }
  if(props.margin){
    margin=props.margin
  }
  return (
        <div className="d-flex justify-content-center">
          <div className={`spinner-border   m-${margin} `} role="status" style={{width: size, height: size}} >
            <span className="sr-only">Loading...</span>
          </div>
         </div>
  )

}

export default Loader;
