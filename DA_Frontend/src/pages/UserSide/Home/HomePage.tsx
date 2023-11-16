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
const HomePage = (props: any) => {
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
            <div
              className="col-lg-4 col-md-6 wow fadeInUp"
              data-wow-delay="0.1s"
            >
              <div className="d-flex py-5 px-4">
                <i className="fa fa-certificate fa-3x text-primary flex-shrink-0"></i>
                <div className="ps-4">
                  <h5 className="mb-3">Dịch vụ chất lượng</h5>
                  <p>
                    Chúng tôi hân hạnh là một trong những Gara đầu tiên đạt 1
                    sao Michelin tại Việt Nam
                  </p>
                  <a
                    style={{ textDecoration: "none" }}
                    className="text-secondary border-bottom"
                    href=""
                  >
                    Xem thêm
                  </a>
                </div>
              </div>
            </div>
            <div
              className="col-lg-4 col-md-6 wow fadeInUp"
              data-wow-delay="0.3s"
            >
              <div className="d-flex bg-light py-5 px-4">
                <i className="fa fa-users-cog fa-3x text-primary flex-shrink-0"></i>
                <div className="ps-4">
                  <h5 className="mb-3">Kỹ thuật chuyên nghiệp</h5>
                  <p>
                    Đội ngũ kỹ thuật viên người Việt nhưng kỹ năng hơn người
                    Châu Phi
                  </p>
                  <a
                    style={{ textDecoration: "none" }}
                    className="text-secondary border-bottom"
                    href=""
                  >
                    Xem thêm
                  </a>
                </div>
              </div>
            </div>
            <div
              className="col-lg-4 col-md-6 wow fadeInUp"
              data-wow-delay="0.5s"
            >
              <div className="d-flex py-5 px-4">
                <i className="fa fa-tools fa-3x text-primary flex-shrink-0"></i>
                <div className="ps-4">
                  <h5 className="mb-3">Thiết bị hiện đại</h5>
                  <p>
                    Thiết bị hiện đại bậc nhất của chúng tôi được nhập khẩu từ
                    Châu Nam Mỹ, bạn có thể hoàn toàn yên tâm
                  </p>
                  <a
                    style={{ textDecoration: "none" }}
                    className="text-secondary border-bottom"
                    href=""
                  >
                    Xem thêm
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {/* About */}
      <div className="container-xxl py-5">
        <div className="container">
          <div className="row g-5">
            <div className="col-lg-6 pt-4" style={{ minHeight: "400px" }}>
              <div
                className="position-relative h-100 wow fadeIn"
                data-wow-delay="0.1s"
              >
                <img
                  className="position-absolute img-fluid w-100 h-100"
                  src={aboutimg}
                  alt=""
                />
                <div className="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5">
                  <h1 className="display-4 text-white mb-0">
                    15 <span className="fs-4">Năm</span>
                  </h1>
                  <h4 className="text-white">Kinh nghiệm</h4>
                </div>
              </div>
            </div>
            <div className="col-lg-6">
              <h6 className="text-primary text-uppercase">
                // Về chúng tôi //
              </h6>
              <h1 className="mb-4">
                <span className="text-primary">Auto Fast</span> Dịch vụ bảo
                dưỡng xe cao cấp
              </h1>
              <p className="mb-4">
                Với 15 năm kinh nghiệm trong lĩnh vực bảo dưỡng và sửa chữa xe ô
                tô, chúng tôi tự tin nói rằng chúng tôi chính là bố của các Gara
                ô tô, gọi bố đi các con
              </p>
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
              <a href="about" className="btn btn-primary py-3 px-5">
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
            <div
              className="col-md-6 col-lg-3 text-center wow fadeIn"
              data-wow-delay="0.1s"
            >
              <i className="fa fa-check fa-2x text-white mb-3"></i>
              <h2 className="text-white mb-2" data-toggle="counter-up">
                15
              </h2>
              <p className="text-white mb-0">Năm kinh nghiệm</p>
            </div>
            <div
              className="col-md-6 col-lg-3 text-center wow fadeIn"
              data-wow-delay="0.3s"
            >
              <i className="fa fa-users-cog fa-2x text-white mb-3"></i>
              <h2 className="text-white mb-2" data-toggle="counter-up">
                10
              </h2>
              <p className="text-white mb-0">Kỹ sư đẳng cấp</p>
            </div>
            <div
              className="col-md-6 col-lg-3 text-center wow fadeIn"
              data-wow-delay="0.5s"
            >
              <i className="fa fa-users fa-2x text-white mb-3"></i>
              <h2 className="text-white mb-2" data-toggle="counter-up">
                83454
              </h2>
              <p className="text-white mb-0">Khách hài lòng</p>
            </div>
            <div
              className="col-md-6 col-lg-3 text-center wow fadeIn"
              data-wow-delay="0.7s"
            >
              <i className="fa fa-car fa-2x text-white mb-3"></i>
              <h2 className="text-white mb-2" data-toggle="counter-up">
                123454
              </h2>
              <p className="text-white mb-0">Dự án hoàn thiện</p>
            </div>
          </div>
        </div>
      </div>
      {/* Service Start */}
      <div className="container-xxl service py-5">
        <div className="container">
          <div className="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 className="text-primary text-uppercase">
              // Các dịch vụ của chúng tôi //
            </h6>
            <h1 className="mb-5">Khám phá các dịch vụ</h1>
          </div>
          <div className="row g-4 wow fadeInUp" data-wow-delay="0.3s">
            <div className="col-lg-4">
              <div className="nav w-100 nav-pills me-4">
                <button className="nav-link w-100 d-flex align-items-center text-start p-4 mb-4">
                  <i className="fa fa-car-side fa-2x me-3"></i>
                  <h4 className="m-0">Bảo Dưỡng và sửa chữa</h4>
                </button>
                <button className="nav-link w-100 d-flex align-items-center text-start p-4 mb-4">
                  <i className="fa fa-car fa-2x me-3"></i>
                  <h4 className="m-0">Chuẩn đoán và vệ sinh</h4>
                </button>
                <button className="nav-link w-100 d-flex align-items-center text-start p-4 mb-4">
                  <i className="fa fa-cog fa-2x me-3"></i>
                  <h4 className="m-0">Thay thế phụ tùng chính hãng </h4>
                </button>
                <button className="nav-link w-100 d-flex align-items-center text-start p-4 mb-0">
                  <i className="fa fa-oil-can fa-2x me-3"></i>
                  <h4 className="m-0">Thay dầu và vệ sinh</h4>
                </button>
              </div>
            </div>
            <div className="col-lg-8">
              <div className="tab-content w-100">
                <div className="tab-pane fade show active" id="tab-pane-1">
                  <div className="row g-4">
                    <div className="col-md-6" style={{ minHeight: "350px" }}>
                      <div className="position-relative h-100">
                        <img
                          className="position-absolute img-fluid w-100 h-100"
                          src={service1img}
                          style={{ objectFit: "cover" }}
                          alt=""
                        />
                      </div>
                    </div>
                    <div className="col-md-6">
                      <h3 className="mb-3">
                        15 năm kinh nghiệm trong dịch vụ bảo dưỡng
                      </h3>
                      <p className="mb-4">
                        Với các kỹ sư chuyên nghiệp từng làm việc tại các hãng
                        lớn như Lamborghin, Ferrari, MCLaren, Porsche, Bugatti
                        và các thiết bị công nghệ cao và hiện đại bậc nhất Việc
                        Nam, chúng tôi tự tin nói rằng mấy thàng khác không có
                        tuổi với chúng tôi{" "}
                      </p>
                      <p>
                        <i className="fa fa-check text-success me-3"></i>Dịch vụ
                        cao cấp
                      </p>
                      <p>
                        <i className="fa fa-check text-success me-3"></i>Kỹ sư
                        chuyên nghiệp
                      </p>
                      <p>
                        <i className="fa fa-check text-success me-3"></i>Trang
                        thiết bị hiện đại
                      </p>
                      <a
                        href="booking"
                        className="btn btn-primary py-3 px-5 mt-3"
                      >
                        Đặt lịch<i className="fa fa-arrow-right ms-3"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
            <div
              className="col-lg-3 col-md-6 wow fadeInUp"
              data-wow-delay="0.1s"
            >
              <div className="team-item">
                <div className="position-relative overflow-hidden">
                  <img
                    style={{ width: "500px" }}
                    className="img-fluid"
                    src={khabanhimg}
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
                  <h5 className="fw-bold mb-0">Ngô Bá Khá </h5>
                  <small>Với kinh nghiệm từng đi tù 10 năm</small>
                </div>
              </div>
            </div>
            <div
              className="col-lg-3 col-md-6 wow fadeInUp"
              data-wow-delay="0.3s"
            >
              <div className="team-item">
                <div className="position-relative overflow-hidden">
                  <img
                    style={{ width: "500px" }}
                    className="img-fluid"
                    src={huanhoahongimg}
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
                  <h5 className="fw-bold mb-0">Huấn Hoa Hồng</h5>
                  <small>Với kinh nghiệm cụt một ngón tay khi chơi 3 cây</small>
                </div>
              </div>
            </div>
            <div
              className="col-lg-3 col-md-6 wow fadeInUp"
              data-wow-delay="0.5s"
            >
              <div className="team-item">
                <div className="position-relative overflow-hidden">
                  <img
                    style={{ width: "500px" }}
                    className="img-fluid"
                    src={khanhskyimg}
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
                  <h5 className="fw-bold mb-0">Khánh sờ Kai</h5>
                  <small>
                    Kinh nghiệm 15 năm thích nói mồm, nói phét trên mạng
                  </small>
                </div>
              </div>
            </div>
            <div
              className="col-lg-3 col-md-6 wow fadeInUp"
              data-wow-delay="0.7s"
            >
              <div className="team-item">
                <div className="position-relative overflow-hidden">
                  <img
                    style={{ width: "500px" }}
                    className="img-fluid"
                    src={traizanimeimg}
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
                  <h5 className="fw-bold mb-0">Nguyễn Đức Trọng</h5>
                  <small>
                    Hơn 20 năm kinh nghiệm đóng vai trai alime tại Osaka Nhật
                    bản
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default HomePage;
