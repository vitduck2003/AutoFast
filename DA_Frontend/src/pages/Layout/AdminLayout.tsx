import React from "react";
import { Outlet } from "react-router-dom";
import { Button } from "antd";
import { Link } from "react-router-dom";
import darklogo from '../../assets/images/logos/dark-logo.svg';
import rocket from '../../assets/images/backgrounds/rocket.png';
import profile1 from '../../assets/images/profile/user-1.jpg';

const AdminLayout = () => {
  return (
    <div>
      <div className="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    {/* Sidebar Start */}
    <aside className="left-sidebar">
      {/* Sidebar scroll*/}
      <div>
        <div className="brand-logo d-flex align-items-center justify-content-between">
          <a href="dashboard" className="text-nowrap logo-img">
            <img src={darklogo} width="180" alt="" />
          </a>
          <div className="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i className="ti ti-x fs-8"></i>
          </div>
        </div>
        {/* Sidebar navigation*/}
        <nav className="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li className="nav-small-cap">
              <i className="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span className="hide-menu">Home</span>
            </li>
            <li className="sidebar-item">
              <a style={{ textDecoration: 'none' }} className="sidebar-link" href="./index.html" aria-expanded="false">
                <span>
                  <i className="ti ti-layout-dashboard"></i>
                </span>
                <span className="hide-menu">Dashboard</span>
              </a>
            </li>
            <li className="nav-small-cap">
              <i className="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span className="hide-menu">Quản lý</span>
            </li>
            <li style={{ textDecoration: 'none' }} className="sidebar-item">
              <a style={{ textDecoration: 'none' }} className="sidebar-link" href="/admin/booking" aria-expanded="false">
                <span>
                  <i className="ti ti-article"></i>
                </span>
                <span style={{ textDecoration: 'none' }} className="hide-menu">Quản lý Booking</span>
              </a>
            </li>
            <li className="nav-small-cap">
              <i className="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span className="hide-menu">AUTH</span>
            </li>
            <li className="sidebar-item">
              <a className="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                <span>
                  <i className="ti ti-login"></i>
                </span>
                <span className="hide-menu">Login</span>
              </a>
            </li>
            <li className="sidebar-item">
              <a className="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span>
                  <i className="ti ti-user-plus"></i>
                </span>
                <span className="hide-menu">Register</span>
              </a>
            </li>
          </ul>
          <div className="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
            <div className="d-flex">
            </div>
          </div>
        </nav>
        {/* End Sidebar navigation */}
      </div>
      {/* End Sidebar scroll*/}
    </aside>

    <div className="body-wrapper">
     
      <header className="app-header">
        <nav className="navbar navbar-expand-lg navbar-light">
          <ul className="navbar-nav">
            <li className="nav-item d-block d-xl-none">
              <a className="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" >
                <i className="ti ti-menu-2"></i>
              </a>
            </li>
            <li className="nav-item">
              <a className="nav-link nav-icon-hover" >
                <i className="ti ti-bell-ringing"></i>
                <div className="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div className="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul className="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li className="nav-item dropdown">
                <a className="nav-link nav-icon-hover" >
                  <img src={profile1} alt="" width="35" height="35" className="rounded-circle"/>
                </a>
                
              </li>
            </ul>
          </div>
        </nav>
      </header>
    
      
        

      <Outlet />

        
        
    
    </div>
</div>


      
    </div>
  );
};

export default AdminLayout;
