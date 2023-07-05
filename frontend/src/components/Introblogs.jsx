import React, { useEffect, useState } from 'react'
import axios from "axios";
import { Link} from 'react-router-dom';

export default function Introblogs() {


  const localStorageData = JSON.parse(localStorage.getItem('user-info'));
  // console.log(localStorageData)

  const token = localStorageData?.token
  // console.log(token)

  const baseURL = "http://localhost:8000/api/show-post";
  const [post, setPost] = useState(null);

  useEffect(() => {
    axios.get(baseURL, {
      method: 'get',
      headers: {
        'Authorization': `Bearer ${token}`
      }
    }).then((response) => {

      setPost(response.data);
    });
  }, []);

  console.log(post)
  return (
    <div className='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10 px-10 md:px-15 lg:px-32 overflow-hidden'>
      {post?.posts?.map((item, index) => (
        <div key={index} className='m-4 cursor-pointer'  >
          <Link to={'posts/'+item.post_id}>
          <img src={`http://localhost:8000${item?.full_img}`} alt='cover-img' className='w-full rounded-2xl
           object-cover h-[200px]'/>
          <h3 className='text-red-500 mt-3'>{item.tags}</h3>
          <h3 className='font-bold mt-3'>{item.title}</h3>
          <h3 className='line-clamp-3 text-gray-400 mt-3'>{item.detail}</h3></Link>

        </div>
      ))}

    </div>


  )
}
