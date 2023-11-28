import React from 'react'
const ServicePage = (props:any) => {
  console.log(props);
  
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
        </div>
      </nav>
      <div className="container">
        <h1 className=" text-center" style={slideStyle2}><span>Bảo Dưỡng &amp; Sửa Chữa Ô Tô</span> </h1>
        <div className="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
              {props.servicePage.map((item: any)=>{
                return <div key={item.id} className="col mb-5">
            <div className="service-catalogue-item mx-lg-4 mb-4 sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="0">
              <a href={`/service/${item.id}`} title="Vệ Sinh Điều Hòa Ô Tô - Công Nghệ Nội Soi" className="img img-cover img-effect zoom-in-1 auto-scale">
                <img className=" lazyloaded" src={`./src/assets/img/img_service/${item.image_service}`} alt="" />
              </a>
              <h4 className="title fw-600"><a href="" title="Vệ Sinh Điều Hòa Ô Tô - Công Nghệ Nội Soi">{item.service_name}</a></h4>
            </div>
          </div>
})}
        </div>
      </div>
    </main>
  )
}

export default ServicePage