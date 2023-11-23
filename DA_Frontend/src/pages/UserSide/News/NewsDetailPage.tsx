import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom'
import { INews } from '../../../interface/news';

const NewsDetailPage = (props: any) => {
  const { id } = useParams()
  console.log(id);
  
  const [New, setNews] = useState<any>([]);
  
  useEffect(() => {
    setNews(props.news.find(New => New.id == id))
})
const containerStyle = {
  maxWidth: '1600px',
  margin: '0 auto',
  padding: '20px',
};

const headerStyle = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};
const headerStyle2 = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};
const headerStyle3 = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};
const headerStyle4 = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};
const headerStyle5 = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};
const headerStyle6 = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};

const headerStyle7 = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};
const headerStyle8 = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};
const headerStyle9 = {
  textAlign: 'center',
  backgroundColor: '#333',
  color: '#fff',
  padding: '10px',
};

const articleStyle = {
  backgroundColor: '#fff',
  padding: '20px',
  marginTop: '20px',
  borderRadius: '8px',
  boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)',
};
const articleStyle2 = {
  backgroundColor: '#fff',
  padding: '20px',
  marginTop: '20px',
  borderRadius: '8px',
  boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)',
};
const articleStyle3 = {
  backgroundColor: '#fff',
  padding: '20px',
  marginTop: '20px',
  borderRadius: '8px',
  boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)',
};
const articleStyle4 = {
  backgroundColor: '#fff',
  padding: '20px',
  marginTop: '20px',
  borderRadius: '8px',
  boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)',
};
const articleStyle5 = {
  backgroundColor: '#fff',
  padding: '20px',
  marginTop: '20px',
  borderRadius: '8px',
  boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)',
};
const imageStyle = {
  maxWidth: '100%',
  height: 'auto',
  borderRadius: '8px',
  marginBottom: '15px',
};

const dateAuthorStyle = {
  color: '#888',
  fontSize: '14px',
};

const contentStyle = {
  lineHeight: '1.6',
};
    return (
      <div style={containerStyle}>
          <header >
              <h1>{New?.title}</h1>
          </header>
    
          <article style={articleStyle}>
              <img src={New?.image} alt="Hình ảnh tin tức" style={imageStyle} />
              <p style={dateAuthorStyle}>Ngày Đăng: 16 tháng 11, 2023</p>
              <p style={contentStyle}>
                 {New?.content}
              </p>
          </article>
      </div>
    );
  
}

export default NewsDetailPage


