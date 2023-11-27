import React from "react";
import { Outlet } from "react-router-dom";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import Header from "./Header";
const BaseLayout = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(false); // Trạng thái đăng nhập
  const [userName,setUserName] =useState(); //
  const [img,setImg]=useState(); //
  const [isDropdownVisible, setDropdownVisible] = useState(false);
  // Kiểm tra Session Storage khi trang được tải
  useEffect(() => {
    const sessionData = sessionStorage.getItem("user");
    console.log({sessionData});
    if (sessionData) {
      // Session Storage tồn tại, người dùng đã đăng nhập
      const userData = JSON.parse(sessionData); // Parse the JSON string into an object
    setImg(userData.avatar);
     setUserName( userData.name)
      setIsLoggedIn(true);
    }
  }, []);
 
 
  console.log(userName)
  function clearSession() {
    // Xóa toàn bộ dữ liệu từ Session Storage
    sessionStorage.clear();

    // Hoặc nếu bạn chỉ muốn xóa một mục cụ thể, bạn có thể sử dụng:
    // sessionStorage.removeItem('yourKey');
  }
  const userTextStyle = {
    display: 'inline-block',
    cursor: 'pointer',
  };
  const avatarUser = {
    width:'30px',
    height:'30px',
    borderRadius:'99%'
  }
  const dropdownContentStyle = {
    display: isDropdownVisible ? 'block' : 'none',
    position: 'absolute',
    backgroundColor: '#f9f9f9',
    minWidth: '160px',
    boxShadow: '0px 8px 16px 0px rgba(0,0,0,0.2)',
    zIndex: '10',
  };

  const dropdownContentLinkStyle = {
    display: 'block',
    padding: '12px 16px',
    textDecoration: 'none',
    color: 'black',
  };

  const toggleDropdown = () => {
    setDropdownVisible(!isDropdownVisible);
  };

  return (
    <div>

       <div className="container-fluid bg-light p-0">
        <div className="row gx-0 d-none d-lg-flex">
          <div className="col-lg-7 px-5 text-start">
            <div className="h-100 d-inline-flex align-items-center py-3 me-4">
              {/* <small className="fa fa-map-marker-alt text-primary me-2"></small> */}
              <small> 📍 Số 88 Đường Quang Trung, Hà Đông, Hà Nội</small>
            </div>
            <div className="h-100 d-inline-flex align-items-center py-3">
              {/* <small className="far fa-clock text-primary me-2"></small> */}
              <small> 🕒 Thứ hai - Thứ bảy : 08.00 AM - 09.00 PM</small>
            </div>
          </div>
          <div className="col-lg-5 px-5 text-end">
            <div className="h-100 d-inline-flex align-items-center py-3 me-4">
              {/* <small className="fa fa-phone-alt text-primary me-2"></small> */}
              <small> ☎ +84 988 678 999 </small>
          
              <div>
      {isLoggedIn && (
        <div className="user-info">
          <small
            className="px-5"
            style={userTextStyle}
            onClick={toggleDropdown}
          >
            Xin chào,<img style={avatarUser} src={
                      img ? `http://localhost:8000/storage/${img}` : ""
                    }/>  
                    {userName}
          </small>
          <div style={dropdownContentStyle}>
          
            <Link style={dropdownContentLinkStyle} to="/mybooking">Quản lý lịch của tôi</Link>
            <Link style={dropdownContentLinkStyle} to={`/account`}>Quản lý tài khoản</Link>
            <Link style={dropdownContentLinkStyle} to={`/mybill`}>Quản lý Hóa đơn </Link>
            <a  href="/" style={dropdownContentLinkStyle} onClick={clearSession}>Logout</a>
          </div>
        </div>
      )}
    </div>


           
            </div>
            <div className="h-100 d-inline-flex align-items-center">
           
            {isLoggedIn ? (
      <b style={{ color: "blue" }}>
      
      </b>
    ) : (
      <div className="h-100 d-inline-flex align-items-center">
        <b style={{ color: "blue" }}>
          <a style={{ paddingRight: '20px' }} href="/signup" className="nav-item nav-link">
            Đăng Ký
          </a>{" "}
        </b>

        <b style={{ color: "blue" }}>
          <a href="/signin" className="nav-item nav-link">
            Đăng Nhập
          </a>
        </b>
      </div>
    )}
            </div>
          </div>
        </div>
      </div> 
 
      <nav className="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0" style={{ zIndex: 1 }}>
        <a
          href="/"
          className="navbar-brand d-flex align-items-center px-4 px-lg-5"
        >
          <h2 className="m-0 text-primary">
            Auto Fast
          </h2>
        </a>
        <button
          type="button"
          className="navbar-toggler me-4"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarCollapse">
          <div className="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" className="nav-item nav-link ">
              Trang Chủ
            </a>

            <a href="/about" className="nav-item nav-link">
              Về chúng tôi
            </a>
            <a href="/service" className="nav-item nav-link">
              Dịch vụ
            </a>
            <div className="nav-item dropdown">
              <a
                href="#"
                className="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
              >
                Pages
              </a>
              <div className="dropdown-menu fade-up m-0">
                <a href="booking" className="dropdown-item">
                  Đặt lịch
                </a>

                <a href="technicians" className="dropdown-item">
                  Kỹ thuật viên
                </a>
              </div>
            </div>
            <a href="contact" className="nav-item nav-link">
              Liên hệ
            </a>
            <a href="news" className="nav-item nav-link">
              Tin Tức
            </a>
          </div>
          <a
            href="booking"
            className="btn btn-primary py-4 px-lg-5 d-none d-lg-block"
          >
            Đặt lịch ngay
          </a>
        </div>
      </nav> 
      <div>
        <Header></Header>
      </div>

      
      <Outlet />
      <div
        className="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn"
        data-wow-delay="0.1s"
      >
        <div className="container py-5">
          <div className="row g-5">
            <div className="col-lg-3 col-md-6">
              <h4 className="text-light mb-4">Địa chỉ</h4>
              <p className="mb-2">
                <i className="fa fa-map-marker-alt me-3"></i>Số 88 Đường Quang
                Trung, Hà Đông, Hà Nội
              </p>
              <p className="mb-2">
                <i className="fa fa-phone-alt me-3"></i>+84 988 678 999
              </p>
              <p className="mb-2">
                <i className="fa fa-envelope me-3"></i>autofast@gara.com
              </p>
              <div className="d-flex pt-2">
                <a className="btn btn-outline-light btn-social" href="">
                  <i className="fab fa-twitter"></i>
                </a>
                <a className="btn btn-outline-light btn-social" href="">
                  <i className="fab fa-facebook-f"></i>
                </a>
                <a className="btn btn-outline-light btn-social" href="">
                  <i className="fab fa-youtube"></i>
                </a>
                <a className="btn btn-outline-light btn-social" href="">
                  <i className="fab fa-linkedin-in"></i>
                </a>
              </div>
            </div>
            <div className="col-lg-3 col-md-6">
              <h4 className="text-light mb-4">Thời gian mở cửa</h4>
              <h6 className="text-light">Thứ hai - Thứ sáu:</h6>
              <p className="mb-4">08.00 AM - 09.00 PM</p>
              <h6 className="text-light">Thứ bảy - Chủ Nhật:</h6>
              <p className="mb-0">09.00 AM - 12.00 PM</p>
            </div>
            <div className="col-lg-3 col-md-6">
              <h4 className="text-light mb-4">Dịch vụ</h4>
              <a
                style={{ textDecoration: "none" }}
                className="btn btn-link"
                href=""
              >
                Bảo dưỡng xe
              </a>
              <a
                style={{ textDecoration: "none" }}
                className="btn btn-link"
                href=""
              >
                Thay phụ tùng
              </a>
              <a
                style={{ textDecoration: "none" }}
                className="btn btn-link"
                href=""
              >
                Thay dầu
              </a>
              <a
                style={{ textDecoration: "none" }}
                className="btn btn-link"
                href=""
              >
                Sửa chữa
              </a>
              <a
                style={{ textDecoration: "none" }}
                className="btn btn-link"
                href=""
              >
                Vệ sinh
              </a>
            </div>
          </div>
        </div>
        {/* <div className="container">
          <div className="copyright">
            <div className="row">
              <div className="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <a
                  style={{ textDecoration: "none" }}
                  className="border-bottom"
                  href="#"
                >
                  Dịch vụ bảo dưỡng xe Auto Fast
                </a>
                , All Right Reserved.
              </div>
              <div className="col-md-6 text-center text-md-end">
                <div className="footer-menu">
                  <a style={{ textDecoration: "none" }} href="/">
                    Trang Chủ
                  </a>
                  <a style={{ textDecoration: "none" }} href="booking">
                    Đặt lịch
                  </a>
                  <a style={{ textDecoration: "none" }} href="about">
                    Về chúng tôi
                  </a>
                  <a style={{ textDecoration: "none" }} href="contact">
                    Liên hệ
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div> */}
      </div>
    </div>
  );
};

export default BaseLayout;
