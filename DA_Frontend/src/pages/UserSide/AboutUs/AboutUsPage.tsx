import React from 'react'
import aboutimg from '../../../assets/img/about.jpg'; 
import khabanhimg from '../../../assets/img/ngobakha.jpg';
import khanhskyimg from '../../../assets/img/khanhsky.jpg';
import huanhoahongimg from '../../../assets/img/huanhoahong.jpg';
import traizanimeimg from '../../../assets/img/boizanime.jpg';

const AboutUsPage = () => {
  return (
    <div>
         <div className="container-fluid page-header mb-5 p-0" id=''>
        <div className="container-fluid page-header-inner py-5" id=''>
            <div className="container text-center" id=''>
                <h1 className="display-3 text-white mb-3 animated slideInDown" id=''>About Us</h1>
                <nav aria-label="breadcrumb" id=''>
                    <ol className="breadcrumb justify-content-center text-uppercase" id=''>
                        <li className="breadcrumb-item" id=''><a href="#">Home</a></li>
                        <li className="breadcrumb-item" id=''><a href="#">Pages</a></li>
                        <li className="breadcrumb-item text-white active" aria-current="page" id=''>About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        {/* Service  */}
    <div className="container-xxl py-5" id=''>
      <div className="container" id=''>
        <div className="row g-4" id=''>
          <div className="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" id=''>
            <div className="d-flex py-5 px-4" id=''>
              <i className="fa fa-certificate fa-3x text-primary flex-shrink-0" id=''></i>
              <div className="ps-4" id=''>
                <h5 className="mb-3" id=''>Dịch vụ chất lượng</h5>
                <p>Chúng tôi hân hạnh là một trong những Gara đầu tiên đạt 1 sao Michelin tại Việt Nam</p>
              </div>
            </div>
          </div>
          <div className="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s" id=''>
            <div className="d-flex bg-light py-5 px-4" id=''>
              <i className="fa fa-users-cog fa-3x text-primary flex-shrink-0" id=''></i>
              <div className="ps-4" id=''>
                <h5 className="mb-3" id=''>Kỹ thuật chuyên nghiệp</h5>
                <p>Đội ngũ kỹ thuật viên người Việt nhưng kỹ năng hơn người Châu Phi</p>
              </div>
            </div>
          </div>
          <div className="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s" id=''>
            <div className="d-flex py-5 px-4" id=''>
              <i className="fa fa-tools fa-3x text-primary flex-shrink-0" id=''> </i>
              <div className="ps-4" id=''>
                <h5 className="mb-3" id=''>Thiết bị hiện đại</h5>
                <p>Thiết bị hiện đại bậc nhất của chúng tôi được nhập khẩu từ Châu Nam Mỹ, bạn có thể hoàn toàn yên tâm</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {/* About */}
    <div className="container-xxl py-5" id=''>
      <div className="container " id=''>
        <div className="row g-5" id=''>
          <div className="col-lg-6 pt-4" style={{ minHeight: '400px' }} id=''>
            <div className="position-relative h-100 wow fadeIn" data-wow-delay="0.1s" id=''>
              <img className="position-absolute img-fluid w-100 h-100" src={aboutimg} id=''  alt="" />
              <div className="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5"  id='' >
                <h1 className="display-4 text-white mb-0">15 <span className="fs-4" id=''>Năm</span></h1>
                <h4 className="text-white" id=''>Kinh nghiệm</h4>
              </div>
            </div>
          </div>
          <div className="col-lg-6" id=''>
            <h6 className="text-primary text-uppercase" id=''>// Về chúng tôi //</h6>
            <h1 className="mb-4"><span className="text-primary" id=''>Auto Fast</span> Dịch vụ bảo dưỡng xe cao cấp</h1>
            <p id='' className="mb-4">Với 15 năm kinh nghiệm trong lĩnh vực bảo dưỡng và sửa chữa xe ô tô, chúng tôi tự tin nói rằng chúng tôi chính là bố của các Gara ô tô, gọi bố đi các con</p>
            <div className="row g-4 mb-3 pb-3" id=''>
              <div className="col-12 wow fadeIn" data-wow-delay="0.1s" id=''>
                <div className="d-flex" id=''>
                  <div className="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" id='' style={{ width: '45px', height: '45px' }}>
                    <span className="fw-bold text-secondary" id=''>01</span>
                  </div>
                  <div className="ps-3" id=''>
                    <h6 className=''> Chuyên nghiệp</h6>
                    <span className=''>Trang thiết bị hiện đại </span>
                  </div>
                </div>
              </div>
              <div className="col-12 wow fadeIn" data-wow-delay="0.3s" id=''>
                <div className="d-flex" id=''>
                  <div className="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" id='' style={{ width: '45px', height: '45px' }}>
                    <span id='' className="fw-bold text-secondary">02</span>
                  </div>
                  <div className="ps-3 2">
                    <h6 id=''>Chất lượng cao cấp</h6>
                    <span id=''>Phụ tùng và sản phẩm cao cấp chính hãng</span>
                  </div>
                </div>
              </div>
              <div id='' className="col-12 wow fadeIn" data-wow-delay="0.5s">
                <div id='' className="d-flex">
                  <div id='' className="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style={{ width: '45px', height: '45px' }}>
                    <span id='' className="fw-bold text-secondary">03</span>
                  </div>
                  <div  id='' className="ps-3">
                    <h6 className=''>Các kỹ sư từng đạt sao michelin</h6>
                    <span className=''>Các kỹ sư người Việt với chuyên môn cực cao</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {/* Fact start */}
    <div className="container-fluid fact bg-dark my-5 py-5" id=''>
        <div className="container " id=''>
            <div className="row g-4" id=''>
                <div id='' className="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <i id='' className="fa fa-check fa-2x text-white mb-3"></i>
                    <h2 id='' className="text-white mb-2" data-toggle="counter-up">15</h2>
                    <p id='' className="text-white mb-0">Năm kinh nghiệm</p>
                </div>
                <div id='' className="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i id='' className="fa fa-users-cog fa-2x text-white mb-3"></i>
                    <h2 id='' className="text-white mb-2" data-toggle="counter-up">10</h2>
                    <p id='' className="text-white mb-0">Kỹ sư đẳng cấp</p>
                </div>
                <div id='' className="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i id='' className="fa fa-users fa-2x text-white mb-3"></i>
                    <h2 id='' className="text-white mb-2" data-toggle="counter-up">83454</h2>
                    <p id='' className="text-white mb-0">Khách hài lòng</p>
                </div>
                <div id='' className="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i id='' className="fa fa-car fa-2x text-white mb-3"></i>
                    <h2 id='' className="text-white mb-2" data-toggle="counter-up">123454</h2>
                    <p id='' className="text-white mb-0">Dự án hoàn thiện</p>
                </div>
            </div>
        </div>
    </div>
 {/* Team Start */}
 <div className="container-xxl py-5" id=''>
      <div className="container" id=''>
        <div className="text-center wow fadeInUp a" data-wow-delay="0.1s">
          <h6 className="text-primary text-uppercase">Các kỹ sư của chúng tôi</h6>
          <h1 className="mb-5">Các kỹ sư chuyên nghiệp của chúng tôi</h1>
        </div>
        <div className="row g-4 s4">
          <div className="col-lg-3 col-md-6 wow fadeInUp  s32" data-wow-delay="0.1s">
            <div className="team-item s3">
              <div className="position-relative overflow-hidden s2"> 
                <img style={{width: '500px'}} className="img-fluid  s2" src={khabanhimg} alt="" />
                <div className="team-overlay position-absolute start-0 top-0 w-100 h-100 1s">
                  <a className="btn btn-square mx-1 5" href=""><i className="fab fa-facebook-f"></i></a>
                  <a className="btn btn-square mx-1 4" href=""><i className="fab fa-twitter"></i></a>
                  <a className="btn btn-square mx-1 3" href=""><i className="fab fa-instagram"></i></a>
                </div>
              </div>
              <div className="bg-light text-center p-4 3">
                <h5 className="fw-bold mb-0">Hùng </h5>
                <small>Với kinh nghiệm từng làm việc 10 năm</small>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-md-6 wow fadeInUp 1" data-wow-delay="0.3s">
            <div className="team-item 2">
              <div className="position-relative overflow-hidden 4">
                <img style={{width: '500px'}} className="img-fluid 4" src={huanhoahongimg} alt="" />
                <div className="team-overlay position-absolute start-0 top-0 w-100 h-100 4">
                  <a className="btn btn-square mx-1 2" href=""><i className="fab fa-facebook-f"></i></a>
                  <a className="btn btn-square mx-1 22" href=""><i className="fab fa-twitter"></i></a>
                  <a className="btn btn-square mx-1 2" href=""><i className="fab fa-instagram"></i></a>
                </div>
              </div>
              <div className="bg-light text-center p-4">
                <h5 className="fw-bold mb-0">Đinh Việt Đức</h5>
                <small>Với kinh nghiệm 8 năm</small>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-md-6 wow fadeInUp     3" data-wow-delay="0.5s">
            <div className="team-item  33">
              <div className="position-relative overflow-hidden 3">
                <img style={{width: '500px'}} className="img-fluid 1" src={khanhskyimg} alt="" />
                <div className="team-overlay position-absolute start-0 top-0 w-100 h-100 5">
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-facebook-f 4"></i></a>
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-twitter 3"></i></a>
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-instagram 2"></i></a>
                </div>
              </div>
              <div className="bg-light text-center p-4 1">
                <h5 className="fw-bold mb-0">Phạm Đăng Đức Anh</h5>
                <small>Kinh nghiệm 15 năm </small>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-md-6 wow fadeInUp " id='' data-wow-delay="0.7s">
            <div className="team-item" id=''>
              <div className="position-relative overflow-hidden" id=''>
                <img  style={{width: '500px'} } id='' className="img-fluid" src={traizanimeimg} alt="" />
                <div className="team-overlay position-absolute start-0 top-0 w-100 h-100" id=''>
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-facebook-f" id=''></i></a>
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-twitter" id=''></i></a>
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-instagram" id=''></i></a>
                </div>
              </div>
              <div className="bg-light text-center p-4 ">
                <h5 className="fw-bold mb-0">Nguyễn Đức  Trọng</h5>
                <small >20 năm kinh nghiệm trong công việc</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  )
}

export default AboutUsPage