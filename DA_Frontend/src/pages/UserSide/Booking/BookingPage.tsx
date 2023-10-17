import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import Select from "react-select";

const BookingPage = (props: any) => {
  const [detailContent, setDetailContent] = useState("");
  const [showDetail, setShowDetail] = useState(false);

  
 

  
  const dataService = props.service;

console.log(dataService)
 
  const navigate = useNavigate();
  
  const BaoDuong = Array.isArray(dataService) 
    ? dataService.filter(item => item.service_id === 1) 
    : [];

const SuaChua = Array.isArray(dataService) 
    ? dataService.filter(item => item.service_id === 2) 
    : [];
const Dongson = Array.isArray(dataService) 
? dataService.filter(item => item.service_id === 3) 
: [];

  
  
  type FormData = {
    full_name: string;
    phone: string;
    email: string;
    note: string;
    name_car: string;
    status: string;
  };
  
  const [formData, setFormData] = useState<FormData>({
    full_name: "",
    phone: "",
    email: "",
    note: "",
    name_car: "",
    status: "Chờ xác nhận",
  });
  const [formCheckBox, setFormCheckBox] = useState({
    baoduong: false,
    suachua: false,
    dongson: false,
  });

  const handleInputChange = (e: any) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleCheckboxChange = (e: any) => {
    const { name, checked } = e.target;
    setFormCheckBox((prevData) => ({
      ...prevData,
      [name]: checked,
    }));
  };

  
  
  

  const handleSubmit = (e: any) => {
    e.preventDefault();
  
    const Dichvu: { [key: string]: number[] } = {};
  
    if (formCheckBox.baoduong) {
      Dichvu.baoduong = BaoDuong.filter(item => formCheckBox[item.name]).map(item => item.id);
    }
  
    if (formCheckBox.suachua) {
      Dichvu.suachua = SuaChua.filter(item => formCheckBox[item.name]).map(item => item.id);
    }
  
    if (formCheckBox.dongson) {
      Dichvu.dongson = Dongson.filter(item => formCheckBox[item.name]).map(item => item.id);
    }
  
    const updatedFormData = {
      ...formData,
      Dichvu,
    };
  
    console.log(updatedFormData);
  
    props.onAddBooking(updatedFormData);
    alert("Success");
  };

  return (
    <div style={{ marginLeft: "50px", marginRight: "50px" }}>
      <h1 style={{ textAlign: "center", marginTop: "20px" }}>Đặt lịch</h1>
      <form onSubmit={handleSubmit} style={{ marginTop: "80px" }}>
        <div >
          <div >
            <h2 style={{ marginBottom: "30px" }}>Thông tin khách hàng</h2>
            <label style={{ marginTop: "20px" }} htmlFor="">
              Họ và tên *
            </label>
            <input
              onChange={handleInputChange}
              name="full_name"
              required
              type="text"
              className="form-control"
              placeholder="Nhập họ và tên"
            />
            <label style={{ marginTop: "20px" }} htmlFor="">
              Số điện thoại *
            </label>
            <input
              onChange={handleInputChange}
              name="phone"
              required
              type="string"
              className="form-control"
              placeholder="Tổi thiểu 10 số"
            />
            <label style={{ marginTop: "20px" }} htmlFor="">
              Email *
            </label>
            <input
              onChange={handleInputChange}
              name="email"
              required
              type="string"
              className="form-control"
              placeholder="vidu@gmail.com"
            />
            <h2 style={{ marginBottom: "30px", marginTop: '30px' }}>Tên xe</h2>
            <input
              onChange={handleInputChange}
              name="name_car"
              required
              type="string"
              className="form-control"
              placeholder="Tên loại xe của quý khách"
            />
            <h2 style={{ marginBottom: "30px", marginTop: "50px" }}>
              Thời gian
            </h2>

            {/* Datetime */}
            <label style={{ marginTop: "20px" }} htmlFor="">
              Thời gian *
            </label>
            <div className="form-row">
              <div className="col">
                <input
                  onChange={handleInputChange}
                  name="target_datetime"
                  type="datetime-local"
                  lang="vi"
                  className="form-control"
                  placeholder="Ngày và Thời gian Đến"
                />
              </div>
            </div>
            <h2 style={{ marginBottom: "30px", marginTop: "50px" }}>Dịch vụ</h2>
            {/* Checkbox service */}
            <b>
              
              <label style={{ marginTop: "20px" }} htmlFor="">
                Dịch vụ *
              </label>
            </b>
            <div style={{ marginBottom: "10px" }} className="form-check">
  <input
    onChange={handleCheckboxChange}
    className="form-check-input"
    type="checkbox"
    name="baoduong"
    id="baoduong"
    value="service[1]"
  />
  <div className="row">
    <div className="cols">
      <label className="form-check-label" htmlFor="baoduong">
        Bảo dưỡng
      </label>
    </div>
    <div className="cols">
      {formCheckBox.baoduong && (
        <div>
          {BaoDuong.map((item) => (
            <div key={item.id} className="form-check">
            <input
              onChange={handleCheckboxChange}
              className="form-check-input"
              type="checkbox"
              name={item.name}
              id={item.name}
              value={item.id}
            />
            <label className="form-check-label" htmlFor={item.name}>
              {item.name}
            </label>
          </div>
          ))}
        </div>
      )}
    </div>
  </div>
</div>
<div style={{ marginBottom: "10px" }} className="form-check">
  <input
    onChange={handleCheckboxChange}
    className="form-check-input"
    type="checkbox"
    name="suachua"
    id="suachua"
    value="service[2]"
  />
  <div className="row">
    <div className="cols">
      <label className="form-check-label" htmlFor="suachua">
        Sửa chữa chung
      </label>
    </div>
    <div className="cols">
      {formCheckBox.suachua && (
        <div>
          {SuaChua.map((item) => (
            <div key={item.id} className="form-check">
              <input
                onChange={handleCheckboxChange}
                className="form-check-input"
                type="checkbox"
                name={item.name}
                id={item.name}
                value={item.id}
              />
              <label className="form-check-label" htmlFor={item.name}>
                {item.name}
              </label>
            </div>
          ))}
        </div>
      )}
    </div>
  </div>
</div>
<div style={{ marginBottom: "10px" }} className="form-check">
  <input
    onChange={handleCheckboxChange}
    className="form-check-input"
    type="checkbox"
    name="dongson"
    id="dongson"
    value="service[3]"
  />
  <div className="row">
    <div className="cols">
      <label className="form-check-label" htmlFor="dongson">
        Đồng sơn
      </label>
    </div>
    <div className="cols">
      {formCheckBox.dongson && (
        <div>
          {Dongson.map((item) => (
            <div key={item.id} className="form-check">
              <input
                onChange={handleCheckboxChange}
                className="form-check-input"
                type="checkbox"
                name={item.name}
                id={item.name}
                value={item.id}
              />
              <label className="form-check-label" htmlFor={item.name}>
                {item.name}
              </label>
            </div>
          ))}
        </div>
      )}
    </div>
  </div>
</div>
            <div className="form-group">
              <b>
                <label style={{ marginTop: "20px" }} htmlFor="">
                  Ghi chú
                </label>
              </b>
              <textarea
                onChange={handleInputChange}
                name="note"
                className="form-control"
                id="exampleTextarea"
              ></textarea>
            </div>
          </div>
          
        </div>
        <div className="d-flex justify-content-center mt-4">
          <button
            style={{ width: "500px" }}
            type="submit"
            className="btn btn-primary btn-lg"
          >
            Đặt lịch
          </button>
          
        </div>
      </form>
    </div>
  );
};

export default BookingPage;
