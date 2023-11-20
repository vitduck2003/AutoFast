import React from 'react'
import service1img from '../../../assets/img/service-1.jpg';

const ServicePage = () => {
  return (
    <div>
        <div className="container-fluid page-header mb-5 p-0 22">
        <div className="container-fluid page-header-inner py-5 as">
            <div className="container text-center 3">
                <h1 className="display-3 text-white mb-3 animated slideInDown ts">Dịch vụ</h1>
                <nav aria-label="breadcrumb rs">
                    <ol className="breadcrumb justify-content-center text-uppercase ts">
                        <li className="breadcrumb-item aa"><a href="#">Home</a></li>
                        <li className="breadcrumb-item vb"><a href="#">Pages</a></li>
                        <li className="breadcrumb-item text-white active ass"  aria-current="page">Services</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    {/* Service bắt đầu */} 
<div className="container-xxl service py-5 a">
      <div className="container b">
        <div className="text-center wow fadeInUp b" data-wow-delay="0.1s">
          <h6 className="text-primary text-uppercase b">// Các dịch vụ của chúng tôi //</h6>
          <h1 className="mb-5 a">Khám phá các dịch vụ</h1>
        </div>
        <div className="row g-4 wow fadeInUp aa" data-wow-delay="0.3s">
          <div className="col-lg-4 a">
            <div className="nav w-100 nav-pills me-4 t">
              <button className="nav-link w-100 d-flex align-items-center text-start t p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                <i className="fa fa-car-side fa-2x me-3 aa"></i>
                <h4 className="m-0" id='' >Bảo Dưỡng và sửa chữa</h4>
              </button>
              <button className=" nav-link w-100 d-flex align-items-center text-start p-4 mb-4 2" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                <i className="fa fa-car fa-2x me-3 4"></i>
                <h4 className="m-0 a">Chuẩn đoán và vệ sinh</h4>
              </button>
              <button className="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 q" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                <i className="fa fa-cog fa-2x me-3 a"></i>
                <h4 className="m-0 a">Thay thế phụ tùng chính hãng </h4>
              </button>
              <button className="nav-link w-100 d-flex align-items-center text-start p-4 mb-0 d" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                <i className="fa fa-oil-can fa-2x me-3 d"></i>
                <h4 className="m-0">Thay dầu và vệ sinh</h4>
              </button>
            </div>
          </div>
          <div className="col-lg-8">
            <div className="tab-content w-100">
              <div className="tab-pane fade show active" id="tab-pane-1">
                <div className="row g-4">
                  <div className="col-md-6" style={{ minHeight: '350px' }}>
                    <div className="position-relative h-100">
                      <img className="position-absolute img-fluid w-100 h-100" src={service1img} style={{ objectFit: 'cover' }} alt="" />
                    </div>
                  </div>
                  <div className="col-md-6 avs">
                    <h3 className="mb-3 a as">15 năm kinh nghiệm trong dịch vụ bảo dưỡng</h3>
                    <p className="mb-4 vv">Với các kỹ sư chuyên nghiệp từng làm việc tại các hãng lớn như Lamborghin, Ferrari, MCLaren, Porsche, Bugatti và các thiết bị công nghệ cao và hiện đại bậc nhất Việc Nam, chúng tôi tự tin nói rằng mấy thàng khác không có tuổi với chúng tôi  </p>
                    <p><i className="fa fa-check text-success me-3 bb"></i>Dịch vụ cao cấp</p>
                    <p><i className="fa fa-check text-success me-3 asa"></i>Kỹ sư chuyên nghiệp</p>
                    <p><i className="fa fa-check text-success me-3 va"></i>Trang thiết bị hiện đại</p>
                    <a href="" className="btn btn-primary py-3 px-5 mt-3 va">Read More<i className="fa fa-arrow-right ms-3"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

{/* Booking mi */}

<div className="container-fluid bg-secondary booking my-5 wow fadeInUp a" data-wow-delay="0.1s">
      <div className="container " id=''>
        <div className="row gx-5 a">
          <div className="col-lg-6 py-5 bb">
            <div className="py-5 a">
              <h1 className="text-white mb-4 y">Một trong những Gara ô tô đừng được đề cử và đạt giải thưởng Nobel Hòa Bình </h1>
              <p className="text-white mb-0 h">Sóng bắt đầu từ gió, gió bắt đầu từ đâu, em cũng không biết nữa, khi nào ta yêu nhau!</p>
              <br />
              <p className="text-white mb-0 h">Nhà thơ Xuân Quỳnh</p>
            </div>
          </div>
          <div className="col-lg-6 a">
            <div className="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn a" data-wow-delay="0.6s">
              <h1 className="text-white mb-4 a">Đặt lịch bảo dưỡng</h1>
              <form>
                <div className="row g-3 d">
                  <div className="col-12 col-sm-6 f">
                    <input type="text" className="form-control border-0 g" placeholder="Họ và tên" style={{ height: '55px' }} />
                  </div>
                  <div className="col-12 col-sm-6 g">
                    <input type="text" className="form-control border-0 g" placeholder="Số điện thoại" style={{ height: '55px' }} />
                  </div>
                  <div className="col-12 col-sm-6 g">
                    <select className="form-select border-0 g" style={{ height: '55px' }}>
                      <option selected>Lựa chọn dịch vụ</option>
                      <option value="1">Bảo dưỡng xe</option>
                      <option value="2">Chuẩn đoán và sửa chữa</option>
                      <option value="3">Vệ sinh và thay dầu</option>
                    </select>
                  </div>
                  <div className="col-12 col-sm-6">
                    <div className="date" id="date1 g" data-target-input="nearest">
                      <input type="text" className="form-control border-0 datetimepicker-input g" placeholder="Thời gian đến" data-target="#date1" data-toggle="datetimepicker" style={{ height: '55px' }} />
                    </div>
                  </div>
                  <div className="col-12 g">
                    <textarea className="form-control border-0 g" placeholder="Ghi chú "></textarea>
                  </div>
                  <div className="col-12 g">
                    <button className="btn btn-secondary w-100 py-3 g" type="submit">Đặt lịch</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    </div>
  )
}

export default ServicePage