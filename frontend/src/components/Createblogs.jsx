import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom';

function Createblogs() {

  const localStorageData = JSON.parse(localStorage.getItem('user-info'));
  const token = localStorageData?.token

  const [title, setTitle] = useState("");
  const [details, setDetails] = useState("");
  const [tag, setTags] = useState("");
  const [image, setImage] = useState("");
 

  async function createPost(e) {

    console.log("Check");
    e.preventDefault();
    console.log(image);


    let formData = new FormData();
    formData.append("full_img", image)
    formData.append("title", title)
    formData.append("cat_id", 2)
    formData.append("detail", details)
    formData.append("tags", tag)

    // //     e.preventDefault();
    //    await fetch("http://localhost:8000/api/create-post", {
    //         method: 'post',
    //         headers: {
    //           'Authorization': `Bearer ${token}`,
    //         },
    //         body: formData
    //       }).then(() => {

    //         e.target.reset();

    //     });



    await axios.post('http://localhost:8000/api/create-post', formData, {
      headers: {
       'Authorization': `Bearer ${token}`,
      },
    }).then((response) => {
      console.log(response);
      e.target.reset();

    });
  }


  return (
    <div className=' h-screen w-full ' >

      <div className='hidden sm:block'>
        {/* <img className='w-full h-full  object-cover' src={loginImg} alt="" /> */}
      </div>

      <div className='bg-gray-800 flex flex-col justify-center h-screen'>
        <div >
          <form  onSubmit={createPost} className='max-w-[400px] w-full mx-auto bg-gray-900 p-8 px-8 rounded-lg'>
            <h2 className='text-4x4 font-bold text-white text-center'>Create your blog</h2>

            <div className='flex flex-col text-gray-400 py-2'>
              <label>post title</label>
              <input type="text" onChange={(e) => { setTitle(e.target.value) }} name="title" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
            </div>
            <div className='flex flex-col text-gray-400 py-2'>
              <label>cover image</label>
              <input type="file" onChange={(e) => { setImage(e.target.files[0]) }} name="image" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
            </div>

            <div className='flex flex-col text-gray-400 py-2'>
              <label>give the details</label>
              <input type="text" onChange={(e) => { setDetails(e.target.value) }} name="details" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
            </div>
            <div className='flex flex-col text-gray-400 py-2'>
              <label>your tag</label>
              <input type="text" onChange={(e) => { setTags(e.target.value) }} name="tags" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
            </div>

            <input type="submit" value="Create Post" className='w-full my-5 py-2 bg-teal-500 shadow-lg shadow-teal-500/50 hover:shadow-teal-500/40 text-white font-semibold rounded-lg' />
            <div className='flex justify-between text-gray-400 py-2'>

            </div>


          </form>
        </div>
      </div>

    </div>
  )
}

export default Createblogs
