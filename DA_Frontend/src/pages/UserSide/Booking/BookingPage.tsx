import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import Select from 'react-select';

const BookingPage = (props: any) => {
  const navigate = useNavigate();
  const options = [
    { value: 'Hà Nội', label: 'Hà Nội' },
    { value: 'TP.Hồ Chí Minh', label: 'TP.Hồ Chí Minh' },
    { value: 'Hải Phòng', label: 'Hải Phòng' },
    { value: 'Đà nẵng', label: 'Đà nẵng' },
  ];

  const [selectedOption, setSelectedOption] = React.useState(null);

  const [formData, setFormData] = useState({
    full_name: "",
    phone: "",
    email: "",
    service1: false,
    service2: false,
    service3: false,
    service4: false,
    desc: "",
    car_model: "",
    km: "",
    car_id: "",
    location: "",
    date: "",
    time: ""
  });

  const handleInputChange = (e:any) => {
    const { name, value } = e.target;
    setFormData(prevData => ({
      ...prevData,
      [name]: value
    }));
  };

  const handleCheckboxChange = (e:any) => {
    const { name, checked } = e.target;
    setFormData(prevData => ({
      ...prevData,
      [name]: checked
    }));
  };

  const handleChange = (option: any) => {
    setSelectedOption(option);
    setFormData(prevData => ({
      ...prevData,
      location: option ? option.value : ""
    }));
  };

  const handleSubmit = (e:any) => {
    e.preventDefault();
    console.log(formData);
    props.onAddBooking(formData);
    alert("Success");
    navigate("/admin/news");
  };

  return (
    <div style={{marginLeft: '50px', marginRight: '50px'}}>
      <h1 style={{textAlign: 'center', marginTop: '20px'}}>Đặt lịch</h1>
      <form onSubmit={handleSubmit} style={{marginTop: '80px'}}>
  <div className="row">
    <div className="col">
      <h2 style={{marginBottom: '30px'}}>Thông tin khách hàng</h2>
      <label style={{marginTop: '20px'}} htmlFor="">Họ và tên *</label>
      <input onChange={handleInputChange}  name="full_name" required type="text" className="form-control" placeholder="Nhập họ và tên"/>
      <label style={{marginTop: '20px'}} htmlFor="">Số điện thoại *</label>
      <input onChange={handleInputChange}  name="phone" required type="string" className="form-control" placeholder="Tổi thiểu 10 số"/>
      <label style={{marginTop: '20px'}} htmlFor="">Email *</label>
      <input onChange={handleInputChange}  name="email" required type="string" className="form-control" placeholder="vidu@gmail.com"/>
      <h2 style={{marginBottom: '30px', marginTop: '50px'}}>Dịch vụ</h2>
      {/* Checkbox service */}
      <b><label style={{marginTop: '20px'}} htmlFor="">Dịch vụ *</label></b>
      <div style={{marginBottom: '10px'}} className="form-check">
  <input onChange={handleInputChange}  className="form-check-input" type="checkbox" name="service1" id="service1" value="Bảo dưỡng"/>
  <label className="form-check-label" htmlFor="service1">
    Bảo dưỡng
  </label>
</div>
<div style={{marginBottom: '10px'}} className="form-check">
  <input onChange={handleInputChange}  className="form-check-input" type="checkbox" name="service2" id="service2" value="Sửa chữa chung"/>
  <label className="form-check-label" htmlFor="service2">
    Sửa chữa chung
  </label>
</div>
<div style={{marginBottom: '10px'}} className="form-check">
  <input onChange={handleInputChange}  className="form-check-input" type="checkbox" name="service3" id="service2" value="Đồng sơn"/>
  <label className="form-check-label" htmlFor="service3">
    Đồng sơn
  </label>
</div>
<div style={{marginBottom: '10px'}} className="form-check">
  <input onChange={handleInputChange}  className="form-check-input" type="checkbox" name="service4" id="service2" value="Dịch vụ khác"/>
  <label className="form-check-label" htmlFor="service4">
    Dịch vụ khác
  </label>
  
</div>
<div className="form-group">
  <b><label style={{marginTop: '20px'}} htmlFor="">Ghi chú</label></b>
    <textarea onChange={handleInputChange}  name="desc" className="form-control" id="exampleTextarea" ></textarea>
</div>
    </div>
    <div className="col">
      <h2 style={{marginBottom: '30px'}}>Thông tin xe</h2>
    <label style={{marginTop: '20px'}} htmlFor="">Mẫu xe *</label>
      <select onChange={handleInputChange}  name="car_model" required placeholder="Lựa chọn" className="form-control"  id="">
        <option value="">Lựa chọn</option>
        <option value="Suv">Suv</option>
        <option value="Sedan">Sedan</option>
        <option value="Hatch Back">Hatch Back</option>
        <option value="MPV">MPV</option>
      </select>
      <label style={{marginTop: '20px'}} htmlFor="">Số Km </label>
      <input onChange={handleInputChange}  name="km" required type="string" className="form-control" placeholder="Số km trên phương tiện của quý khách"/>
      <label style={{marginTop: '20px'}} htmlFor="">Biển số xe *</label>
      <input onChange={handleInputChange}  name="car_id" required type="string" className="form-control" placeholder="Nhập biển số xe"/>
      <h2 style={{marginBottom: '30px', marginTop: '50px'}}>Địa điểm và thời gian</h2>
      <label style={{marginTop: '20px'}} htmlFor="">Khu vực *</label>
      <div className="form-row">
    <div className="col">
    <Select 
        value={selectedOption}
        onChange={handleChange}
        options={options}
        isSearchable={true} 
      />
    </div>
   
  </div>
      {/* Datetime */}
      <label style={{marginTop: '20px'}} htmlFor="">Thời gian *</label>
      <div className="form-row">
    <div className="col">
      <input onChange={handleInputChange}  name="date" type="date" lang="vi" className="form-control" placeholder="Ngày Đến"/>
    </div>
    <div className="col">
      <input onChange={handleInputChange}  name="time" type="time" lang="vi" className="form-control" placeholder="Thời gian đến"/>
    </div>
  </div>

      
    </div>
  </div>
  <div className="d-flex justify-content-center mt-4">
          <button style={{width: '500px'}} type="submit" className="btn btn-primary btn-lg">Đặt lịch</button>
      </div>
      </form>

    </div>
  );
};

export default BookingPage;
