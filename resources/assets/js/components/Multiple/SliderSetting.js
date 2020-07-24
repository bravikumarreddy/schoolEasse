import React from 'react';
import Loader from './Components/Loader'
import axios from "axios";
import dateformatter from "dateformat";

class SliderSetting extends React.Component {
    constructor(props) {
        super(props);

        this.state= {
           image1:"",
            image1Src:"https://www.dell.org/wp-content/uploads/2020/04/indian-school-children-social-impact.jpeg",
            prevTitle:"",
            prevDescription:"",
            title:"",
            description:"",
            imageNumber:1,
            isInvalid:false,




        }
        this.fileChangedHandler = this.fileChangedHandler.bind(this);
        this.fileChangedHandler = this.fileChangedHandler.bind(this);
        this.uploadHandler = this.uploadHandler.bind(this);
        this.getImage = this.getImage.bind(this);
    }

    async getImage(imageNumber){
        var res = await axios.get(`/api/dashboard/setting/upload-image/get`,{
            params:{
                image_number : imageNumber,
            }
        });
        console.log(res);

        if(res.data != null){
            this.setState({image1Src:res.data.url_path,prevTitle:res.data.title,prevDescription:res.data.description});
        }

        this.setState({imageNumber:imageNumber});
    }

    async componentDidMount() {
        await this.getImage(this.state.imageNumber);
    }

    fileChangedHandler (event)  {
        const file = event.target.files[0];
        const width  = file.naturalWidth  || file.width;
        const height = file.naturalHeight || file.height;

        console.log(file);
        console.log(height);

        this.setState({image1:event.target.files[0]})
    }

    async uploadHandler(){
        window.URL = window.URL || window.webkitURL;
        let img =  new Image();
        let imageFile = this.state.image1;

        img.src = window.URL.createObjectURL( this.state.image1 );
        let width = "";
        let height =""
        let thisRef = this;
        img.onload = async function() {
            let width = img.naturalWidth;
            let height = img.naturalHeight;
            window.URL.revokeObjectURL( img.src );
            var data = new FormData();

            console.log(width,height);
            if(width != 1600){
                thisRef.setState({isInvalid: true});
                return ;
            }
            if(height != 900){
                thisRef.setState({isInvalid: true});
                return ;
            }
            thisRef.setState({isInvalid: false});
            data.append('image',imageFile);
            data.append('title',thisRef.state.title);
            data.append('description',thisRef.state.description);
            data.append('image_number',thisRef.state.imageNumber);

            let res = await axios.post("/dashboard/setting/upload-image", data,{
                method:"POST",
                headers:
                    {
                        'X-CSRF-TOKEN':csrf_token,

                    }
            });
            console.log(res);
            thisRef.setState({image1Src:res.data.imgUrlpath });


        };

        console.log(this.state.image);
    }

    render() {

        return (
            <React.Fragment>
                <form onSubmit={(event)=> {event.preventDefault();this.uploadHandler()}}>


                    <div className="row">
                        <div className="card col-8 shadow-lg mt-4 p-0 overflow-hidden ">
                            <div className="card-body p-0 m-0 ">
                                <img className="d-block w-100"
                                     src={this.state.image1Src}
                                     alt="First slide"/>
                                <div className="carousel-caption d-none d-md-block">
                                    <h2><b>{this.state.prevTitle}</b></h2>
                                    <h3> {this.state.prevDescription}</h3>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div className="form-group  mt-5 mb-5">

                        <div className="col-md-4 mb-3 ">
                            <label htmlFor="image" className="col-form-label">Select Image</label>
                            <select value={this.state.imageNumber} id="fee_structure" className=" custom-select form-control"
                                    name="fee_structure"
                                    onChange={(event) => this.getImage(event.target.value)}>
                                <option value="1">1</option>

                                <option  value="2">2</option>
                                <option  value="3">3</option>

                            </select>
                        </div>

                        <div className="col-md-4 mb-3 ml-3 mt-3 ">

                            <input type="file" className="custom-file-input" id="customFile"
                                   required
                                   onChange={this.fileChangedHandler}
                            />
                            <label className="custom-file-label" htmlFor="customFile">{this.state.image1 ? this.state.image1.name : "Choose file"} </label>
                            {this.state.isInvalid?
                                <div className="invalid-feedback is-invalid d-block">
                                    <h6><strong>Image size should be 1600px x 900px</strong></h6>
                                </div>
                                :
                                ""
                            }
                        </div>

                        <div className="col-md-4 mb-3">
                            <label className="col-form-label" htmlFor="title">Title </label>

                            <input type="text" id="title" className="form-control"
                                   id="title"
                                   value={this.state.title}
                                   accept="image/*"
                                   onChange={(event)=>this.setState({title:event.target.value})}
                                   required
                            />

                        </div>

                        <div className="col-md-4 mb-3">
                            <label className="col-form-label" htmlFor="description">Description </label>
                            <textarea  id="description"
                                       className="form-control"
                                       value={this.state.description}
                                       onChange={(event)=>this.setState({description:event.target.value})}
                                       id="title"
                                       required
                            />

                        </div>


                        <button type="submit" className="btn mt-3 ml-3  btn-primary" >
                            Save Changes
                        </button>
                    </div>

                </form>
            </React.Fragment>
        )
    }
}

export default SliderSetting;
