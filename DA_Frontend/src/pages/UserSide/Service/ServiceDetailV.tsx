import React, { useState } from 'react';
import { useParams } from 'react-router-dom';
import { Pagination } from 'antd';

const itemsPerPage = 8;

const ServiceDetailV = (props) => {
    const { id } = useParams();
    const [currentPage, setCurrentPage] = useState(1);

    const numericId = parseInt(id, 10);

    const filteredItems = props.serviceItem.filter((item) => item.id_service === numericId);

    const indexOfLastItem = currentPage * itemsPerPage;
    const indexOfFirstItem = indexOfLastItem - itemsPerPage;
    const currentItems = filteredItems.slice(indexOfFirstItem, indexOfLastItem);

    const handlePageChange = (pageNumber) => setCurrentPage(pageNumber);

    return (
        <div className="container">
            <h1 className="heading-primary text-center" style={{ margin: "60px 0" }}>
                <span>Chi Tiết Các Dịch Vụ Sửa Chữa</span>
            </h1>

            <div className="row g-4 row-cols-lg-4 row-cols-md-2 row-cols-1 mb-4">
                {currentItems.map((item) => (
                    <div key={item.id} className="col sal-animate" data-sal="slide-up" data-sal-duration="1600" data-sal-delay="0">
                        <div className="accessory-item">
                            <a title={item.item_name} className="img auto-scale img-scaledown img-effect zoom-in-1">
                                <img src={`/src/assets/img/${item.image}`} className=" ls-is-cached lazyloaded" alt={item.item_name} />
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
        </div>
    );
}

export default ServiceDetailV;
