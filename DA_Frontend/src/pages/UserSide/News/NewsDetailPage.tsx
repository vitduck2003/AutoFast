import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom'
import { INews } from '../../../interface/news';

const NewsDetailPage = (props: any) => {
  const { id } = useParams()
  const [New, setNews] = useState<any>([]);
  
  useEffect(() => {
    setNews(props.news.find(New => New.id == id))
})

  return (
    <div>
      
      <div>
      <p>{New?.title}</p>
           <p>{New?.content}</p>
           <p>{New?.date}</p>
      </div>
           
            
        </div>
  )
}

export default NewsDetailPage