import {useState, useEffect} from 'react'
import { useParams } from 'react-router';

import { Rate } from 'antd';

const Review = ({bookingdetail, service}) => {
  console.log(bookingdetail);
  console.log(service);
  
  
  const { id } = useParams()
  console.log(id);
  
  const [review, setNews] = useState<any>([]);
  console.log(review);
  
//   useEffect(() => {
//     setNews(props.booking.find((review: { id: string | undefined; }) => review.id == id))
// })
  return (
    <div><div className="container mt-5">
    <h2 className="text-center mb-4">Đánh Giá Sản Phẩm</h2>
  
   
    <form>
      <div className="form-group">
        <label htmlFor="productName">Tên Dịch Vụ</label>
        <input type="text" className="form-control" id="productName" placeholder="Nhập tên sản phẩm" />
      </div>
      <div className="form-group">
        <label htmlFor="review">Đánh Giá:</label>
        <textarea className="form-control" id="review" rows="4" placeholder="Nhập đánh giá của bạn"></textarea>
      </div>
      <div className="form-group">
        <label htmlFor="rating">Điểm Đánh Giá </label>
        <Rate allowHalf value={2.5} />
      </div>
      <button type="submit" className="btn btn-primary">Gửi Đánh Giá</button>
    </form>
  
  
    <div className="mt-4">
      <h3>Đánh Giá Gần Đây</h3>
      <ul className="list-group">
      
      </ul>
    </div>
  </div></div>
  )
}

export default Review