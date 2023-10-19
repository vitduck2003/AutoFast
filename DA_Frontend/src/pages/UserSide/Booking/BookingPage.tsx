import React, { useState } from "react";
// import { useNavigate } from "react-router-dom";

const BookingPage = (props: any) => {

  const dataService = props.service;

  console.log(dataService);

  // const navigate = useNavigate();

  const [selectedService, setSelectedService] = useState<{
    name: string;
    price: number;
    detail: string;
  } | null>(null);

  const laborCost = 10000; // Chi phí nhân công bảo dưỡng (200k VND)
  const extraFee = 20000; // Phụ phí (100k VND)

  type FormData = {
    full_name: string;
    phone: string;
    email: string;
    note: string;
    name_car: string;
    status: string;
    target_date: string;
    target_time: string;
    service: string;
  };

  const [formData, setFormData] = useState<FormData>({
    full_name: "",
    phone: "",
    email: "",
    note: "",
    name_car: "",
    status: "Chờ xác nhận",
    target_date: "",
    target_time: "",
    service: "",
  });

  const handleInputChange = (e: any) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));

    if (name === "service") {
      const chosenService = dataService.find((item) => item.id === parseInt(value));

      console.log(chosenService);
      
      if (chosenService) {
        setSelectedService({
          name: chosenService.name,
          price: chosenService.price,
          detail: chosenService.detail,
        });
      }
    }
  };

  const handleSubmit = (e: any) => {
    e.preventDefault();

    const updatedFormData = {
      ...formData,
    };

    console.log(updatedFormData);

    props.onAddBooking(updatedFormData);
    alert("Success");
  };

  return (
    <div style={{ marginLeft: "50px", marginRight: "50px" }}>
      <h1 style={{ textAlign: "center", marginTop: "20px" }}>Đặt lịch</h1>
      <form onSubmit={handleSubmit} style={{ marginTop: "80px" }}>
        <div className="container">
          <div className="row">
            <div className="col-md-6">
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
                placeholder="Tối thiểu 10 số"
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

              <h2 style={{ marginBottom: "30px", marginTop: "30px" }}>
                Loại xe
              </h2>
              <select
                required
                name="name_car"
                onChange={handleInputChange}
                className="form-select"
                aria-label="Default select example"
              >
                <option selected>Lựa chọn loại xe của bạn</option>
                <option value="Sedan">Sedan</option>
                <option value="HatchBack">HatchBack</option>
                <option value="SUV">SUV</option>
                <option value="Crossover">Crossover (CUV)</option>
                <option value="MPV">MPV</option>
                <option value="Coupe">Coupe</option>
                <option value="Convertible">Convertible</option>
                <option value="Pickup"> Pickup</option>
                <option value="Limousine">Limousine</option>
              </select>
              <b>
            <p style={{ marginTop: "20px" }}>
              Dịch vụ đang chọn
            </p>
          </b>
          <p>
            {selectedService ? `${selectedService.name}` : "Chưa chọn dịch vụ"}
          </p>
      
          <p style={{ color: "blue" }}>
            Đơn giá: {selectedService ? `${selectedService.price} VND` : ""}{" "}
          </p>
          {selectedService && (
            <>
              <p>Chi phí nhân công bảo dưỡng: <span style={{color: 'blue'}}>{laborCost} VND</span></p>
              <p>Phụ phí: <span style={{color: 'blue'}}>{extraFee} VND</span></p>
            </>
          )}

          <b>
            <label style={{ marginTop: "10px" }} htmlFor="">
              Tổng giá tiền:
            </label>{" "}
          </b>
          <span style={{ color: "red" }}>
            {selectedService
              ? `${selectedService.price + laborCost + extraFee} VND`
              : ""}
          </span>
            </div>
            <div className="col-md-6">
              <h2 style={{}}>Thời gian</h2>
              <label style={{ marginTop: "42px" }} htmlFor="">
                Thời gian *
              </label>
              <div className="form-row">
                <div className="col">
                  <input
                    onChange={handleInputChange}
                    name="target_date"
                    type="date"
                    lang="vi"
                    className="form-control"
                    placeholder="Ngày và Thời gian Đến"
                  />
                </div>
                <div className="col">
                  <input
                    onChange={handleInputChange}
                    name="target_time"
                    type="time"
                    lang="vi"
                    className="form-control"
                    placeholder="Ngày và Thời gian Đến"
                  />
                </div>
              </div>

              <h2 style={{ marginBottom: "30px", marginTop: "50px" }}>
                Dịch vụ
              </h2>
              <div className="form-group">
                <select
                  onChange={handleInputChange}
                  name="service"
                  className="form-control"
                  id="service"
                >
                  <option disabled="" value="0">
                    Chọn Cấp bảo dưỡng
                  </option>
                  {dataService &&
                    dataService.map((item: any) => (
                      <option key={item.id} value={item.id}>
                        {item.name}
                      </option>
                    ))}
                </select>
              </div>
              <b>
                <label style={{ marginTop: "50px" }} htmlFor="">
                  Ghi chú
                </label>
              </b>
              <textarea
                onChange={handleInputChange}
                name="note"
                className="form-control"
                id="exampleTextarea"
              ></textarea>
              <b>
            <p style={{ marginTop: "20px" }}>
              Chi tiết gói dịch vụ 
            </p>
          </b>
          <p>
            {selectedService ? `${selectedService.detail}` : "Chưa chọn dịch vụ"}
          </p>
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
        </div>
      </form>
    </div>
  );
};

export default BookingPage;
