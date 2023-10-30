import React, { useState } from "react";
// import { useNavigate } from "react-router-dom";
import instance from "../../../api/instance";

const BookingPage = (props: any) => {
  const [formErrors, setFormErrors] = useState<Partial<FormData>>({});

  const validateForm = () => {
    const errors: Partial<FormData> = {};

    // Kiểm tra họ và tên
    if (!formData.full_name.trim()) {
      errors.full_name = "Họ và tên không được để trống";
    }

    // Kiểm tra số điện thoại
    const phonePattern = /^(03|07|09)\d{8}$/; // Regular expression
    if (!formData.phone.trim() || !phonePattern.test(formData.phone)) {
      errors.phone = "Số điện thoại không hợp lệ";
    }

    // Kiểm tra email
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!formData.email.trim() || !emailPattern.test(formData.email)) {
      errors.email = "Email không hợp lệ";
    }

    // Kiểm tra loại xe
    if (formData.model_car === "Lựa chọn loại xe của bạn") {
      errors.model_car = "Vui lòng chọn loại xe";
    }

    // Kiểm tra thời gian đến
    if (!formData.target_date || !formData.target_time) {
      errors.target_date = "Vui lòng chọn thời gian đến";
    }

    // Kiểm tra số KM của xe
    const mileageValue = parseInt(formData.mileage, 10);
    if (isNaN(mileageValue) || mileageValue < 0) {
      errors.mileage = "Số KM không hợp lệ";
    }

    // Kiểm tra gói bảo dưỡng
    if (formData.service === "0") {
      errors.service = "Vui lòng chọn gói bảo dưỡng";
    }

    setFormErrors(errors);

    return Object.keys(errors).length === 0; // Trả về true nếu không có lỗi
  };

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
    service_item_other: [];
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
    service_item_other: [],
  });
  const handleCheckboxChange = (e, item) => {
    const { checked, value } = e.target;

    setFormData((prevData: any) => {
      if (checked) {
        // If the checkbox is checked, add the item.id to the service_item_other array
        return {
          ...prevData,
          service_item_other: [...prevData.service_item_other, item.id],
        };
      } else {
        // If the checkbox is unchecked, remove the item.id from the service_item_other array
        return {
          ...prevData,
          service_item_other: prevData.service_item_other.filter(
            (id) => id !== item.id
          ),
        };
      }
    });
  };

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
    // console.log(formData)
    const isFormValid = validateForm();

    if (isFormValid) {
      const updatedFormData = {
        ...formData,
      };

      console.log(updatedFormData);

      props.onAddBooking(updatedFormData);
      alert("Success");
    }
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
                type="text"
                className="form-control"
                placeholder="Nhập họ và tên"
              />
              {formErrors.full_name && (
                <p style={{ color: "red" }}>{formErrors.full_name}</p>
              )}

              <label style={{ marginTop: "20px" }} htmlFor="">
                Số điện thoại *
              </label>
              <input
                onChange={handleInputChange}
                name="phone"
                type="string"
                className="form-control"
                placeholder="Tối thiểu 10 số"
              />
              {formErrors.phone && (
                <p style={{ color: "red" }}>{formErrors.phone}</p>
              )}
              <label style={{ marginTop: "20px" }} htmlFor="">
                Email *
              </label>
              <input
                onChange={handleInputChange}
                name="email"
                type="string"
                className="form-control"
                placeholder="vidu@gmail.com"
              />
              {formErrors.email && (
                <p style={{ color: "red" }}>{formErrors.email}</p>
              )}
              <b>
                <label style={{ marginTop: "50px" }} htmlFor="">
                  Loại xe
                </label>
              </b>
              <select
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
              {formErrors.model_car && (
                <p style={{ color: "red" }}>{formErrors.model_car}</p>
              )}
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
                {formErrors.target_date && (
                  <p style={{ color: "red" }}>{formErrors.target_date}</p>
                )}
              </div>

              <div style={{ marginTop: "20px" }} className="form-group">
                <label htmlFor="">Số KM của xe</label>
                <input
                  onChange={handleInputChange}
                  name="mileage"
                  type="text"
                  className="form-control"
                  placeholder="Nhập số Km của bạn"
                  min={0}
                />
              </div>
              {formErrors.mileage && (
                <p style={{ color: "red" }}>{formErrors.mileage}</p>
              )}
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
                  {dataServiceItem.map((item, index) => (
                    <div key={item.id}>
                      <label style={{ color: "blue" }}>
                        <input
                          type="checkbox"
                          value={item.price}
                          onChange={(e) => handleCheckboxChange(e, item)}
                        />
                        {item.item_name}
                      </label>
                    </div>
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
                    Gói bảo dưỡng hiện tại khác gồm:
                  </p>
                </b>
                <b>
                  <p style={{ marginTop: "20px" }}>
                    Gói bảo dưỡng hiện tại gồm:
                  </p>
                </b>
                {selectedServiceItems.length > 0 ? (
                  <>
                    {selectedServiceItems.map((item, index) => (
                      <div key={item.item_name}>
                        <label style={{ color: "blue" }}>
                          <input
                            type="checkbox"
                            value={item.item_name}
                            defaultChecked
                            disabled
                          />
                          {item.item_name}
                        </label>
                      </div>
                    ))}
                    {dataServiceItem.map((item, index) => (
                      <div key={item.id}>
                        <label style={{ color: "blue" }}>
                          <input
                            type="checkbox"
                            value={item.price}
                            onChange={(e) => handleCheckboxChange(e, item)}
                          />
                          {item.item_name}
                        </label>
                      </div>
                    ))}
                  </>
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
