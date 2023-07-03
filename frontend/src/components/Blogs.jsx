import React, { useEffect, useState } from 'react'
import axios from "axios";
import { useParams } from 'react-router-dom';

export default function Blogs() {
  const { id } = useParams();
  // console.log(id)

  //fetch the token from the local storage
  const localStorageData = JSON.parse(localStorage.getItem('user-info'));
  const token = localStorageData?.token

  //fetch the api

  const [post, setPost] = useState([]);
  const [comments, setComments] = useState([]);

  useEffect(() => {
    const base_url = `http://localhost:8000/api/view-post/${id}`
    axios.get(base_url, {
      method: 'get',
      headers: {
        'Authorization': `Bearer ${token}`
      }
    }).then((response) => {
      // console.log(response)

      setPost(response.data.posts[0]);

    });
  }, []);

 function getComments(){
  const base_url = `http://localhost:8000/api/show-comment/${id}`
  axios.get(base_url, {
    method: 'get',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  }).then((response) => {
    // console.log(response);

    setComments(response.data.user)

  });
}
  //for comments
  useEffect(() => {
    // console.log(id);
    getComments();
   
  }, [])

  console.log(comments)
  // console.log(post)

  //to give comment
  const [comment, setComment] = useState("");


  async function give_Comment(e) {
    console.log(e);
    e.preventDefault();
    
    let data = {
      "post_id": id,
      "comment": comment
    }
    let result = await fetch("http://localhost:8000/api/create-comment", {
      method: 'post',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    }).then((response) => {


      e.target.reset();
      getComments();
      // console.log(response);
    });



  }
  return (

    <div className='px-6 md:px-20 lg:px-56 mt-10'>
      <img src={`http://localhost:8000${post.full_img}`} className='rounded-2xl mt-5 mb-5 w-full' />
      <h3 className='text-red-500 text-[12px]'>{post.tags}</h3>
      <h3 className='text-[23px] font-bold'>{post.title}</h3>
      <div>
        <h3 className='text-[16px] mt-9 '>{post.detail}</h3>
      </div>

      {/* comments strats */}
      <div className='mt-10' >
        <div className='mt pt-1  bg-gray-500'>
          <h2 >Comments:-</h2>
        </div>
        {comments ?
          comments?.map((item, index) => (



            <div key={index} className='mt-4'>
              <h4 className='ml-3'>{item?.user?.name}</h4>
              <h3 className='ml-9'>{item?.comment}</h3>
            </div>))
          :
          <h3>No Comments Yet</h3>
        }
      </div>
      <div className='mt-7 mb-6 w-full flex overflow-hidden'>
        <form onSubmit={give_Comment}> 

          <textarea  onChange={(e) => { setComment(e.target.value) }} name="inputComment" className='w-full resize-none  bg-gray-300 border-3 rounded-md' type="text" placeholder='Comment here' maxLength={300} />
          <input type='submit' value="Send" className='border-2 p-3 rounded-md bg-green-400 font-bold' />

        </form>

      </div>
    </div>


  )
}
