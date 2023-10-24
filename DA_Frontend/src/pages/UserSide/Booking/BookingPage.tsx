import React, { useState } from "react";
// import { useNavigate } from "react-router-dom";

const BookingPage = (props: any) => {
  const dataService = props.service;
  const dataServiceItem = props.serviceItem;
  const [selectedServiceItems, setSelectedServiceItems] = useState<
    Array<{
      item_name: string;
      price: number;
    }>
  >([]);

  // console.log(dataService);
  console.log(dataServiceItem);

  const [kmMessage, setKmMessage] = useState<string>("");
  // const navigate = useNavigate();

  const [selectedService, setSelectedService] = useState<{
    service_name: string;
    price: number;
    detail: string;
  } | null>(null);

  const NhanCong = 10000;

  type FormData = {
    full_name: string;
    phone: string;
    email: string;
    note: string;
    model_car: string;
    status: string;
    target_date: string;
    target_time: string;
    service: string;
    mileage: string;
  };

  const [formData, setFormData] = useState<FormData>({
    full_name: "",
    phone: "",
    email: "",
    note: "",
    model_car: "",
    status: "Chờ xác nhận",
    target_date: "",
    target_time: "",
    service: "",
    mileage: "",
  });

  const handleInputChange = (e: any) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));

    if (name === "mileage") {
      const kmValue = parseInt(value, 10);
      let recommendedServiceId = null;

      if (kmValue < 1000) {
        setKmMessage("Xe của bạn chưa cần bảo dưỡng");
      } else if (kmValue >= 1000 && kmValue < 5000) {
        setKmMessage("Khuyến nghị bảo dưỡng cấp độ 1");
        recommendedServiceId = 1;
      } else if (kmValue > 5000 && kmValue < 10000) {
        setKmMessage("Khuyến nghị bảo dưỡng cấp độ 2");
        recommendedServiceId = 2;
      } else if (kmValue >= 10000 && kmValue <= 15000) {
        setKmMessage("Khuyến nghị bảo dưỡng cấp độ 3");
        recommendedServiceId = 3;
      } else if (kmValue > 15000) {
        setKmMessage("Khuyến nghị bảo dưỡng cấp độ 3");
        recommendedServiceId = 3;
      }

      if (recommendedServiceId !== null) {
        const chosenService = dataService.find(
          (item) => item.id === recommendedServiceId
        );
        if (chosenService) {
          setSelectedService({
            service_name: chosenService.service_name,
            price: chosenService.price,
            detail: chosenService.detail,
          });

          const correspondingServiceItems = dataServiceItem.filter(
            (item) => item.id_service === chosenService.id
          );

          if (correspondingServiceItems) {
            setSelectedServiceItems(correspondingServiceItems);
          } else {
            setSelectedServiceItems(null);
          }

          setFormData((prevData) => ({
            ...prevData,
            service: recommendedServiceId.toString(),
          }));
        }
      }
    }

    if (name === "service") {
      const chosenService = dataService.find(
        (item) => item.id === parseInt(value)
      );

      if (chosenService) {
        setSelectedService({
          service_name: chosenService.service_name,
          price: chosenService.price,
          detail: chosenService.detail,
        });

        // Tìm serviceItem dựa vào id_service
        const correspondingServiceItems = dataServiceItem.filter(
          (item) => item.id_service === chosenService.id
        );

        if (correspondingServiceItems) {
          setSelectedServiceItems(correspondingServiceItems);
        } else {
          setSelectedServiceItems(null);
        }
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
  const totalCost =
    selectedServiceItems.reduce((total, item) => total + item.price, 0) +
    NhanCong;

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

              <b>
                <label style={{ marginTop: "50px" }} htmlFor="">
                  Loại xe
                </label>
              </b>
              <select
                required
                name="model_car"
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
            </div>
            <div className="col-md-6">
              <h2 style={{}}>Dịch vụ và thời gian</h2>
              <label style={{ marginTop: "42px" }} htmlFor="">
                Thời gian đến *
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

              <div style={{ marginTop: "20px" }} className="form-group">
                <label htmlFor="">Số KM của xe</label>
                <input
                  onChange={handleInputChange}
                  name="mileage"
                  required
                  type="text"
                  className="form-control"
                  placeholder="Nhập số Km của bạn"
                  min={0}
                />
              </div>
              <div className="form-group">
                <label htmlFor="">Gói Bảo dưỡng</label>
                <select
                  onChange={handleInputChange}
                  name="service"
                  className="form-control"
                  id="service"
                  value={formData.service}
                >
                  <option
                    disabled={formData.service && formData.service !== "0"}
                    value="0"
                  >
                    Chọn Cấp bảo dưỡng
                  </option>
                  {dataService &&
                    dataService.map((item: any) => (
                      <option key={item.id} value={item.id}>
                        {item.service_name}
                      </option>
                    ))}
                </select>
                <p
                  style={{
                    paddingLeft: "10px",
                    paddingTop: "20px",
                    color: "blue",
                  }}
                >
                  {kmMessage}
                </p>
                <b>
                  <p style={{ marginTop: "20px" }}>
                    Gói bảo dưỡng hiện tại gồm:
                  </p>
                </b>

                {selectedServiceItems.length > 0 ? (
                  selectedServiceItems.map((item, index) => (
                    <p style={{ color: "blue" }} key={index}>
                      {item.item_name} : {item.price} VND
                    </p>
                  ))
                ) : (
                  <p>Chưa có thông tin chi tiết cho gói dịch vụ này.</p>
                )}
                {selectedService && (
                  <>
                    <p>
                      Chi phí nhân công bảo dưỡng:{" "}
                      <span style={{ color: "blue" }}>{NhanCong} VND</span>
                    </p>
                  </>
                )}

                <b>
                  <label style={{ marginTop: "10px" }} htmlFor="">
                    Tổng giá tiền:
                  </label>{" "}
                </b>
                <span style={{ color: "red" }}>{totalCost} VND</span>
              </div>
            </div>
          </div>

          <div className="d-flex justify-content-center mt-4">
            <button
              style={{ width: "500px" }}
              type="submit"
              className="btn btn-primary btn-lg"
              disabled={!selectedService}
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
