import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { Pagination, Rate } from 'antd';
import serviceItemClone from "../../../assets/img/img_item/ServiceItemClone.png"
import { getReview, getReviewItem } from '../../../api/review';

const itemsPerPage = 8;

const ServiceDetailV = (props) => {
    const { id } = useParams();
    const [currentPage, setCurrentPage] = useState(1);
    const [review,setReview] = useState([])
    
    
    useEffect(() => {
        // Assuming getReview is a function that fetches reviews, replace it with your actual implementation
      
    
        const fetchReviews = async () => {
          const reviews = await getReview();
          console.log({reviews});
          const filteredReviews = reviews.data.reviews.filter((item) => item.service_id == id);
         
          
          setReview(filteredReviews);
        };
    
        fetchReviews();
      }, [id]);
     
    const numericId = parseInt(id, 10);

    const filteredItems = props.serviceItem.filter((item) => item.id_service === numericId);

    const indexOfLastItem = currentPage * itemsPerPage;
    const indexOfFirstItem = indexOfLastItem - itemsPerPage;
    const currentItems = filteredItems.slice(indexOfFirstItem, indexOfLastItem);

    const handlePageChange = (pageNumber) => setCurrentPage(pageNumber);
    const slideStyle3 ={
        borderBottom: "none"
      }

      const handleImageError = (e: React.SyntheticEvent<HTMLImageElement, Event>) => {
        const imgElement = e.target as HTMLImageElement;
        imgElement.onerror = null;
        imgElement.src = serviceItemClone;
      };
    return (
        <div className="container">
            <h1 className="text-center"  style={{ margin: "60px 0", borderBottom: "none"  }}>
                <span>Chi Tiết Các Dịch Vụ Sửa Chữa</span>
            </h1>

            <div className="row g-4 row-cols-lg-4 row-cols-md-2 row-cols-1 mb-4">
                {currentItems.map((item) => (
                    <div key={item.id} className="col sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="0">
                        <div className="accessory-item">
                            <a title={item.item_name} className="img auto-scale img-scaledown img-effect zoom-in-1">
                                <img src={`/src/assets/img/img_item/${item.image}`} className=" ls-is-cached lazyloaded" alt={item.item_name} onError={handleImageError} />
                            </a>
                            <h3 className="title text-center mb-3">
                                <a title={item.item_name}>{item.item_name}</a>
                            </h3>
                        </div>
                    </div>
                ))}
            </div>

            {/* Hiển thị phân trang Ant Design */}
            <div className="pagination">
                <Pagination
                    defaultCurrent={1}
                    current={currentPage}
                    total={filteredItems.length}
                    pageSize={itemsPerPage}
                    onChange={handlePageChange}
                />
            </div>
            <div>
                {review.map((item:any)=>{
                    return <div key={item.id}>
            <ul className="list-group">
        <li className="list-group-item">
          <div className="d-flex w-100 justify-content-between">
            <h5 className="mb-1"></h5>
            {item.name}
          </div>
          <p className="mb-1">{item.content}</p>
          <Rate allowHalf disabled  value={item.rating} />
        </li>

      </ul>
      </div>
       })}
      </div>
        </div>
    );
}

export default ServiceDetailV;
