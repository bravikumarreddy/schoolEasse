import React from 'react';
function Loader() {
  return (
        <div className="d-flex justify-content-center">
          <div className="spinner-border   m-5" role="status" style={{width: "3rem", height: "3rem"}} >
            <span className="sr-only">Loading...</span>
          </div>
         </div>
  )

}

export default Loader;
