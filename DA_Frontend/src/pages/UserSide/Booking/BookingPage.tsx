import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { useForm, SubmitHandler } from "react-hook-form";

const BookingPage = (props: any) => {
  const navigate = useNavigate();
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();

  const onHandleSubmit: SubmitHandler<any> = (data) => {
    // Check if there are errors before submitting
    if (Object.keys(errors).length === 0) {
      props.onAddBooking(data);
      navigate("");
    }
  };
  return (
    <div>
      <div className="container-fluid page-header mb-5 p-0">
        <div className="container-fluid page-header-inner py-5">
          <div className="container text-center">
            <h1 className="display-3 text-white mb-3 animated slideInDown">
              Booking
            </h1>
            <nav aria-label="breadcrumb">
              <ol className="breadcrumb justify-content-center text-uppercase">
                <li className="breadcrumb-item">
                  <a href="#">Home</a>
                </li>
                <li className="breadcrumb-item">
                  <a href="#">Pages</a>
                </li>
                <li
                  className="breadcrumb-item text-white active"
                  aria-current="page"
                >
                  Booking
                </li>
              </ol>
            </nav>
          </div>
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

      {/* Booking */}

      <div
        className="container-fluid bg-secondary booking my-5 wow fadeInUp"
        data-wow-delay="0.1s"
      >
        <div className="container">
          <div className="row gx-5">
            <div className="col-lg-6 py-5">
              <div className="py-5">
                <h1 className="text-white mb-4">
                  Một trong những Gara ô tô đừng được đề cử và đạt giải thưởng
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
            <div className="col-lg-6">
              <div
                className="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn"
                data-wow-delay="0.6s"
              >
                <h1 className="text-white mb-4">Đặt lịch bảo dưỡng</h1>

                <form onSubmit={handleSubmit(onHandleSubmit)}>
        <div className="row g-3">
          <div className="col-12 col-sm-6">
            <input
              type="text"
              name="name"
              className={`form-control border-0 ${errors.name ? 'is-invalid' : ''}`}
              placeholder="Họ và tên"
              style={{ height: '55px' }}
              {...register('name', { required: true })}
            />
            {errors.name && <span className="text-danger">This field is required</span>}
          </div>
          <div className="col-12 col-sm-6">
            <input
              type="text"
              name="phone"
              className={`form-control border-0 ${errors.phone ? 'is-invalid' : ''}`}
              placeholder="Số điện thoại"
              style={{ height: '55px' }}
              {...register('phone', { required: true })}
            />
            {errors.phone && <span className="text-danger">This field is required</span>}
          </div>
          <div className="col-12 col-sm-6">
            <select
              name="service"
              className={`form-select border-0 ${errors.service ? 'is-invalid' : ''}`}
              style={{ height: '55px' }}
              {...register('service', { required: true })}
            >
              <option value="">Lựa chọn dịch vụ</option>
              <option value="Bảo dưỡng xe">Bảo dưỡng xe</option>
              <option value="Chuẩn đoán và sửa chữa">Chuẩn đoán và sửa chữa</option>
              <option value="Vệ sinh và thay dầu">Vệ sinh và thay dầu</option>
            </select>
            {errors.service && <span className="text-danger">This field is required</span>}
          </div>
          <div className="col-12 col-sm-6">
            <div className="date" id="date1" data-target-input="nearest">
              <input
                type="date"
                name="date"
                className={`form-control border-0 datetimepicker-input ${errors.date ? 'is-invalid' : ''}`}
                placeholder="Thời gian đến"
               
                style={{ height: '55px' }}
                {...register('date', { required: true })}
              />
              <input
                type="text"
                name="active"
                className={`form-control border-0 datetimepicker-input ${errors.active ? 'is-invalid' : ''}`}
                defaultValue="Chờ xác nhận"
                style={{ height: '55px', display: 'none', }}
                {...register('active', { required: true })}
              />
            </div>
            {errors.date && <span className="text-danger">This field is required</span>}
          </div>
          <div className="col-12">
            <textarea
              name="desc"
              className={`form-control border-0 ${errors.desc ? 'is-invalid' : ''}`}
              placeholder="Ghi chú"
              {...register('desc')}
            ></textarea>
          </div>
          <div className="col-12">
            <button className="btn btn-secondary w-100 py-3" type="submit">Đặt lịch</button>
          </div>
        </div>
      </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div className="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div className="container">
          <div className="row g-4">
            <div className="col-lg-8 col-md-6">
              <h6 className="text-primary text-uppercase">
                // Gọi điện cho chúng tôi //
              </h6>
              <h1 className="mb-4">
                Nếu như bạn có bất kỳ thắc mắc nào về đặt lịch, vui lòng gọi cho
                chúng tôi
              </h1>
              <p className="mb-0">
                Lorem diam ea sit dolor labore. Clita et dolor erat sed est
                lorem sed et sit. Diam sed duo magna erat et stet clita ea magna
                ea sed, sit labore magna lorem tempor justo rebum dolores. Eos
                dolor sea erat amet et, lorem labore lorem at dolores. Stet ea
                ut justo et, clita et et ipsum diam.
              </p>
            </div>
            <div className="col-lg-4 col-md-6">
              <div className="bg-primary d-flex flex-column justify-content-center text-center h-100 p-4">
                <h3 className="text-white mb-4">
                  <i className="fa fa-phone-alt me-3"></i>+84 988 678 999
                </h3>
                <a href="" className="btn btn-secondary py-3 px-5">
                  Contact Us<i className="fa fa-arrow-right ms-3"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default BookingPage;
