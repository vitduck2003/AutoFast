import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import Select from "react-select";

const BookingPage = (props: any) => {
  const [detailContent, setDetailContent] = useState("");
  const [showDetail, setShowDetail] = useState(false);

  const navigate = useNavigate();
  const Div = ["Thay Dầu", "Thay Lốp", " Lau kính xe"];
  const [formData, setFormData] = useState({
    full_name: "",
    phone: "",
    email: "",
    service1: false,
    service2: false,
    service3: false,
    service4: false,
    desc: "",
    name_car: "",
    car_id: "",
    location: "",
    date: "",
    time: "",
  });
  const [formCheckBox, setFormCheckBox] = useState({
    service1: false,
    service2: false,
    service3: false,
    service4: false,
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
    console.log(formData);
    props.onAddBooking(formData);
    alert("Success");
    navigate("/admin/news");
  };

  return (
    <div style={{ marginLeft: "50px", marginRight: "50px" }}>
      <h1 style={{ textAlign: "center", marginTop: "20px" }}>Đặt lịch</h1>
      <form onSubmit={handleSubmit} style={{ marginTop: "80px" }}>
        <div className="row">
          <div className="col">
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
                name="service1"
                id="service1"
                value="Bảo dưỡng"
              />
              <div className="row">
                <div className="cols">
                  <label className="form-check-label" htmlFor="service1">
                    Bảo dưỡng
                  </label>
                </div>
                <div className="cols">
                  <span
                    style={{ color: "blue" }}
                    onClick={() => handleShowDetail(Div)}
                  >
                    Chi tiết
                  </span>
                  {formCheckBox.service1 && (
              <div>
                {Div.map((item, index) => (
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
                name="service2"
                id="service2"
                value="Sửa chữa chung"
                onClick={() => handleShowDetail()}
              />
              <div className="row">
                <div className="cols">
                  <label className="form-check-label" htmlFor="service1">
                    Sửa chữa chung
                  </label>
                </div>
                <div className="cols">
                  <span
                    style={{ color: "blue" }}
                    onClick={() => handleShowDetail()}
                  >
                    Chi tiết
                  </span>
                  {formCheckBox.service2 && <div>this is text for service2</div>}
                </div>
                {/* Modal Bootstrap */}
                <div
                  className="modal fade"
                  id="serviceDetailModal"
                  tabIndex={-1}
                  role="dialog"
                  aria-labelledby="serviceDetailLabel"
                  aria-hidden="true"
                >
                  <div className="modal-dialog" role="document">
                    <div className="modal-content">
                      <div className="modal-header">
                        <h5 className="modal-title" id="serviceDetailLabel">
                          Chi tiết dịch vụ
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
                      <div className="modal-body">{detailContent}</div>
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
            </div>
            <div style={{ marginBottom: "10px" }} className="form-check">
              <input
                onChange={handleCheckboxChange}
                className="form-check-input"
                type="checkbox"
                name="service3"
                id="service2"
                value="Đồng sơn"
              />
              <div className="row">
                <div className="cols">
                  <label className="form-check-label" htmlFor="service1">
                    Đồng sơn
                  </label>
                </div>
                <div className="cols">
                  <span
                    style={{ color: "blue" }}
                    onClick={() => handleShowDetail("Đồng sơn ")}
                  >
                    Chi tiết
                  </span>
                </div>
              </div>
            </div>
            <div style={{ marginBottom: "10px" }} className="form-check">
              <input
                onChange={handleCheckboxChange}
                className="form-check-input"
                type="checkbox"
                name="service4"
                id="service2"
                value="Dịch vụ khác"
              />
              <div className="row">
                <div className="cols">
                  <label className="form-check-label" htmlFor="service1">
                    Dịch vụ khác
                  </label>
                </div>
                <div className="cols">
                  <span
                    style={{ color: "blue" }}
                    onClick={() => handleShowDetail("Dịch vụ khác ")}
                  >
                    Chi tiết
                  </span>
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
          <div className="col">
            <h2 style={{ marginBottom: "30px" }}>Tên xe</h2>
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
