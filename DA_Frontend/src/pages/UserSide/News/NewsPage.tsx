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
       <div className="row">
        <div className="col-md-8">
            <h2>Tin Tức Mới Nhất</h2>
            <div className="card mb-3">
            <img style={{width: '200px'}} src="https://placehold.it/800x400" alt="..." />
                <div className="card-body">
                    <h5 className="card-title">Tiêu đề bài viết 1</h5>
                    <p className="card-text">Nội dung mô tả ngắn gọn về bài viết 1.</p>
                    <a href="#" className="btn btn-primary">Đọc thêm</a>
                </div>
            </div>

            <div className="card mb-3">
            <img style={{width: '200px'}} src="https://placehold.it/800x400" alt="..." />
                <div className="card-body">
                    <h5 className="card-title">Tiêu đề bài viết 2</h5>
                    <p className="card-text">Nội dung mô tả ngắn gọn về bài viết 2.</p>
                    <a href="#" className="btn btn-primary">Đọc thêm</a>
                </div>
            </div>
        </div>
     
      </div>

      
    </div>
    </div>
    
  )
}

export default NewsPage