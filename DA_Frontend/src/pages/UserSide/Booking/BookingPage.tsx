import React, { useState,useEffect } from "react";
import React, { useState,useEffect } from "react";
// import { useNavigate } from "react-router-dom";
import instance from "../../../api/instance";

const BookingPage = (props: any) => {
  const [formErrors, setFormErrors] = useState<Partial<FormData>>({});
 
  const [phone, setPhone] = useState("");
  const [email, setEmail] = useState("");
  const [name, setName] = useState("");
  const maintenanceIntervals = {
    'Bảo dưỡng cấp 1': [5000, 15000, 25000],
    'Bảo dưỡng cấp 2': [10000, 30000, 50000],
    'Bảo dưỡng cấp 3': [20000, 60000, 100000],
    'Bảo dưỡng cấp 4': [40000, 80000, 120000],
  };
  useEffect(() => {
    const storedUser = sessionStorage.getItem("user");
    if (storedUser) {
      try {
        const userData = JSON.parse(storedUser);
        setPhone(userData.phone);
        setEmail(userData.email);
        setName(userData.name);
      } catch (e) {
        console.error("Failed to parse user data from session storage", e);
      }
    }
  }, []);
  console.log(phone)
  const styles = {
    table: {
      width: '100%',
      borderCollapse: 'collapse',
    },
    th: {
      border: '1px solid #ddd',
      padding: '8px',
      textAlign: 'left',
      backgroundColor: '#f2f2f2',
    },
    td: {
      border: '1px solid #ddd',
      padding: '8px',
    },
  };
  const validateForm = () => {
    const errors = {};
  
    // Kiểm tra họ và tên
    if (!formData.full_name.trim() && !name.trim()) {
      errors.full_name = "Họ và tên không được để trống";
    }
  
    // Kiểm tra số điện thoại
    const phonePattern = /^(03|07|09)\d{8}$/; // Regular expression
    if (!formData.phone.trim() && !phone.trim() && !phonePattern.test(formData.phone)) {
      errors.phone = "Số điện thoại không hợp lệ";
    }
  
    // Kiểm tra email
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!formData.email.trim() && !email.trim() && !emailPattern.test(formData.email)) {
      errors.email = "Email không hợp lệ";
    }
  
    // Kiểm tra loại xe
    if (!formData.model_car || formData.model_car === "Lựa chọn loại xe của bạn") {
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
    if (!formData.service || formData.service === "0") {
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
  console.log(dataService);

  const [kmMessage, setKmMessage] = useState<string>("");
  // const navigate = useNavigate();

  const [selectedService, setSelectedService] = useState<{
    service_name: string;
    price: number;
    detail: string;
  } | null>(null);



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

  useEffect(() => {
    if (phone!="") {
      // Phone number exists, set data for name, phone, and email
      setFormData({
        full_name: name, // Replace with actual data
        phone: phone,
        email:email, // Replace with actual data
        note: "",
        model_car: "",
        status: "Chờ xác nhận",
        target_date: "",
        target_time: "",
        service: "",
        mileage: "",
        service_item_other: [],
      });
    } else {
      // No phone number, set initial empty form data
      setFormData({
        full_name: "", // Replace with actual data
        phone: "",
        email: "", // Replace with actual data
        note: "",
        model_car: "",
        status: "Chờ xác nhận",
        target_date: "",
        target_time: "",
        service: "",
        mileage: "",
        service_item_other: [],
      });
    }
  }, [phone]);
  const handleCheckboxChange = (e, item) => {
    // Phần select action để cộng vào cả tổng giá tiền
    if (e.target.checked) {
      setSelectedTotal(selectedTotal + item.price);
    } else {
      setSelectedTotal(selectedTotal - item.price);
    }
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
  const totalCost = selectedServiceItems.reduce(
    (total, item) => total + item.price,
    0
  );

  const [selectedTotal, setSelectedTotal] = useState(0);

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

  onChange={name === "" ? handleInputChange : undefined}
  name="full_name"
  type="text"
  className="form-control"
  placeholder="Nhập họ và tên"
  value={name}
  disabled={name !== ""}
/>

              {formErrors.full_name && (
                <p style={{ color: "red" }}>{formErrors.full_name}</p>
              )}

<label style={{ marginTop: "20px" }} htmlFor="">
        Số điện thoại *
      </label>
   

      {phone ===""? <input

        onChange={handleInputChange}
        name="phone"
        type="text" // Sửa type thành "text" thay vì "string"
        className="form-control"
        placeholder="Tối thiểu 10 số"
      
      /> :  <input
      onChange={handleInputChange}
      name="phone"
      type="text" // Sửa type thành "text" thay vì "string"
      className="form-control"
      placeholder="Tối thiểu 10 số"
      value={phone} 
      disabled
    />}
              {formErrors.phone && (
                <p style={{ color: "red" }}>{formErrors.phone}</p>
              )}
<label>
         
  Email *
</label>
<input
  onChange={handleInputChange}
  name="email"
  type="string"
  className="form-control"
  placeholder="vidu@gmail.com"
  value={email === "" ? undefined : email}
  disabled={email !== ""}
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
              <div>
                
              </div>

              {formErrors.mileage && (
                <p style={{ color: "red" }}>{formErrors.mileage}</p>
              )}
              <table style={styles.table}>
      <thead>
        <tr>
          <th style={styles.th}>Cấp Bảo dưỡng</th>
          <th style={{ ...styles.th, textAlign: 'center' }} colSpan="4">Số km theo mỗi cấp bảo dưỡng </th>
          {/* Add more <th> elements if you have more columns */}
        </tr>
      </thead>
      <tbody>
        {Object.entries(maintenanceIntervals).map(([level, distances]) => (
          <tr key={level}>
            <td style={styles.td}>{level}</td>
            {distances.map((distance, index) => (
              <td key={index} style={styles.td}>{distance.toLocaleString()} km</td>
            ))}<td style={styles.td}>...</td>
          </tr>
        ))}
      </tbody>
    </table>
              <div className="form-group">
                <label htmlFor="">Gói Bảo dưỡng</label>
                <select
                  onChange={handleInputChange}
                  name="service"
                  className="form-control"
                  id="service"
                  value={formData.service}
                >
                  <option value="" disabled>
                    Vui lòng chọn gói bảo dưỡng
                  </option>
                  {dataService.map((item) => (
                    <option key={item.id} value={item.id}>
                      <label> {item.service_name}</label>
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
                  <>
                    {" "}
                    <table
                      style={{
                        width: "100%",
                        borderCollapse: "collapse",
                        border: "1px solid #ddd",
                        marginTop: "20px",
                      }}
                    >
                      <thead>
                        <tr>
                          <th
                            style={{
                              backgroundColor: "#f2f2f2",
                              textAlign: "left",
                              padding: "8px",
                            }}
                          >
                            Action
                          </th>
                          <th
                            style={{
                              backgroundColor: "#f2f2f2",
                              textAlign: "left",
                              padding: "8px",
                            }}
                          >
                            Service
                          </th>
                          <th
                            style={{
                              backgroundColor: "#f2f2f2",
                              textAlign: "left",
                              padding: "8px",
                            }}
                          >
                            Price
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        {selectedServiceItems.map((item, index) => (
                          <tr key={item.item_name}>
                            <td style={{ borderRight: "1px solid #ddd" }}>
                              <input
                                type="checkbox"
                                value={item.item_name}
                                disabled
                                defaultChecked
                                style={{
                                  width: "20px",
                                  height: "20px",
                                  border: "1px solid #ccc",
                                  borderRadius: "3px",
                                  cursor: "pointer",
                                  verticalAlign: "middle",
                                  // margin: '0 10px 0 0',
                                  marginLeft: "10px",
                                  paddingLeft: "10px",
                                }}
                              />
                            </td>
                            <td style={{ borderRight: "1px solid #ddd" ,   marginLeft: "10px",
                                  paddingLeft: "10px", }}>
                              <b>{item.item_name}</b>
                            </td>
                            <td style={{ padding: "8px" }}>
  <b>{item.price.toLocaleString("vi-VN")} VND</b>
</td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                    <b>
                      <p style={{ marginTop: "20px" }}>
                        Dịch vụ khác :
                        <table
                          style={{
                            width: "100%",
                            borderCollapse: "collapse",
                            border: "1px solid #ddd",
                            marginTop: "20px",
                          }}
                        >
                          <thead>
                            <tr>
                              <th
                                style={{
                                  backgroundColor: "#f2f2f2",
                                  textAlign: "left",
                                  padding: "8px",
                                }}
                              >
                                Action
                              </th>
                              <th
                                style={{
                                  backgroundColor: "#f2f2f2",
                                  textAlign: "left",
                                  padding: "8px",
                                }}
                              >
                                Service
                              </th>
                              <th
                                style={{
                                  backgroundColor: "#f2f2f2",
                                  textAlign: "left",
                                  padding: "8px",
                                }}
                              >
                                Price
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            {dataServiceItem
                              .filter((item) => item.id_service === null)
                              .map((item, index) => (
                                <tr key={item.id}>
                                  <td style={{ borderRight: "1px solid #ddd" }}>
                                    <input
                                      type="checkbox"
                                      value={item.price}
                                      onChange={(e) =>
                                        handleCheckboxChange(e, item)
                                      }
                                      style={{
                                        width: "20px",
                                        height: "20px",
                                        border: "1px solid #ccc",
                                        borderRadius: "3px",
                                        cursor: "pointer",
                                        verticalAlign: "middle",
                                        // margin: '0 10px 0 0',
                                        marginLeft: "10px",
                                        paddingLeft: "10px",
                                      }}
                                    />
                                  </td>
                                  <td style={{ borderRight: "1px solid #ddd" ,   marginLeft: "10px",
                                  paddingLeft: "10px", }}>
                                    {item.item_name}
                                  </td>
                                  <td style={{ padding: "8px" }}>
  <b>{item.price.toLocaleString("vi-VN")} VND</b>
</td>
                                </tr>
                              ))}
                          </tbody>
                        </table>
                      </p>
                    </b>
                  </>
                ) : (
                  <p>Chưa có thông tin chi tiết cho gói dịch vụ này.</p>
                )}

                <b>
                  <label style={{ marginTop: "10px" }} htmlFor="">
                    Tổng giá tiền:
                  </label>{" "}
                </b>
                <span style={{ color: "red" }}>
  {(totalCost + selectedTotal).toLocaleString("vn-VN")} VND
</span>
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
