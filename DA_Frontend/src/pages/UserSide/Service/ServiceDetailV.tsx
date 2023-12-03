import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { Pagination, Rate } from 'antd';
import serviceItemClone from "../../../assets/img/img_item/ServiceItemClone.png"
import { getReview, getReviewItem } from '../../../api/review';

const itemsPerPage = 8;

const ServiceDetailV = (props) => {
  const slideStyle = {
    width: "100%",
    maxWidth: "600px", /* Điều chỉnh chiều rộng tối đa của danh sách */
    margin: "0 auto"
  }
  const slideStyle2 = {
    marginBottom: "20px",
    border: "1px solid #ddd",
    borderRadius: "8px",
    padding: "15px"
  }
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
            <ul className="list-group"style={slideStyle}>
        <li className="list-group-item" style={slideStyle2}>
          
            <h5 className="mb-1" style={{ marginBottom: "30px", fontWeight: 'bold',
  color: "#333"}}>Khách Hàng: {item.name}</h5>
            
            <div style={{paddingTop: "20px"}}>
            <label htmlFor= "" style={{ color: "#333", fontWeight: 'bold'}}>Mô Tả:</label>
          <p className="mb-1" >{item.content}</p>
            </div>

            <div style={{paddingTop: "20px"}}>
              <label htmlFor="" style={{ color: "#333", fontWeight: 'bold', marginRight: "20px"}}>Đánh Giá: </label>
          <Rate allowHalf disabled  value={item.rating} />
          </div>
        </li>

      </ul>
      </div>
       })}
      </div>
        </div>
    );
}

export default ServiceDetailV;
