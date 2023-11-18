import React, { useEffect, useState } from "react";
import instance from "../../../api/instance";
import { SearchOutlined } from '@ant-design/icons';
import Highlighter from 'react-highlight-words';
import type { InputRef } from 'antd';
import { Button, Input, Space, Table } from 'antd';
import type { ColumnType, ColumnsType } from 'antd/es/table';
import type { FilterConfirmProps } from 'antd/es/table/interface';

const MyBooking = () => {
  const [user_id, setPhone] = useState("");
  const [bookings, setBookings] = useState([]);
  const [selectedJobDetails, setSelectedJobDetails] = useState(null);
  const [searchTerm, setSearchTerm] = useState("");
  const [filteredBookings, setFilteredBookings] = useState([]);
  const [showBill, setShowBill] = useState(false);
  const bookingStatuses = ["Tất cả", "Đã hoàn thành", "Đang làm", "Khác"];
  const [selectedStatus, setSelectedStatus] = useState("Tất cả");
  const [user,setUser]=useState();
  const [selectBooking,setSelectedBooking]=useState();
  const [selectJob,setSelectJob]=useState();

  const handleSearch = (event) => {
    setSearchTerm(event.target.value);
  };

  useEffect(() => {
    if (searchTerm === "") {
      setFilteredBookings(bookings);
    } else {
      const filtered = bookings.filter((booking) =>
        Object.values(booking.booking).some((value) =>
          String(value).toLowerCase().includes(searchTerm.toLowerCase())
        )
      );
      setFilteredBookings(filtered);
    }
  }, [bookings, searchTerm]);
  const toggleBill = (booking) => {
    setShowBill(!showBill);
    setSelectedBooking(booking);
  
    // console.log(booking);
  
  };
  const showJob = (jobs) => {
    setSelectJob(jobs);
    console.log(selectJob);
  };
  // Define the selected booking status
  useEffect(() => {
    const storedUser = sessionStorage.getItem("user");
    if (storedUser) {
      try {
        const userData = JSON.parse(storedUser);
        setPhone(userData.phone);
        setUser(userData);
      } catch (e) {
        console.error("Failed to parse user data from session storage", e);
      }
    }
  }, []);
  // console.log(user)
  useEffect(() => {
    if (selectedStatus === "Tất cả") {
      // Show all bookings
      setFilteredBookings(bookings);
    } else {
      // Filter bookings based on the selected status
      const filtered = bookings.filter((booking) =>
        booking.booking.status === selectedStatus
      );
      setFilteredBookings(filtered);
    }
  }, [bookings, selectedStatus]);

  // Handle filter button click
  const handleFilter = (status) => {
    setSelectedStatus(status);
  };

// console.log(bookings);
  useEffect(() => {
    if (user_id) {
      const postPhone = async () => {
        try {
          const response = await instance.post("/client/bookings", { user_id });
          console.log(response);
          const allBookings = response.data.flatMap(innerArray => innerArray);
          setBookings(allBookings);
        } catch (error) {
          console.error("Error:", error);
        }
      };

      postPhone();
    }
  }, [user_id]);

  const containerStyle = {
    display: 'flex',
    flexDirection: 'column',
    justifyContent: 'center', // centers vertically in the flex container
    alignItems: 'center', // centers horizontally in the flex container
    height: '100vh', // sets the height of the container to be the full viewport height
    textAlign: 'center', // centers the text inside the container
  };
  

  
  const thStyle = {
    backgroundColor: '#f0f0f0',
    color: '#333',
    fontWeight: 'bold',
    padding: '10px',
    border: '1px solid #ccc',
  };
  
  const tdStyle = {
    padding: '8px',
    border: '1px solid #ccc',
  };
  

  const ulStyle = {
    listStyleType: 'none',
    padding: '0',
    margin: '0',
  };
  const goToPayment = (booking) => {
    // Extract the required properties from the booking object
    const bookingId = booking.id;
    const serviceName = "Thanh toán " + booking.service_name; // Prefixing service_name
  
    // Calculate the total price by summing the item_price of each job
    const totalPrice = booking.total_amount;
    console.log(booking);
  
    // Construct the data object with the properties you want to send
    const postData = {
      id: bookingId,
      service_name: serviceName,
      total_price: totalPrice,
      redirect: true // Add the redirect parameter
    };
  
    // Send the data object in the POST request
    instance.post("/payment", postData)
      .then(response => {
        console.log(response.data);
        if (response.data.code === '00') {
          window.location.href = response.data.redirect_url;
        } else {
          // Xử lý lỗi nếu cần
        }
      })
      .catch(error => {
        console.error("Lỗi r:", error);
      });
  };
  
  
  
  
  
  const showJobDetails = (jobs) => {
    setSelectedJobDetails(jobs);
    console.log(jobs);
  };

  // Function to close job details view
  const closeJobDetails = () => {
    setSelectedJobDetails(null);
  };
  const backdropStyle = {
    position: 'fixed',
    top: 0,
    left: 0,
    right: 0,
    bottom: 0,
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
    display: 'flex',
    justifyContent: 'center',
    alignItems: 'center',
    zIndex: 1050, // Make sure it's on top of other content
  };
  
  // Styles for the modal content area
  const modalContentStyle = {
    backgroundColor: '#ffffff',
    padding: '20px',
    borderRadius: '8px',
    boxShadow: '0 4px 8px rgba(0, 0, 0, 0.2)',
    width: '90%', // You can adjust the width as needed
    maxWidth: '600px', // You can adjust the maximum width as needed
    maxHeight: '60vh',
    overflowY: 'auto',
  };

  const tableStyle = {
    margin: "0 auto",
    textAlign: "center",
  };
  
  // Styles for the modal header, if you have one
  const modalHeaderStyle = {
    borderBottom: '1px solid #eeeeee',
    paddingBottom: '10px',
    marginBottom: '20px',
  };
  const billContainerStyle = {
    position: 'fixed',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    backgroundColor: '#ffffff',
    padding: '20px',
    borderRadius: '8px',
    boxShadow: '0 4px 8px rgba(0, 0, 0, 0.2)',
    width: '90%', // You can adjust the width as needed
    maxWidth: '600px', // You can adjust the maximum width as needed
    maxHeight: '60vh',
    overflowY: 'auto',
    zIndex: 1051, // Make sure it's on top of the backdrop
  };
  
  const closeBillButtonStyle = {
    backgroundColor: '#007bff', // Bootstrap primary color
    color: 'white',
    border: 'none',
    padding: '10px 20px',
    borderRadius: '5px',
    cursor: 'pointer',
    float: 'right', // If you want it to be on the right
  };
  
  // Styles for the modal body
  const modalBodyStyle = {
    paddingBottom: '20px',
    marginBottom: '20px',
  };
  
  // Styles for the close button
  const closeButtonStyle = {
    backgroundColor: '#007bff', // Bootstrap primary color
    color: 'white',
    border: 'none',
    padding: '10px 20px',
    borderRadius: '5px',
    cursor: 'pointer',
    float: 'right', // If you want it to be on the right
  };
  
  const liStyle = {
    padding: '3px',
  };
  const buttonStyle = {
    margin: '5px',
    // padding: '10px 15px',
    cursor: 'pointer',
  };
  
  return ( 
    <div>
    <div className="container-fluid page-header mb-5 p-0" id=''>
    <div className="container-fluid page-header-inner py-5" id=''>
        <div className="container text-center" id=''>
            <h1 className="display-3 text-white mb-3 animated slideInDown" id=''>About Us</h1>
            <nav aria-label="breadcrumb" id=''>
                <ol className="breadcrumb justify-content-center text-uppercase" id=''>
                    <li className="breadcrumb-item" id=''><a href="#">Home</a></li>
                    <li className="breadcrumb-item" id=''><a href="#">Pages</a></li>
                    <li className="breadcrumb-item text-white active" aria-current="page" id=''>About Us</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    <div style={containerStyle}>
      <h1 style={{ textAlign: 'center' }}>Lịch của tôi</h1>
      {/* Phần tìm kiếm và filter */}
      <div className="form-group row">
  <div className=" timkiem" >
    <input className="form-control" placeholder="Tìm kiếm" type="text" value={searchTerm}
            onChange={handleSearch}/>
  </div>
  <div style={{ margin: "20px", display: "flex", gap: "10px" }}>
  {bookingStatuses.map((status) => (
    <Button
      key={status}
      style={{
        backgroundColor: selectedStatus === status ? "#007bff" : "gray",
        color: "white",
        border: "none",
        // padding: "10px 20px",
        borderRadius: "5px",
        cursor: "pointer",
      }}
      onClick={() => handleFilter(status)}
    >
      {status}
    </Button>
  ))}
</div>
  
  
</div>

{showBill && (
   <div style={backdropStyle}>
  <div style={billContainerStyle}>
    {/* Add your bill content here */}
    <h2>Hóa đơn</h2>
    <hr />
    
    <div style={{ textAlign: 'left' }}>
      <b>Thông tin khách hàng</b>
  <div >
    <b>Tên khách hàng : </b>{user.name}
  </div>
  <div >
    <b>Số điện thoại  : </b>{user.phone}
  </div>
  <div >
    <b>Email : </b>{user.email}
  </div>
  <div >
  <b>Loại xe : </b>{selectBooking.model_car}
</div>
  <div >
    <b>Số km đã đi : </b>{selectBooking.mileage} Km
  </div>
  <div>
  <b>Tất cả dịch vụ </b>
  <table style={{ width: '100%', borderCollapse: 'collapse', marginTop: '10px', marginBottom: '10px' }}>
    <thead>
      <tr>
        <th style={{ backgroundColor: '#f2f2f2', padding: '8px', textAlign: 'left' }}>ID</th>
        <th style={{ backgroundColor: '#f2f2f2', padding: '8px', textAlign: 'left' }}>Name</th>
        <th style={{ backgroundColor: '#f2f2f2', padding: '8px', textAlign: 'left' }}>Price</th>
      </tr>
    </thead>
    <tbody>
      {selectJob.map((job) => (
        <tr key={job.id} style={{ border: '1px solid #ddd' }}>
          <td style={{ padding: '8px' }}>{job.id}</td>
          <td style={{ padding: '8px' }}>{job.item_name}</td>
          <td style={{ padding: '8px' }}>{job.price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</td>
        </tr>
      ))}
    </tbody>
    <tfoot>
      <tr>
        <td colSpan="2" style={{ textAlign: 'right', fontWeight: 'bold' }}>Total:</td>
        <td style={{ padding: '8px', fontWeight: 'bold' }}>
          {selectJob.reduce((total, job) => total + job.price, 0).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}
        </td>
      </tr>
    </tfoot>
  </table>
</div>
 
</div>

    {/* You can display the bill details here */}
    <Button onClick={()=>goToPayment(selectBooking)}>
      Thanh toán 

    </Button>
    <button style={closeBillButtonStyle} onClick={toggleBill}>
      Đóng hóa đơn
    </button>
  </div>
  </div>
)}
          {selectedJobDetails && (
    <div style={backdropStyle}>
      <div style={modalContentStyle}>
        <div style={modalHeaderStyle}>
          <h4>Chi tiết công việc</h4>
        </div>
        <div style={modalBodyStyle}>
          <table style={tableStyle}>
            <thead>
              <tr>
                <th style={thStyle}>Tên công việc</th>
                <th style={thStyle}>Thời gian dự kiến hoàn thành</th>
                <th style={thStyle}>Trạng Thái </th>
                <th style={thStyle}>Tên người phụ trách </th>

                <th style={thStyle}>Giá tiền</th>
              </tr>
            </thead>
            <tbody>
              {selectedJobDetails.map((job) => (
                <tr key={job.id}>
                  <td style={tdStyle}>{job.item_name}</td>
                  <td style={tdStyle}>{job.target_time_done}</td>
                  <td style={tdStyle}>{job.status}</td>
                
                  <td style={tdStyle}>{job.staff_name}</td>

                  <td style={tdStyle}>{job.item_price.toLocaleString()} VND</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
        <button style={closeButtonStyle} onClick={closeJobDetails}>
          Đóng
        </button>
      </div>
    </div>
  )}
      {bookings.length > 0 ? (
        <table style={tableStyle}>
          <thead>
            <tr>
              <th style={thStyle}>ID</th>
              <th style={thStyle}>Ngày đến</th>
              <th style={thStyle}>Giờ đến</th>
              <th style={thStyle}>Ghi chú</th>
              <th style={thStyle}>Loại xe</th>
              <th style={thStyle}>Dịch vụ </th>

              <th style={thStyle}>Trạng Thái </th>
              {/* <th style={thStyle}>Các công việc</th> */}
              <th style={thStyle}>Hành động</th>

              
            </tr>
          </thead>
          <tbody>
          {filteredBookings.map((booking) => (
              <tr key={booking.booking.id}>
                <td style={tdStyle}>{booking.booking.id}</td>
              
                <td style={tdStyle}>{booking.booking.target_date}</td>
                <td style={tdStyle}>{booking.booking.target_time}</td>
                <td style={tdStyle}>{booking.booking.note}</td>
                <td style={tdStyle}>{booking.booking.model_car}</td>
                <td style={tdStyle}>{booking.booking.service_name}</td>

                <td style={tdStyle}>{booking.booking.status}</td>
             
              
              
                <td style={tdStyle}>
                 
               
                    <Button onClick={() => showJobDetails(booking.jobs)}>
                    Xem chi tiết
                    </Button>

                    {booking.booking.status === 'Đã hoàn thành' && (
  <Button
  name="redirect"
  style={buttonStyle}
  onClick={() =>{ toggleBill( booking.booking)
    showJob(booking.jobs)
  }}
>
  Xem hóa đơn
</Button>
)}
                </td>
             
              </tr>
            ))}
          </tbody>
        </table>
        
      ) : (
        <p>Loading...</p>
      )}
    </div>
    </div>
  );
};

export default MyBooking;
