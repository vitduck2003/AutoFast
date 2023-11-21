import React from 'react'
import './main.css';
import './style.css'


const NewsPage = ( props: any) => {
  
  const news = props.news
  console.log(news);
  
  return (
    <div>
      <div className="container">
        <div className="row px-lg-5 g-4 mb-5">
            <div className="col-12">
                <h1 className="heading-primary mb-4 text-start"><span>Blog</span></h1>

            </div>


                            <div className="row px-lg-5 g-4 mb-5">
                    <div className="col-12">
                        <h2 className="heading-primary mb-4 text-start"><a href="kinh-nghiem-sua-chua-bao-duong.html">Chuyên Mục Bảo Dưỡng & Sửa Chữa</a></h2>

                    </div>
                                                                    <div className="col-lg-8 col-12" data-sal-duration="1600">
                            <div className="blog-item">
                                <a href="index.html" title="Sửa ô tô ở đâu tốt ?"
                                   className="img img-cover img-effect zoom-in-1 auto-scale">
                                    <img className="lazyload" data-src="https://otohathanh.com/uploads/images/bai-viet/kinh-nghiem/phu-tung-oto.jpg" alt="Sửa ô tô ở đâu tốt ?"/>
                                </a>
                                <time className="d-inline-flex align-items-center">13-08-2020</time>
                                <h4 className="title fw-700 mb-2"><a href="index.html"
                                                                 title="Sửa ô tô ở đâu tốt ?">Sửa ô tô ở đâu tốt ?</a>
                                </h4>
                                <p className="description">Trên địa bàn thành phố Hà Nội hiện nay có rất nhiều địa chỉ sửa chữa ô tô và người tiêu dùng có thể dễ dàng lựa chọn một&nbsp;Garage ô tô&nbsp;dọc trên những con đường. Nhưng làm thế nào để được sử dụng dịch vụ sửa chữa ô tô tốt...<a href="index.html" title="Sửa ô tô ở đâu tốt ?" className="read-more">Xem thêm</a></p>
                            </div>
                        </div>
                    
                    <div className="col-lg-4 col-12">
                                                                                                                
                                <div className="blog-item-horizontal d-flex mb-3" data-sal-duration="1600"
                                     data-sal-delay="0">
                                    <a href="index.html" title="TRUNG TÂM SỬA CHỮA XE KIA"
                                       className="img img-cover img-effect zoom-in-1 auto-scale">
                                        <img className="lazyload" data-src="upload/images/dich-vu/16-1-.jpg"
                                             alt="TRUNG TÂM SỬA CHỮA XE KIA"/>
                                    </a>
                                    <div className="info">
                                        <h4 className="title fw-700 mb-2"><a href="index.html"
                                                                         title="TRUNG TÂM SỬA CHỮA XE KIA">TRUNG TÂM SỬA CHỮA XE KIA</a>
                                        </h4>
                                        <time className="d-inline-flex align-items-center"
                                             >20-08-2020</time>
                                    </div>

                                </div>
                                                            
                                <div className="blog-item-horizontal d-flex mb-3" data-sal-duration="1600"
                                     data-sal-delay="300">
                                    <a href="garaga-sua-o-to-huyndai-tot-nhat-ha-noi-a226.html" title="GARAGA SỬA Ô TÔ HUYNDAI TỐT NHẤT HÀ NỘI"
                                       className="img img-cover img-effect zoom-in-1 auto-scale">
                                        <img className="lazyload" data-src="upload/images/kinh-nghiem/garage-sua-o-to-huyndai-tot-nhat-ha-noi-ava.jpg"
                                             alt="GARAGA SỬA Ô TÔ HUYNDAI TỐT NHẤT HÀ NỘI"/>
                                    </a>
                                    <div className="info">
                                        <h4 className="title fw-700 mb-2"><a href="garaga-sua-o-to-huyndai-tot-nhat-ha-noi-a226.html"
                                                                         title="GARAGA SỬA Ô TÔ HUYNDAI TỐT NHẤT HÀ NỘI">GARAGA SỬA Ô TÔ HUYNDAI TỐT NHẤT HÀ NỘI</a>
                                        </h4>
                                        <time className="d-inline-flex align-items-center"
                                              > 25-08-2020</time>
                                    </div>

                                </div>
                                                            
                                <div className="blog-item-horizontal d-flex mb-3" data-sal-duration="1600"
                                     data-sal-delay="600">
                                    <a href="lazetti-cdx-hay-bi-loi-gi-a222.html" title="LAZETTI CDX HAY BỊ LỖI GÌ?"
                                       className="img img-cover img-effect zoom-in-1 auto-scale">
                                        <img className="lazyload" data-src="upload/images/kinh-nghiem/lazetti-cdx-hay-bi-loi-gi-ava.jpg"
                                             alt="LAZETTI CDX HAY BỊ LỖI GÌ?"/>
                                    </a>
                                    <div className="info">
                                        <h4 className="title fw-700 mb-2"><a href="lazetti-cdx-hay-bi-loi-gi-a222.html"
                                                                         title="LAZETTI CDX HAY BỊ LỖI GÌ?">LAZETTI CDX HAY BỊ LỖI GÌ?</a>
                                        </h4>
                                        <time className="d-inline-flex align-items-center"
                                              >28-08-2020 </time>
                                    </div>

                                </div>
                                                            
                                <div className="blog-item-horizontal d-flex mb-3" data-sal-duration="1600"
                                     data-sal-delay="900">
                                    <a href="thay-giam-xoc-cho-o-to-khi-nao-a219.html" title="THAY GIẢM XÓC CHO Ô TÔ KHI NÀO?"
                                       className="img img-cover img-effect zoom-in-1 auto-scale">
                                        <img className="lazyload" data-src="upload/images/kinh-nghiem/thay-giam-xoc-o-to-khi-nao-ha-thanh-garage-ava.jpg"
                                             alt="THAY GIẢM XÓC CHO Ô TÔ KHI NÀO?"/>
                                    </a>
                                    <div className="info">
                                        <h4 className="title fw-700 mb-2"><a href="thay-giam-xoc-cho-o-to-khi-nao-a219.html"
                                                                         title="THAY GIẢM XÓC CHO Ô TÔ KHI NÀO?">THAY GIẢM XÓC CHO Ô TÔ KHI NÀO?</a>
                                        </h4>
                                        <time className="d-inline-flex align-items-center"
                                              >28-08-2020</time>
                                    </div>

                                </div>
                                                            
                                <div className="blog-item-horizontal d-flex mb-3" data-sal-duration="1600"
                                     data-sal-delay="1200">
                                    <a href="gara-chuyen-sua-chua-phanh-xe-bmw-tai-ha-noi-a216.html" title="GARA CHUYÊN SỬA CHỮA PHANH XE BMW TẠI HÀ NỘI"
                                       className="img img-cover img-effect zoom-in-1 auto-scale">
                                        <img className="lazyload" data-src="upload/images/kinh-nghiem/gara-chuyen-sua-chua-bmw-tai-ha-noi-ava.jpg"
                                             alt="GARA CHUYÊN SỬA CHỮA PHANH XE BMW TẠI HÀ NỘI"/>
                                    </a>
                                    <div className="info">
                                        <h4 className="title fw-700 mb-2"><a href="gara-chuyen-sua-chua-phanh-xe-bmw-tai-ha-noi-a216.html"
                                                                         title="GARA CHUYÊN SỬA CHỮA PHANH XE BMW TẠI HÀ NỘI">GARA CHUYÊN SỬA CHỮA PHANH XE BMW TẠI HÀ NỘI</a>
                                        </h4>
                                        <time className="d-inline-flex align-items-center"
                                              >28-08-2020 </time>
                                    </div>

                                </div>
                                                            
                                <div className="blog-item-horizontal d-flex mb-3" data-sal-duration="1600"
                                     data-sal-delay="1500">
                                    <a href="sua-chua-o-to-bmw-tai-gara-o-to-ha-thanh-a215.html" title="SỬA CHỮA Ô TÔ BMW TẠI GARA Ô TÔ HÀ THÀNH"
                                       className="img img-cover img-effect zoom-in-1 auto-scale">
                                        <img className="lazyload" data-src="upload/images/kinh-nghiem/sua-chua-o-to-bmw-tai-gara-o-to-ha-thanh-1-ava.jpg"
                                             alt="SỬA CHỮA Ô TÔ BMW TẠI GARA Ô TÔ HÀ THÀNH"/>
                                    </a>
                                    <div className="info">
                                        <h4 className="title fw-700 mb-2"><a href="sua-chua-o-to-bmw-tai-gara-o-to-ha-thanh-a215.html"
                                                                         title="SỬA CHỮA Ô TÔ BMW TẠI GARA Ô TÔ HÀ THÀNH">SỬA CHỮA Ô TÔ BMW TẠI GARA Ô TÔ HÀ THÀNH</a>
                                        </h4>
                                        <time className="d-inline-flex align-items-center"
                                              >28-08-2020 </time>
                                    </div>

                                </div>
                                                                                                    </div>
                </div>

              
                                                                                                    </div>
                </div>
    </div>
    
  )
}

export default NewsPage