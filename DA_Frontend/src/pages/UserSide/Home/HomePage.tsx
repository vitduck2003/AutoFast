import React, { useState } from "react";
import aboutimg from "../../../assets/img/about.jpg";
import carousel1img from "../../../assets/img/carousel-1.png";
import carousel2img from "../../../assets/img/carousel-2.png";
import carouselbg1img from "../../../assets/img/carousel-bg-1.jpg";
import carouselbg2img from "../../../assets/img/carousel-bg-2.jpg";
import service1img from "../../../assets/img/service-1.jpg";


import khabanhimg from "../../../assets/img/ngobakha.jpg";
import khanhskyimg from "../../../assets/img/khanhsky.jpg";
import huanhoahongimg from "../../../assets/img/huanhoahong.jpg";
import traizanimeimg from "../../../assets/img/boizanime.jpg";
import { useNavigate } from "react-router-dom";
import { useForm} from "react-hook-form";

import { Link } from "react-router-dom";
const HomePage = ({about, technicians, abouts, aboutz, serviceHome}) => {
  const navigate = useNavigate();
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();

  // const onHandleSubmit: SubmitHandler<any> = (data) => {
  //   // Check if there are errors before submitting
  //   if (Object.keys(errors).length === 0) {
  //     props.onAddBooking(data);
  //     alert("Đặt lịch thành công")
  //     navigate("/");
  //   }
  // };
  const slideStyle = {
    transitionDuration: '0ms',
    transform: "translate3d(-657.333px, 0px, 0px)"
};
const slideStyle2 ={
    width: "278.667px",
    marginRight: "50px"
}
  return (
    <div>
      {/* Carousel Start */}
      <div className="container-fluid p-0 mb-5" style={{ zIndex: 0 }}>
        <div
          id="header-carousel"
          className="carousel slide"
          data-ride="carousel"
        >
          <div className="carousel-inner">
            <div className="carousel-item active">
              <img className="w-100" src={carouselbg1img} alt="Image" />
              <div className="carousel-caption d-flex align-items-center"style={{ zIndex: 0 }}>
                <div className="container">
                  <div className="row align-items-center justify-content-center justify-content-lg-start">
                    <div className="col-10 col-lg-7 text-center text-lg-start">
                      <h6 className="text-white text-uppercase mb-3 animated slideInDown">
                        // Dịch vụ //
                      </h6>
                      <h1 className="display-3 text-white mb-4 pb-3 animated slideInDown">
                        Bảo dưỡng và sửa chữa xe
                      </h1>

                      <a
                        href="service"
                        className="btn btn-primary py-3 px-5 animated slideInDown"
                      >
                        Xem thêm<i className="fa fa-arrow-right ms-3"></i>
                      </a>
                    </div>
                    <div className="col-lg-5 d-none d-lg-flex animated zoomIn">
                      <img className="img-fluid" src={carousel1img} alt="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="carousel-item">
              <img className="w-100" src={carouselbg2img} alt="Image" />
              <div className="carousel-caption d-flex align-items-center" style={{ zIndex: 0 }}>
                <div className="container">
                  <div className="row align-items-center justify-content-center justify-content-lg-start">
                    <div className="col-10 col-lg-7 text-center text-lg-start">
                      <h6 className="text-white text-uppercase mb-3 animated slideInDown">
                        // Dịch vụ //
                      </h6>
                      <h1 className="display-3 text-white mb-4 pb-3 animated slideInDown">
                        Thay dầu, vệ sinh và thay thế phụ tùng
                      </h1>
                      <a
                        href="service"
                        className="btn btn-primary py-3 px-5 animated slideInDown"
                      >
                        Xem thêm<i className="fa fa-arrow-right ms-3"></i>
                      </a>
                    </div>
                    <div className="col-lg-5 d-none d-lg-flex animated zoomIn">
                      <img className="img-fluid" src={carousel2img} alt="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button
            className="carousel-control-prev"
            type="button"
            data-bs-target="#header-carousel"
            data-bs-slide="prev"
          >
            <span
              className="carousel-control-prev-icon"
              aria-hidden="true"
            ></span>
            <span className="visually-hidden">Previous</span>
          </button>
          <button
            className="carousel-control-next"
            type="button"
            data-bs-target="#header-carousel"
            data-bs-slide="next"
          >
            <span
              className="carousel-control-next-icon"
              aria-hidden="true"
            ></span>
            <span className="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      {/* Service  */}
      <div className="container-xxl py-5">
        <div className="container">
          <div className="row g-4">
            {about.map((item:any)=>{
              return <div key={item.id} className="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div className="d-flex py-5 px-4">
                <i className="fa fa-certificate fa-3x text-primary flex-shrink-0"></i>
                <div className="ps-4">
                  <h5 className="mb-3">{item.name}</h5>
                  <p>
                    {item.content}
                  </p>
                  <a
                    style={{ textDecoration: "none" }}
                    className="text-secondary border-bottom"
                    href="/about/chitiet"
                  >
                    Xem thêm
                  </a>
                </div>
              </div>
            </div>
            })}
          </div>
        </div>
      </div>
      {/* About */}
      <div className="container-xxl py-5">
        <div className="container">
          <div className="row g-5">
            <div className="col-lg-6 pt-4" style={{ minHeight: "400px" }}>
              {aboutz.map((item:any ) =>{
                return <div
                key={item.id}
                className="position-relative h-100 wow fadeIn"
                data-wow-delay="0.1s"
              >
                <img
                  className="position-absolute img-fluid w-100 h-100"
                  src={item.img}
                  alt=""
                />
                <div className="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5">
                  <h1 className="display-4 text-white mb-0">
                    15 <span className="fs-4">Năm</span>
                  </h1>
                  <h4 className="text-white">Kinh nghiệm</h4>
                </div>
              </div>
              })}
            </div>
            <div className="col-lg-6">
              <div>
                {aboutz.map((item: any) =>{
                  return <div>
                <h6 className="text-primary text-uppercase">
                // Về chúng tôi //
              </h6>
              <h1 className="mb-4">
                <span className="text-primary">{item.name}</span> 
              </h1>
              <p className="mb-4">
              {item.content}
              </p>
                </div>
                 })}
              </div>
             
              <div className="row g-4 mb-3 pb-3">
                <div className="col-12 wow fadeIn" data-wow-delay="0.1s">
                  <div className="d-flex">
                    <div
                      className="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                      style={{ width: "45px", height: "45px" }}
                    >
                      <span className="fw-bold text-secondary">01</span>
                    </div>
                    <div className="ps-3">
                      <h6>Chuyên nghiệp</h6>
                      <span>Trang thiết bị hiện đại </span>
                    </div>
                  </div>
                </div>
                <div className="col-12 wow fadeIn" data-wow-delay="0.3s">
                  <div className="d-flex">
                    <div
                      className="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                      style={{ width: "45px", height: "45px" }}
                    >
                      <span className="fw-bold text-secondary">02</span>
                    </div>
                    <div className="ps-3">
                      <h6>Chất lượng cao cấp</h6>
                      <span>Phụ tùng và sản phẩm cao cấp chính hãng</span>
                    </div>
                  </div>
                </div>
                <div className="col-12 wow fadeIn" data-wow-delay="0.5s">
                  <div className="d-flex">
                    <div
                      className="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1"
                      style={{ width: "45px", height: "45px" }}
                    >
                      <span className="fw-bold text-secondary">03</span>
                    </div>
                    <div className="ps-3">
                      <h6>Các kỹ sư từng đạt sao michelin</h6>
                      <span>Các kỹ sư người Việt với chuyên môn cực cao</span>
                    </div>
                  </div>
                </div>
              </div>
              <a href="/about/chitiet" className="btn btn-primary py-3 px-5">
                Xem thêm<i className="fa fa-arrow-right ms-3"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      {/* Fact start */}
      <div className="container-fluid fact bg-dark my-5 py-5">
        <div className="container">
          <div className="row g-4">
            {abouts.map((item: any)=>{
              return <div
              key={item.id}
              className="col-md-6 col-lg-3 text-center wow fadeIn"
              data-wow-delay="0.1s"
            >
              <i className="fa fa-check fa-2x text-white mb-3"></i>
              <h2 className="text-white mb-2" data-toggle="counter-up">
                {item.soluong}
              </h2>
              <p className="text-white mb-0">{item.name}</p>
            </div>
            })}
          </div>
        </div>
      </div>
      {/* Service Start */}
      <div className="container">
    <h3 className="heading-main text-center text-uppercase bm-lv-1">
        <span>Dịch vụ</span>
        <span>nổi bật</span>
    </h3>
    <div className="swiper slide-service swiper-initialized swiper-horizontal swiper-pointer-events">
      <div  className="swiper-wrapper" style={slideStyle}>
      {serviceHome.map((item:any)=>(
         <><div className="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="0" style={slideStyle2}>
          <div className="service-item">
            <a href="https://otohathanh.com/danh-muc-bao-duong-sua-chua.aspx" title="Bảo Dưỡng &amp; Sửa Chữa Ô Tô" className="img-wrap">
              <span className="img img-cover auto-scale img-effect zoom-in-1">
                <img className=" ls-is-cached lazyloaded" src="https://otohathanh.com/upload/images/dich-vu-bao-duong-o-to-uy-tin.jpg" alt="Bảo Dưỡng &amp; Sửa Chữa Ô Tô" loading="lazy" /></span>
              <img className="icon-dv d-none d-lg-block ls-is-cached lazyloaded" src="template/frontend/otoht/images/layout/index/icon-dv-1.png" alt="Bảo Dưỡng &amp; Sửa Chữa Ô Tô" loading="lazy" /></a>
            <h4 className="title text-center text-uppercase fw-700">
              <a href="https://otohathanh.com/danh-muc-bao-duong-sua-chua.aspx" title="Bảo Dưỡng &amp; Sửa Chữa Ô Tô">Bảo Dưỡng &amp; Sửa Chữa Ô Tô</a>
            </h4>
          </div>
        </div><div className="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1" style={slideStyle2}>
            <div className="service-item">
              <a href="https://otohathanh.com/danh-muc-cham-soc-lam-dep.aspx" title="Chăm Sóc &amp; Làm Đẹp Ô Tô" className="img-wrap">
                <span className="img img-cover auto-scale img-effect zoom-in-1">
                  <img className=" ls-is-cached lazyloaded" src="https://otohathanh.com/upload/images/dich-vu-don-noi-that-o-to-chuyen-nghiep.jpg" alt="Chăm Sóc &amp; Làm Đẹp Ô Tô" loading="lazy" /></span>
                <img className="icon-dv d-none d-lg-block ls-is-cached lazyloaded" src="template/frontend/otoht/images/layout/index/icon-dv-2.png" alt="Chăm Sóc &amp; Làm Đẹp Ô Tô" loading="lazy" /></a>
              <h4 className="title text-center text-uppercase fw-700">
                <a href="https://otohathanh.com/danh-muc-cham-soc-lam-dep.aspx" title="Chăm Sóc &amp; Làm Đẹp Ô Tô">Chăm Sóc &amp; Làm Đẹp Ô Tô</a>
              </h4>
            </div>
          </div><div className="swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="2" style={slideStyle2}>
            <div className="service-item">
              <a href="https://otohathanh.com/danh-muc-son-phuc-hoi-than-vo.aspx" title="Sơn Phục Hồi &amp; Nâng Cấp Thân Vỏ" className="img-wrap">
                <span className="img img-cover auto-scale img-effect zoom-in-1">
                  <img className=" ls-is-cached lazyloaded" src={item.img} alt="Sơn Phục Hồi &amp; Nâng Cấp Thân Vỏ" loading="lazy" /></span>
                <img className="icon-dv d-none d-lg-block ls-is-cached lazyloaded" src="template/frontend/otoht/images/layout/index/icon-dv-3.png" alt="Sơn Phục Hồi &amp; Nâng Cấp Thân Vỏ" loading="lazy" /></a>
              <h4 className="title text-center text-uppercase fw-700">
                <a href="https://otohathanh.com/danh-muc-son-phuc-hoi-than-vo.aspx" title="Sơn Phục Hồi &amp; Nâng Cấp Thân Vỏ">{item.name}</a>
              </h4>
            </div>
          </div></>
      ))}
         
                </div>

        <div className="swiper-button-next"></div>
        <div className="swiper-button-prev"></div>
        
    </div>
</div>

      {/* Booking */}

      <div
        className="container-fluid bg-secondary booking my-5 wow fadeInUp"
        data-wow-delay="0.1s"
      >
        <div className="container">
          <div className=" gx-5">
            <div className=" py-5">
              <div className="py-5">
                <h1 className="text-white mb-4">
                  Một trong những Gara ô tô từng được đề cử và đạt giải thưởng
                  Nobel Hòa Bình{" "}
                </h1>
                
                <p className="text-white mb-0">
                  Sóng bắt đầu từ gió, gió bắt đầu từ đâu, em cũng không biết
                  nữa, khi nào ta yêu nhau!
                </p>
                <br />
                <p className="text-white mb-0">Nhà thơ Xuân Quỳnh</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Team Start */}
      <div className="container-xxl py-5">
        <div className="container">
          <div className="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 className="text-primary text-uppercase">
              // Các kỹ sư của chúng tôi //
            </h6>
            <h1 className="mb-5">Các kỹ sư chuyên nghiệp</h1>
          </div>
          <div className="row g-4">
            {technicians.map((item:any) =>{
              return  <div
              key={item.id}
              className="col-lg-3 col-md-6 wow fadeInUp"
              data-wow-delay="0.1s"
            >
              <div className="team-item">
                <div className="position-relative overflow-hidden">
                  <img
                    style={{ width: "500px" }}
                    className="img-fluid"
                    src={item.image}
                    alt=""
                  />
                  <div className="team-overlay position-absolute start-0 top-0 w-100 h-100">
                    <a className="btn btn-square mx-1" href="">
                      <i className="fab fa-facebook-f"></i>
                    </a>
                    <a className="btn btn-square mx-1" href="">
                      <i className="fab fa-twitter"></i>
                    </a>
                    <a className="btn btn-square mx-1" href="">
                      <i className="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
                <div className="bg-light text-center p-4">
                  <h5 className="fw-bold mb-0">{item.name}</h5>
                  <small>{item.information}</small>
                </div>
              </div>
            </div>
            
          })}
          </div>
        </div>
      </div>
    </div>
  );
};

export default HomePage;
