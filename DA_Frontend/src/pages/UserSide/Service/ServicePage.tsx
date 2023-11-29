import React, { useState } from 'react';
import { Pagination } from 'antd';

const ServicePage = (props: any) => {
  const slideStyle = {
    
    paddingBottom: "20px"
  };

  const slideStyle2 = {
    margin: "60px 0"
  }

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 4;

  const handlePageChange = (page) => {
    setCurrentPage(page);
  };

  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;

  const reversedServicePage = [...props.servicePage].reverse();

  const renderServiceItems = () => {
    return reversedServicePage.slice(startIndex, endIndex).map((item: any) => (
      <div key={item.id} className="col mb-5">
        <div className="service-catalogue-item mx-lg-4 mb-4 sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="0">
          <a href={`/service/${item.id}`} title={item.service_name} className="img img-cover img-effect zoom-in-1 auto-scale">
            <img className="lazyloaded" src={`./src/assets/img/img_service/${item.image_service}`} alt={item.service_name} />
          </a>
          <h4 className="title fw-600"><a href={`/service/${item.id}`} title={item.service_name}>{item.service_name}</a></h4>
        </div>
      </div>
    ));
  };

  return (
    <main className="product-category" style={slideStyle}>
      <div className="container">
        <h1 className="text-center" style={slideStyle2}><span>Bảo Dưỡng &amp; Sửa Chữa Ô Tô</span> </h1>
        <div className="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
          {renderServiceItems()}
        </div>
        <div className="pagination-container text-center">
          <Pagination
            current={currentPage}
            pageSize={itemsPerPage}
            total={props.servicePage.length}
            onChange={handlePageChange}
          />
        </div>
      </div>
    </main>
  );
}

export default ServicePage;
