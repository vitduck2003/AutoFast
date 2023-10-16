import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import Select from "react-select";

const BookingPage = (props: any) => {
  const [detailContent, setDetailContent] = useState("");
  const [showDetail, setShowDetail] = useState(false);

  const navigate = useNavigate();
  const BaoDuong = ["Bảo dưỡng cơ bản", "Bảo dưỡng trung cấp", " Bảo dưỡng cao cấp"];
  const SuaChua = [
    "Hệ thống phanh",
    "Hệ thống lái",
    " Hệ thống điện, điều hòa",
  ];
  const Dongson = [
    "Sơn cơ bản",
    "Sơn Trung Cấp",
    "Sơn cao cấp",
  ];
  const [formData, setFormData] = useState({
    full_name: "",
    phone: "",
    email: "",
    baoduong: false,
    suachua: false,
    dongson: false,
    dichvukhac: false,
    desc: "",
    name_car: "",
    status: "Chờ xác nhận",
    });
  const [formCheckBox, setFormCheckBox] = useState({
    baoduong: false,
    suachua: false,
    dongson: false,
    dichvukhac: false,
  });

  const handleInputChange = (e: any) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleCheckboxChange = (e) => {
    const { name, checked } = e.target;
    setFormCheckBox((prevData) => ({
      ...prevData,
      [name]: checked,
    }));
  };

  const handleShowDetail = () => {
    setShowDetail(!showDetail);
  };

  const handleSubmit = (e: any) => {
    e.preventDefault();
    
    // Hợp nhất dữ liệu từ formCheckBox vào formData
    const updatedFormData = {
      ...formData,
      ...formCheckBox
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
                  name="datetime"
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
                      {BaoDuong.map((item, index) => (
                        <div key={index} className="form-check">
                          <input
                            onChange={handleCheckboxChange}
                            className="form-check-input"
                            type="checkbox"
                            name={item}
                            id={item}
                            value={`service[1][${index + 1}]`}
                          />
                          <label className="form-check-label" htmlFor={item}>
                            {item}
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
                onClick={() => handleShowDetail()}
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
                      {SuaChua.map((item, index) => (
                        <div key={index} className="form-check">
                          <input
                            onChange={handleCheckboxChange}
                            className="form-check-input"
                            type="checkbox"
                            name={item}
                            id={item}
                          />
                          <label className="form-check-label" htmlFor={item}>
                            {item}
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
          
              </div>
            </div>
            <div style={{ marginBottom: "10px" }} className="form-check">
              <input
                onChange={handleCheckboxChange}
                className="form-check-input"
                type="checkbox"
                name="dichvukhac"
                id="dichvukhac"
                value="service[4]"
              />
              <div className="row">
                <div className="cols">
                  <label className="form-check-label" htmlFor="dichvukhac">
                    Dịch vụ khác
                  </label>
                </div>
                <div className="cols">
                  {formCheckBox.dichvukhac && (
                    <div>
                      {
                        <div className="form-check">
                          <span>
                            Vui lòng nêu chi tiết dịch vụ khác mà bạn muốn sử dụng phía dưới
                          </span>
                        </div>
                      }
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
                name="desc"
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
