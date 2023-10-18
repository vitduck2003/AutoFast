import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import Select from "react-select";

const BookingPage = (props: any) => {
  const [detailContent, setDetailContent] = useState("");
  const [showDetail, setShowDetail] = useState(false);

  
 

  
  const dataService = props.service;

console.log(dataService)
 
  const navigate = useNavigate();
  

  
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


  const handleInputChange = (e: any) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  
  

  const handleSubmit = (e: any) => {
    e.preventDefault();
  
    const Dichvu: { [key: string]: number[] } = {};
  
  
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
       
            <div className="form-group">
 
  <select
    onChange={handleInputChange}
    name="service"
    className="form-control"
    id="service"
  >
    <option disabled="" value="0">Chọn Cấp bảo dưỡng</option>
    <option value="151">Cấp 1 (Bảo dưỡng tại 1K, 5K, 25K, 35K,...) 1K=1000Km</option>
    <option value="152">Cấp 2 (Bảo dưỡng tại 10K, 30K, 50K, 70K,...) 1K=1000Km</option>
    <option value="153">Cấp 3 (Bảo dưỡng tại 20K, 60K, 100K,...) 1K=1000Km</option>
    <option value="154">Cấp 4 (Bảo dưỡng tại 40K, 80K, 120K,...) 1K=1000Km</option>
  </select>
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
