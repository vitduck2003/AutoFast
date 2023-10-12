import React from 'react'

const NewsPage = ( props: any) => {
  return (
    <div>
     <div className="container-fluid page-header mb-5 p-0">
        <div className="container-fluid page-header-inner py-5">
          <div className="container text-center">
            <h1 className="display-3 text-white mb-3 animated slideInDown">
              News
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
                  News
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
       <div className="container-xxl py-5">
      <div className="container">
        <div className="row g-4">
        {props.news.map((item: any) => {
                return <div key={item.id} className="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <a href={`news/${item.id}`}>
                <div className="d-flex py-5 px-4">
                  <img style={{width: '120px', height: '120px'}} src="" alt="" />
                  <div className="ps-4">
                    <h5 className="mb-3">{item.title}</h5>
                    <span style={{fontSize: '10px'}} >{item.date}</span>
                    <b><p>{item.desc}</p></b>
                  </div>
                </div>
                </a>
              </div>

            })}
          


        </div>
      </div>

      
    </div>
    </div>
  )
}

export default NewsPage