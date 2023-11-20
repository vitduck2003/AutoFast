import React from 'react'

import khabanhimg from '../../../assets/img/ngobakha.jpg';
import khanhskyimg from '../../../assets/img/khanhsky.jpg';
import huanhoahongimg from '../../../assets/img/huanhoahong.jpg';
import traizanimeimg from '../../../assets/img/boizanime.jpg';



const TeamPage = (props: any) => {
  return (
    
     <div>
       {props.technicians.map((item: any) => {
                return <div key={item.id}>
                    {/* <h2>{item.name}</h2> */}
     </div>

            })}
        <div className="container-fluid page-header mb-5 p-0">
    <div className="container-fluid page-header-inner py-5">
        <div className="container text-center">
            <h1 className="display-3 text-white mb-3 animated slideInDown">Kỹ thuật viên</h1>
            <nav aria-label="breadcrumb">
                <ol className="breadcrumb justify-content-center text-uppercase">
                    <li className="breadcrumb-item"><a href="#">Home</a></li>
                    <li className="breadcrumb-item"><a href="#">Pages</a></li>
                    <li className="breadcrumb-item text-white active" aria-current="page">Technicians</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
{/* Team Start */}
<div className="container">
  {props.technicians.map((item: any)=>{
    return <div className="container" key={item.id}>
        <div className="text-center" data-wow-delay="0.1s">
          <h6 className="text-primary text-uppercase">// Các kỹ sư của chúng tôi //</h6>
          <h1 className="mb-5">Các kỹ sư chuyên nghiệp</h1>
        </div>
        <div className="row ">
          <div className="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div className="team-item">
              <div className="position-relative overflow-hidden">
                <img style={{width: '500px'}} className="img-fluid" src={item.image} alt="" />
                <div className="team-overlay position-absolute start-0 top-0 w-100 h-100">
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-facebook-f"></i></a>
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-twitter"></i></a>
                  <a className="btn btn-square mx-1" href=""><i className="fab fa-instagram"></i></a>
                </div>
              </div>
              <div className="bg-light text-center p-4">
                <h5 className="fw-bold mb-0">{item.name} </h5>
                <small>{item.information}</small>
              </div>
            </div>
          </div>
          
        </div>
      </div>
  })}
      
    </div>
</div>
  )
}

export default TeamPage