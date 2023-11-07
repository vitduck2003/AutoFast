import React, { useEffect, useState } from "react";
import instance from "../../../api/instance";
import { SearchOutlined } from '@ant-design/icons';
import Highlighter from 'react-highlight-words';
import type { InputRef } from 'antd';
import { Button, Input, Space, Table } from 'antd';
import type { ColumnType, ColumnsType } from 'antd/es/table';
import type { FilterConfirmProps } from 'antd/es/table/interface';

const MyBooking = () => {
  const [phone, setPhone] = useState("");
  const [bookings, setBookings] = useState([]);
  const [selectedJobDetails, setSelectedJobDetails] = useState(null);
  const [searchTerm, setSearchTerm] = useState("");
  const [filteredBookings, setFilteredBookings] = useState([]);

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

  useEffect(() => {
    const storedUser = sessionStorage.getItem("user");
    if (storedUser) {
      try {
        const userData = JSON.parse(storedUser);
        setPhone(userData.phone);
      } catch (e) {
        console.error("Failed to parse user data from session storage", e);
      }
    }
  }, []);
console.log(bookings);
  useEffect(() => {
    if (phone) {
      const postPhone = async () => {
        try {
          const response = await instance.post("/client/bookings", { phone });
          const allBookings = response.data.flatMap(innerArray => innerArray);
          setBookings(allBookings);
        } catch (error) {
          console.error("Error:", error);
        }
      };

      postPhone();
    }
  }, [phone]);

  const containerStyle = {
    display: 'flex',
    flexDirection: 'column',
    justifyContent: 'center', // centers vertically in the flex container
    alignItems: 'center', // centers horizontally in the flex container
    height: '100vh', // sets the height of the container to be the full viewport height
    textAlign: 'center', // centers the text inside the container
  };
  
  // const tableStyle = {
  //   width: '80%', // sets the width of the table to 80% of its container
  //   borderCollapse: 'collapse',
  //   marginTop: '20px',
  // };
  
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
    const bookingId = booking.booking.id;
    const serviceName = "Thanh toán " + booking.booking.service_name; // Prefixing service_name
  
    // Calculate the total price by summing the item_price of each job
    const totalPrice = booking.jobs.reduce((sum, job) => sum + job.item_price, 0);
  
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
        console.error("Lỗi con mẹ r:", error);
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
    maxHeight: '90vh',
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
    <div style={containerStyle}>
      <h1 style={{ textAlign: 'center' }}>Lịch của tôi</h1>
      {/* Phần tìm kiếm và filter */}
      <div className="form-group row">
  <div className=" timkiem" >
    <input className="form-control" placeholder="Tìm kiếm" type="text" value={searchTerm}
            onChange={handleSearch}/>
  </div>
  
</div>

      {/* {selectedJobDetails && (
            <div style={{ padding: '20px', border: '1px solid #ccc', marginTop: '20px', borderRadius: '5px', position: 'absolute', background: 'white', zIndex: '10' }}>
              <h2>Các công việc</h2>
              <ul style={ulStyle}>
                {selectedJobDetails.map((job) => (
                  <li key={job.id} style={liStyle}>
                    {job.item_name} - {job.item_price}
                  </li>
                ))}
              </ul>
              <button style={buttonStyle} onClick={closeJobDetails}>
                Đóng
              </button>
            </div>
          )} */}
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
                   <Button name="redirect" style={buttonStyle} onClick={() => goToPayment(booking)}>
                   Thanh toán
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
  );
};

export default MyBooking;
