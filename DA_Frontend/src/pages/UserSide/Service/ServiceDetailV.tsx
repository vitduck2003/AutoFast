import React from 'react';
import { useParams } from 'react-router-dom';
import imageabc from "../../../assets/img/anh.jpg"

const ServiceDetailV = (props: any) => {
    const { id } = useParams();
    console.log(id);

    const slideStyle = {
        margin: "60px 0"
    };

    // Chuyển đổi id từ string sang số
    const numericId = parseInt(id, 10);

    // Lọc chỉ những phần có id bằng giá trị id từ useParams()
    const filteredItems = props.serviceItem.filter((item: any) => item.id_service === numericId);

    console.log(filteredItems);
    
    return (
        <div className="container">
            <h1 className="heading-primary text-center" style={slideStyle}><span>Chi Tiết Các Dịch Vụ Sửa Chữa</span> </h1>

            <div className="row g-4 row-cols-lg-4 row-cols-md-2 row-cols-1 mb-4">
                {filteredItems.map((item: any) => (
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
        </div>
    );
}

export default ServiceDetailV;
