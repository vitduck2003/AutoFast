import React from 'react'
import aboutimg from '../../../assets/img/about.jpg'; 
import khabanhimg from '../../../assets/img/ngobakha.jpg';
import khanhskyimg from '../../../assets/img/khanhsky.jpg';
import huanhoahongimg from '../../../assets/img/huanhoahong.jpg';
import traizanimeimg from '../../../assets/img/boizanime.jpg';

const AboutUsPage = ({about, abouts, aboutz, technicians}   ) => {
console.log(about);
console.log(abouts);
console.log(aboutz);
console.log(technicians);

  
  return (
    <div>
         <div className="container-fluid page-header mb-5 p-0 " id=''>
        <div className="container-fluid page-header-inner py-5 " id=''>
            <div className="container text-center"  id=''>
                <h1 className="display-3 text-white mb-3 animated slideInDown " id=''>Về Chúng Tôi</h1>
                <nav aria-label="breadcrumb " id=''>
                    <ol className="breadcrumb justify-content-center text-uppercase " id=''>
                        <li className="breadcrumb-item " id=''><a href="#">Home</a></li>
                        <li className="breadcrumb-item " id=''><a href="#">Pages</a></li>
                        <li className="breadcrumb-item text-white active " aria-current="page" id=''>About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        {/* Service  */}
    <div className="container-xxl py-5" id=''>
      <div className="container" id=''>
        <div className="row g-4" id=''>
        {about.map((item: any)=>{
          return <div key={item.id} className="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" id=''>
                <div className="d-flex py-5 px-4" id='' >
              <i className="fa fa-certificate fa-3x text-primary flex-shrink-0" id=''></i>
              <div className="ps-4" id=''>
                <h5 className="mb-3" id=''>{item.name}</h5>
                <p>{item.content}</p>
              </div>
            </div>
            
          </div>
          })}
        </div>
      </div>
    </div>
    {/* About */}
    <div className="container-xxl py-5" id=''>
      <div className="container " id=''>
        <div className="row g-5" id=''>
          <div className="col-lg-6 pt-4" style={{ minHeight: '400px' }} id=''>
            {aboutz.map((item:any)=>{
              return <div className="position-relative h-100 wow fadeIn" data-wow-delay="0.1s" key={item.id} id=''>
              <img className="position-absolute img-fluid w-100 h-100" src={item.img} id=''  alt="" />
              <div className="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5"  id='' >
                <h1 className="display-4 text-white mb-0">15 <span className="fs-4" id=''>Năm</span></h1>
                <h4 className="text-white" id=''>Kinh nghiệm</h4>
              </div>
            </div>
             })}
          </div>
          <div className="col-lg-6" id=''>
            <div>
            {aboutz.map((item:any)=>{
           return <div key={item.id}>
            <h6 className="text-primary text-uppercase" id=''>// Về chúng tôi //</h6>
            <h1 className="mb-4"><span className="text-primary" id=''>{item.name}</span></h1>
            <p id='' className="mb-4">{item.content}</p>
            </div>
             })}
            </div>
            <div className="row g-4 mb-3 pb-3 " id=''>
              <div className="col-12 wow fadeIn " data-wow-delay="0.1s" id=''>
                <div className="d-flex " id=''>
                  <div className=" bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" id='' style={{ width: '45px', height: '45px' }}>
                    <span className="fw-bold text-secondary " id=''>01</span>
                  </div> 
                  <div className="ps-3" id='' >
                    <h6 className='' > Chuyên nghiệp </h6>
                    <span className='' >Trang thiết bị hiện đại </span>
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
              {abouts.map((item:any)=>{
                return <div id='' className="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                <i id='' className="fa fa-check fa-2x text-white mb-3"></i>
                <h2 id='' className="text-white mb-2" data-toggle="counter-up">{item.soluong}</h2>
                <p id='' className="text-white mb-0">{item.name}</p>
            </div>
              })}
                
                
            </div>
        </div>
    </div>
 {/* Team Start */}
 <div className="container-xxl py-5" id=''>
  <div className="container">
    <div className="text-center wow fadeInUp a" data-wow-delay="0.1s">
      <h6 className="text-primary text-uppercase">Các kỹ sư của chúng tôi</h6>
      <h1 className="mb-5">Các kỹ sư chuyên nghiệp của chúng tôi</h1>
    </div>

    <div className="row g-4">
      {technicians.map((item: any) => (
        <div key={item.id} className="col-lg-3 col-md-6 wow fadeInUp s32" data-wow-delay="0.1s">
          <div className="team-item s3">
            <div className="position-relative overflow-hidden s2">
              <img style={{ width: '500px' }} className="img-fluid s2" src={item.image} alt="" />
              <div className="team-overlay position-absolute start-0 top-0 w-100 h-100 1s">
                <a className="btn btn-square mx-1 5" href=""><i className="fab fa-facebook-f"></i></a>
                <a className="btn btn-square mx-1 4" href=""><i className="fab fa-twitter"></i></a>
                <a className="btn btn-square mx-1 3" href=""><i className="fab fa-instagram"></i></a>
              </div>
            </div>
            <div className="bg-light text-center p-4 3">
              <h5 className="fw-bold mb-0">{item.name}</h5>
              <small>{item.information}</small>
            </div>
          </div>
        </div>
      ))}
    </div>
  </div>
</div>
    </div>
  )
}

export default AboutUsPage