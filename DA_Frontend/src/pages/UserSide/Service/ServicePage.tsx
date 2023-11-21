import React from 'react'
import service1img from '../../../assets/img/service-1.jpg';

const ServicePage = () => {
  const slideStyle = {
    borderBottom: '1px solid #ececec',
    paddingBottom: "20px"
  };
  const slideStyle2 = {
    margin: "60px 0"
  }
  return (
    <main className="product-category" style={slideStyle}>
      <nav aria-label="breadcrumb" className="main-breadcrumb mb-5">
        <div className="container text-center">
          <ol className="breadcrumb mb-0">
            <li className="breadcrumb-item">
              <a href="https://otohathanh.com/" title="Trang chủ">Trang chủ</a>
            </li>
            <li className="breadcrumb-item ">
              <a href="https://otohathanh.com/dich-vu.aspx" title="Dịch Vụ">Dịch Vụ</a>
            </li>
            <li className="breadcrumb-item active" aria-current="page">
              <a href="https://otohathanh.com/danh-muc-bao-duong-sua-chua.aspx" title="Bảo Dưỡng &amp; Sửa Chữa Ô Tô">Bảo Dưỡng &amp; Sửa Chữa Ô Tô</a>
            </li>
          </ol>
        </div>
      </nav>

      <div className="container">
        <h1 className="heading-primary text-center" style={slideStyle2}><span>Bảo Dưỡng &amp; Sửa Chữa Ô Tô</span> </h1>
        <div className="row row-cols-lg-3 row-cols-sm-2 row-cols-1">
          <div className="col mb-5">
            <div className="service-catalogue-item mx-lg-4 mb-4 sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="0">
              <a href="bao-duong-dieu-hoa-o-to-cong-nghe-noi-soi.aspx" title="Vệ Sinh Điều Hòa Ô Tô - Công Nghệ Nội Soi" className="img img-cover img-effect zoom-in-1 auto-scale">
                <img className=" lazyloaded" src="https://otohathanh.com/upload/images/noi-soi-dieu-hoa-o-to.jpg" alt="Vệ Sinh Điều Hòa Ô Tô - Công Nghệ Nội Soi" />
              </a>
              <h4 className="title fw-600"><a href="bao-duong-dieu-hoa-o-to-cong-nghe-noi-soi.aspx" title="Vệ Sinh Điều Hòa Ô Tô - Công Nghệ Nội Soi">Vệ Sinh Điều Hòa Ô Tô - Công Nghệ Nội Soi</a></h4>
            </div>
          </div>
          <div className="col mb-5">
            <div className="service-catalogue-item mx-lg-4 mb-4 sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="300">
              <a href="dai-tu-dong-co-o-to.aspx" title="Đại Tu Động Cơ Ô Tô" className="img img-cover img-effect zoom-in-1 auto-scale">
                <img className=" lazyloaded" src="https://otohathanh.com/upload/images/bao-duong-khoang-may-o-to.jpg" alt="Đại Tu Động Cơ Ô Tô" />
              </a>
              <h4 className="title fw-600"><a href="dai-tu-dong-co-o-to.aspx" title="Đại Tu Động Cơ Ô Tô">Đại Tu Động Cơ Ô Tô</a></h4>
            </div>
          </div>
          <div className="col mb-5">
            <div className="service-catalogue-item mx-lg-4 mb-4 sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="600">
              <a href="chan-doan-xu-ly-he-thong-dien-o-to.aspx" title="Chẩn Đoán &amp; Xử Lý Hệ Thống Điện Ô Tô" className="img img-cover img-effect zoom-in-1 auto-scale">
                <img className=" lazyloaded" src="https://otohathanh.com/upload/images/sua-dien-o-to.jpg" alt="Chẩn Đoán &amp; Xử Lý Hệ Thống Điện Ô Tô" />
              </a>
              <h4 className="title fw-600"><a href="chan-doan-xu-ly-he-thong-dien-o-to.aspx" title="Chẩn Đoán &amp; Xử Lý Hệ Thống Điện Ô Tô">Chẩn Đoán &amp; Xử Lý Hệ Thống Điện Ô Tô</a></h4>
            </div>
          </div>
          <div className="col mb-5">
            <div className="service-catalogue-item mx-lg-4 mb-4 sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="0">
              <a href="sua-chua-khung-gam.aspx" title="Sửa Chữa Khung Gầm Ô Tô" className="img img-cover img-effect zoom-in-1 auto-scale">
                <img className=" lazyloaded" src="https://otohathanh.com/upload/images/chay-dau-gam-may-o-to(1).jpg" alt="Sửa Chữa Khung Gầm Ô Tô" />
              </a>
              <h4 className="title fw-600"><a href="sua-chua-khung-gam.aspx" title="Sửa Chữa Khung Gầm Ô Tô">Sửa Chữa Khung Gầm Ô Tô</a></h4>
            </div>
          </div>
          <div className="col mb-5">
            <div className="service-catalogue-item mx-lg-4 mb-4 sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="300">
              <a href="sua-chua-hop-so-tu-dong.aspx" title="Sửa Chữa Hộp Số Tự Động" className="img img-cover img-effect zoom-in-1 auto-scale">
                <img className=" lazyloaded" src="https://otohathanh.com/upload/images/dich-vu-bao-duong-o-to-ha-noi.jpg" alt="Sửa Chữa Hộp Số Tự Động" />
              </a>
              <h4 className="title fw-600"><a href="sua-chua-hop-so-tu-dong.aspx" title="Sửa Chữa Hộp Số Tự Động">Sửa Chữa Hộp Số Tự Động</a></h4>
            </div>
          </div>
          <div className="col mb-5">
            <div className="service-catalogue-item mx-lg-4 mb-4 sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="600">
              <a href="bao-duong-o-to-cac-cap.aspx" title="Bảo Dưỡng Ô Tô Định Kỳ" className="img img-cover img-effect zoom-in-1 auto-scale">
                <img className=" lazyloaded" src="https://otohathanh.com/upload/images/bao-duong-co-ban.jpg" alt="Bảo Dưỡng Ô Tô Định Kỳ" />
              </a>
              <h4 className="title fw-600"><a href="bao-duong-o-to-cac-cap.aspx" title="Bảo Dưỡng Ô Tô Định Kỳ">Bảo Dưỡng Ô Tô Định Kỳ</a></h4>
            </div>
          </div>
        </div>
      </div>
    </main>
  )
}

export default ServicePage