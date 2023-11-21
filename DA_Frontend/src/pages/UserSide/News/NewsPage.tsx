import React from 'react'
import { Link } from "react-router-dom";

const NewsPage = ( props: any) => {
  
  const news = props.news
  console.log(news);
  
  return (
    
    

    <div>
      <div>
        
      </div>


      
       <div className="container-xxl py-5 4">
       <div className="row sa">
        <div className="col-md-8 g">
            <h2>Tin Tức Mới Nhất</h2>
            {props.news.map((item) => {
    return (
      
      <div className="row gx-5">
      <div className="col-md-6 mb-4">
        <div className="bg-image hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
          <img src={item.image} className="img-fluid" />
          <a href="#!">
            <div className="mask" ></div>
          </a>
        </div>
      </div>
    
      <div className="col-md-6 mb-4">
        <span className="badge black px-2 py-1 shadow-1-strong mb-3">{item.title}</span>
        <h4><strong>{item.des}</strong></h4>
        <p className="text-muted">
         {item.content}
        </p>
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