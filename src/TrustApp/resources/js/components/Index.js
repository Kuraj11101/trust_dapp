import React from 'react';
import ReactDOM from 'react-dom';
import { Component } from '../../../public/js/app';
//import HomeBody from './HomeBody';

export default class Index extends Component {
    render(){
        return (
            <div className="container col-xxl-8 px-4 py-5">
        <div className="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div className="col-10 col-sm-8 col-lg-6">
            <img src={Hero} className="d-block mx-lg-auto img-fluid hero_img" alt="trust logo" width="800" height="800" loading="lazy" />
          </div>
          <div className="col-lg-6">
            <h1 className="display-5 fw-bold lh-1 mb-3">Welcome to Trust!</h1>
            <p className="fs-5">Real-time Investing and Payment for Businesses and Employees</p>
            <p className="fs-5">Sign up and join the new world of finance</p>
            <div className="d-grid gap-2 d-md-flex justify-content-md-start mt-5">
              <Link to="/business-registration">
                <button type="button" className="btn btn-primary btn-lg px-4 me-md-2">Business</button>
              </Link>
              <Link to="/registration">
                <button type="button" className="btn btn-primary btn-lg px-4">Personal</button>
              </Link>
            </div>
          </div>
        </div>
      </div>
        );
    }
}
    

// export default TrustApp;

if (document.getElementById('index')) {
    ReactDOM.render(<Index />, document.getElementById('index'));
}
