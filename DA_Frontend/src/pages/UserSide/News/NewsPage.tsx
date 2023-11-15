import React from 'react'
import { Link } from "react-router-dom";

const NewsPage = ( props: any) => {
  
  const news = props.news
  console.log(news);
  
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
       <div className="row">
        <div className="col-md-8">
            <h2>Tin Tức Mới Nhất</h2>
            {props.news.map((item) => {
    return (
      
                <div className="card mb-3" key={item.id}>
            <img style={{ width: '200px' }} src={item.image} alt="..." />
            <div className="card-body">
                <h5 className="card-title">{item.title}</h5>
                <p className="card-text">{item.des}</p>
                <Link  to={`/news/${item.id}`}>Doc them</Link>
            </div>
        </div>
              
        
    );
})}

           
        </div>
     
      </div>

      
    </div>
    </div>
    
  )
}

export default NewsPage