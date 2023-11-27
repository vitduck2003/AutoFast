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
  width: "100%",
  height: "auto",
  display: "block",
  margin: "20px auto"
};

const headerStyle = {
  backgroundColor: "rgba(251, 251, 251, 0.15)"
};
const headerStyle2 = {
  width: "800px",
  height: "700px",
  display: "block",
  margin: "20px auto"
};
const headerStyle3 = {
  textAlign: 'center',
  color: 'DodgerBlue',
  padding: '20px',
  fontSize: '34px',
  fontWeight: 'bold',
};
const headerStyle4 = {
  textAlign: 'center',
  color: 'black',
  padding: '5px',
  fontSize: '24px',
  fontWeight: 'bold',
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


    return (
      
      <div className="card px-3 pt-3" style={containerStyle}>
 
  <div>
   
    <div className="bg-image hover-overlay shadow-1-strong ripple rounded-5 mb-4" data-mdb-ripple-color="light">
    <h5 style={headerStyle3}>{New?.title}</h5>
      <img src={New?.image} className="" style={headerStyle2} />
      <a href="#!">
        <div className="mask" style={headerStyle}></div>
      </a>
    </div>
   
    <a href="" style={headerStyle4} >
      <p>
        {New?.des}
      </p>
    </a>

    <hr />
    </div>
    </div>
    );
  
}

export default NewsDetailPage


