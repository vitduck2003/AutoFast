import React, { useState } from "react";
import searchBooking from "../../../assets/img/searchBooking.png";



const SearchBooking = () => {
  
  return (
    <div>
      <div className="container-fluid page-header mb-5 p-0">
        <div className="container-fluid page-header-inner py-5">
          <div className="container text-center">
            <h1 className="display-3 text-white mb-3 animated slideInDown">
              Tìm kiếm lịch bảo dưỡng
            </h1>
          </div>
        </div>
      </div>
      <div style={{ marginTop: "50px" }} className="container">
        <div className="row">
          <div style={{ marginTop: "20px" }} className="col-md-6 form-search">
            <b>
              <p>Tra Cứu Lịch Bảo Dưỡng</p>
            </b>
            <p>Số điện thoại:</p>
            <form className="form-inline" onSubmit={(e) => e.preventDefault()}>
          <input
            style={{ width: "100%" }}
            className="form-control mr-sm-2"
            type="text" 
            placeholder="VD: 0989898989"
            aria-label="Search"
           
          />
         
         
          </form>
          <button
            style={{ marginTop: "25px" }}
            className="btn btn-primary"
            type="submit"
          
          >
            Tra cứu
          </button>
          
          <button
            style={{ marginTop: "25px", marginLeft: "20px" }}
            className="btn btn-info"
            data-toggle="modal"
            data-target="#exampleModal"
          >
            Thông tin lịch
          </button>
        
            {/* <!-- Modal --> */}
            <div
              className="modal fade"
              id="exampleModal"
              role="dialog"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div className="modal-dialog" role="document">
                <div className="modal-content">
                  <div className="modal-header">
                    <h5 className="modal-title" id="exampleModalLabel">
                    Kết quả tìm kiếm:
                    </h5>
                    <button
                      type="button"
                      className="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div className="modal-body">
                   
                  </div>
                  <div className="modal-footer">
                    <button
                      type="button"
                      className="btn btn-secondary"
                      data-dismiss="modal"
                  
                    >
                      Close
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div className="col-md-6" style={{ marginTop: "-80px" }}>
            <img src={searchBooking} alt="" />
          </div>
        </div>
      </div>
    </div>
  );
};

export default SearchBooking;
