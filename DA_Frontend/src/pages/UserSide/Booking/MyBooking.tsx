import React, { useEffect, useState } from "react";
import instance from "../../../api/instance";

const MyBooking = () => {
  const [phone, setPhone] = useState("");
  const [bookings, setBookings] = useState([]);

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
  
  const tableStyle = {
    width: '80%', // sets the width of the table to 80% of its container
    borderCollapse: 'collapse',
    marginTop: '20px',
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
  const goToPayment = (bookingId) => {
    history.push(`/payment/${bookingId}`); // Adjust the path as needed
  };


  const liStyle = {
    padding: '3px',
  };
  const buttonStyle = {
    margin: '5px',
    padding: '10px 15px',
    cursor: 'pointer',
  };
  return (
    <div style={containerStyle}>
      <h1 style={{ textAlign: 'center' }}>Lịch của tôi</h1>
      {bookings.length > 0 ? (
        <table style={tableStyle}>
          <thead>
            <tr>
              <th style={thStyle}>ID</th>
              <th style={thStyle}>Ngày đến</th>
              <th style={thStyle}>Giờ đến</th>
              <th style={thStyle}>Ghi chú</th>
              <th style={thStyle}>Loại xe</th>
           
              <th style={thStyle}>Trạng Thái </th>
              <th style={thStyle}>Các công việc</th>
              <th style={thStyle}>Hành động</th>

              
            </tr>
          </thead>
          <tbody>
            {bookings.map((booking) => (
              <tr key={booking.booking.id}>
                <td style={tdStyle}>{booking.booking.id}</td>
              
                <td style={tdStyle}>{booking.booking.target_date}</td>
                <td style={tdStyle}>{booking.booking.target_time}</td>
                <td style={tdStyle}>{booking.booking.note}</td>
                <td style={tdStyle}>{booking.booking.model_car}</td>
               
                <td style={tdStyle}>{booking.booking.status}</td>
                <td style={tdStyle}>
                  <ul style={ulStyle}>
                    {booking.jobs.map((job) => (
                      <li key={job.id} style={liStyle}>
                        {job.item_name} - {job.item_price}
                      </li>
                    ))}
                  </ul>
                </td>
              
                {/* ... other table cells ... */}
                <td style={tdStyle}>
                 
                  <button  onClick={() => {/* Define function to show job details */}}>
                    Xem chi tiết
                  </button>

               
                  {booking.booking.status === 'Đã hoàn thành' && (
                    <button style={buttonStyle} onClick={() => goToPayment(booking.booking.id)}>
                      Thanh toán
                    </button>
                  )}
                </td>
             
              </tr>
            ))}
          </tbody>
        </table>
      ) : (
        <p>No bookings found.</p>
      )}
    </div>
  );
};

export default MyBooking;
