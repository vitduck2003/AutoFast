import React from 'react';
import './main.css';
import './style.css'
type Props = {};

const Header = (props: Props) => {
  return (
    <header className="header">
      <section
        className="header-pc d-none d-lg-block"
        x-data="header_pc"
        x-ref="header_pc"
        x-bind="scroll"
      >
        <div className="middle-bar">
          <div className="container d-flex align-items-center justify-content-between">
            <div className="logo text-center mb-4">
              <a href="#" title="Trang chủ" className="img img-scaledown d-inline-block">
                <img
                  className="lazyload"
                  data-src="/upload/images/logo/logo-chinh-moi-t6.png"
                  alt="logo"
                />
              </a>
              <span className="slogan d-block">Hệ Thống Sửa Chữa & Chăm Sóc Ô Tô Cao Cấp Auto Fast</span>
            </div>
            <div className="contact-header d-flex align-items-center">
              <ul className="list-social list-unstyled d-flex align-items-center mb-0">
                <li className="mx-1">
                  <a href="https://www.facebook.com/spaoto.caocap.HaThanh" className="img img-scaledown" title="">
                    <img src="template/frontend/otoht/images/icon/facebook.png" alt="" />
                  </a>
                </li>
                <li className="mx-1">
                  <a href="https://www.youtube.com/channel/UCB9l9dhVspUECgyOeWflqog" className="img img-scaledown" title="">
                    <img src="template/frontend/otoht/images/icon/youtube.png" alt="" />
                  </a>
                </li>
                {/* Add the rest of your social media links */}
              </ul>
              <div className="contact ms-3">
                <a href="tel:0568.05.05.05" title="" className="phone d-inline-flex align-baseline">
                  <i className="fa-solid fa-phone me-2"></i> 0568.05.05.05
                </a>
                <span className="d-block">Liên hệ với chúng tôi</span>
              </div>
            </div>
          </div>
          <div x-ref="middle_bar" className="main-menu-wrap">
            <div className="container d-flex flex-wrap justify-content-between align-items-stretch">
              <nav className="main-menu" aria-label="main-menu">
            <ul className="list-unstyled d-flex justify-content-end m-0">
                                            <li>
                    <a href="/" className="d-block fw-bold"
                       title="TRANG CHỦ">TRANG CHỦ </a>
                                    </li>

                                            <li>
                    <a  className="d-block fw-bold"
                       title="GIỚI THIỆU">GIỚI THIỆU ↓</a>
                                            <ul className="sub-menu list-unstyled m-0 ">
                    <li>
            <a href="about"
               title="Về Chúng Tôi">Về Chúng Tôi</a>
                    </li>
    </ul>
                                    </li>

                                            <li>
                    <a href="service" className="d-block fw-bold"
                       title="DỊCH VỤ">DỊCH VỤ ↓</a>
                                            <ul className="sub-menu list-unstyled m-0 ">
                    <li>
            <a href="danh-muc-bao-duong-sua-chua.html"
               title="Bảo Dưỡng & Sửa Chữa Ô Tô">Bảo Dưỡng & Sửa Chữa Ô Tô</a>
                            <ul className="sub-menu list-unstyled m-0 right">
                    <li>
            <a href="bao-duong-o-to-nhu-the-nao-a138.html"
               title="Bảo Dưỡng Ô Tô Định Kỳ">Bảo Dưỡng Ô Tô Định Kỳ</a>
                    </li>
                    <li>
            <a href="noi-dung-bao-gia-sua-chua-dieu-hoa-o-to-48.html"
               title="Vệ Sinh Điều Hòa Ô Tô - Công Nghệ Nội Soi">Vệ Sinh Điều Hòa Ô Tô - Công Nghệ Nội Soi</a>
                    </li>
                    <li>
            <a href="sua-chua-he-thong-khung-gam-o-to-tot-nhat-a206.html"
               title="Sửa Chữa Khung Gầm Ô Tô">Sửa Chữa Khung Gầm Ô Tô</a>
                    </li>
                    <li>
            <a href="noi-dung-sua-chua-hop-so-tu-dong-cho-xe-o-to-cua-ban-tai-ha-thanh-4158.html"
               title="Sửa Chữa Hộp Số Tự Động">Sửa Chữa Hộp Số Tự Động</a>
                    </li>
                    <li>
            <a href="quy-trinh-sua-chua-dai-tu-dong-co-o-to-dung-chuan-a204.html"
               title="Đại Tu Động Cơ Ô Tô">Đại Tu Động Cơ Ô Tô</a>
                    </li>
                    <li>
            <a href="sua-chua-dien-o-to.html"
               title="Chẩn Đoán & Xử Lý Hệ Thống Điện Ô Tô">Chẩn Đoán & Xử Lý Hệ Thống Điện Ô Tô</a>
                    </li>
    </ul>
                    </li>
                    <li>
            <a href="danh-muc-cham-soc-lam-dep.html"
               title="Chăm Sóc & Làm Đẹp Ô Tô">Chăm Sóc & Làm Đẹp Ô Tô</a>
                            <ul className="sub-menu list-unstyled m-0 right">
                    <li>
            <a href="phu-bong-ceramic-la-gi-tai-sao-can-phu-bong-cho-xe-o-to.html"
               title="Phủ bóng Ceramic Ô Tô">Phủ bóng Ceramic Ô Tô</a>
                    </li>
                    <li>
            <a href="danh-bong-son-o-to-tat-ca-nhung-dieu-ban-can-biet-a140.html"
               title="Đánh bóng sơn xe">Đánh bóng sơn xe</a>
                    </li>
                    <li>
            <a href="quy-trinh-don-noi-that-xe-o-to-a137.html"
               title="Dọn nội thất ô tô">Dọn nội thất ô tô</a>
                    </li>
                    <li>
            <a href="bien-phap-cach-am-chong-on-o-to-chuyen-nghiep-nhat-a205.html"
               title="Dán cách âm chống ồn">Dán cách âm chống ồn</a>
                    </li>
                    <li>
            <a href="noi-dung-rua-va-bao-duong-khoang-may-50.html"
               title="Làm sạch & bảo dưỡng khoang máy">Làm sạch & bảo dưỡng khoang máy</a>
                    </li>
    </ul>
                    </li>
                    <li>
            <a href="danh-muc-son-phuc-hoi-than-vo.html"
               title="Sơn & Phục Hồi Thân Vỏ">Sơn & Phục Hồi Thân Vỏ</a>
                            <ul className="sub-menu list-unstyled m-0 right">
                    <li>
            <a href="chi-phi-thay-doi-mau-son-xe-o-to-a194.html"
               title="Sơn Đổi Màu">Sơn Đổi Màu</a>
                    </li>
                    <li>
            <a href="noi-dung-son-lazang-o-to-uy-tin-tai-ha-thanh-3128.html"
               title="Sơn Lazang - Sơn Cùm Phanh">Sơn Lazang - Sơn Cùm Phanh</a>
                    </li>
                    <li>
            <a href="bang-gia-son-xe-o-to-a170.html"
               title="Sơn Dặm, Sơn Quây">Sơn Dặm, Sơn Quây</a>
                    </li>
                    <li>
            <a href="noi-dung-son-phu-gam-chong-ri-liqui-moly-1071.html"
               title="Sơn Phủ Gầm Chống Rỉ">Sơn Phủ Gầm Chống Rỉ</a>
                    </li>
                    <li>
            <a href="dich-vu-phuc-hoi-xe-tai-nan.html"
               title="Phục Hồi Xe Tai Nạn">Phục Hồi Xe Tai Nạn</a>
                    </li>
    </ul>
                    </li>
                    <li>
            <a href="mien-phi-cuu-ho.html"
               title="Cứu Hộ Ô Tô">Cứu Hộ Ô Tô</a>
                    </li>
                    <li>
            <a href="thu-vien-hinh-anh.html"
               title="Hình Ảnh Thực Tế">Hình Ảnh Thực Tế</a>
                    </li>
    </ul>
                                    </li>

                                            <li>
                    <a href="san-pham-o-to.html" className="d-block fw-bold"
                       title="PHỤ KIỆN">PHỤ KIỆN ↓</a>
                                            <ul className="sub-menu list-unstyled m-0 ">
                    <li>
            <a href="man-hinh-o-to.html"
               title="Màn Hình ô tô">Màn Hình ô tô</a>
                    </li>
                    <li>
            <a href="cam-hanh-trinh.html"
               title="Cam hành trình">Cam hành trình</a>
                    </li>
                    <li>
            <a href="phim-cach-nhiet.html"
               title="Phim cách nhiệt">Phim cách nhiệt</a>
                    </li>
                    <li>
            <a href="cam-bien-ap-suat-lop.html"
               title="Cảm biến áp suất lốp">Cảm biến áp suất lốp</a>
                    </li>
                    <li>
            <a href="boc-vo-lang.html"
               title="Bọc vô lăng">Bọc vô lăng</a>
                    </li>
                    <li>
            <a href="tham-lot-san.html"
               title="Thảm lót sàn 6D">Thảm lót sàn 6D</a>
                    </li>
                    <li>
            <a href="bom-lop.html"
               title="Bơm lốp">Bơm lốp</a>
                    </li>
                    <li>
            <a href="thiet-bi-android-box.html"
               title="Thiết bị Android box">Thiết bị Android box</a>
                    </li>
                    <li>
            <a href="cua-hit-o-to.html"
               title="Cửa hít ô tô">Cửa hít ô tô</a>
                    </li>
                    <li>
            <a href="cop-dien-o-to-thong-minh.html"
               title="Cốp điện ô tô thông minh">Cốp điện ô tô thông minh</a>
                    </li>
                    <li>
            <a href="do-den-o-to.html"
               title="Độ đèn ô tô">Độ đèn ô tô</a>
                    </li>
    </ul>
                                    </li>
                                    <li>
                    <a href="news" className="d-block fw-bold"
                       title="KHUYẾN MẠI">Tin Tức</a>
                                    </li>

                                         

                                            <li>
                    <a className="d-block fw-bold"
                       title="LIÊN HỆ">LIÊN HỆ ↓ </a>
                                            <ul className="sub-menu list-unstyled m-0 ">
                    <li>
            <a href="contact"
               title="Liên hệ với chúng tôi">Liên hệ với chúng tôi</a>
                    </li>
                    
    </ul>
                                    </li>

                    </ul>
    </nav>
            
            </div>
          </div>
        </div>
      </section>
      <section
        id="header-mobile"
        className="header_mobile d-lg-none text-center"
        x-data="header_mobile"
        x-ref="header_mobile"
        x-bind="scroll"
      >
            <nav className="px-3 navbar d-flex justify-content-between align-items-center" x-ref="middle_bar">
            <div className="menu-button offcanvas-click d-flex flex-column">
                <span className="first"></span>
                <span className="second"></span>
                <span className="third"></span>
            </div>
            <a href="index.html" className="logo d-inline-block p-2 img img-sd">
                <img className="lazyload" data-src="/upload/images/logo/logo-chinh-moi-t6.png" alt="logo"/>
            </a>
            <button type="button" className="btn search-button"><i className="fa-solid fa-magnifying-glass"></i></button>
        </nav>
      </section>
    </header>
  );
};

export default Header;