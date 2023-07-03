import React, { useState } from 'react'
// import loginImg from '../media/login_background.jpg'
import {  Link, useNavigate } from "react-router-dom";

export default function Login() {
  
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  
  const navigate= useNavigate();

  async function loginUser() {
    
    let data = { email, password }

    let result = await fetch("http://localhost:8000/api/login", {
      method: 'post',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });

    let response = await result.json();
    console.warn(response);
    if (response) {

      Navigation();
    }
    else{
      alert("Invalid Credentials")
      navigate("/login");
    }
    
    function Navigation(){
      
      navigate("/");
      localStorage.setItem("user-info", JSON.stringify(response));

    }

  }


  return (
    <div className=' h-screen w-full ' >

      <div className='hidden sm:block'>
        {/* <img className='w-full h-full  object-cover' src={loginImg} alt="" />  */}
      </div>

      <div className='bg-gray-800 flex flex-col justify-center h-screen'>
        <div >
          <form className='max-w-[400px] w-full mx-auto bg-gray-900 p-8 px-8 rounded-lg'>
            <h2 className='text-4x4 font-bold text-white text-center'>Sign In</h2>

            <div className='flex flex-col text-gray-400 py-2'>
              <label>User Name</label>
              <input type="text" value={email} onChange={(e) => { setEmail(e.target.value) }} name="email" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
            </div>
            <div className='flex flex-col text-gray-400 py-2'>
              <label>Password</label>
              <input type="password" value={password} onChange={(e) => { setPassword(e.target.value) }} name="password" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
            </div>

            <button type="button" onClick={loginUser} className='w-full my-5 py-2 bg-teal-500 shadow-lg shadow-teal-500/50 hover:shadow-teal-500/40 text-white font-semibold rounded-lg'>Submit</button>
            <div className='inline-block justify-between text-gray-400 py-2 hover:cursor-pointer '>
              <Link to="/forgotpassword" ><p>Forgot Password</p></Link>
            </div>
            <div className='inline-block float-right text-gray-400 py-2  '>
              <p>not a member?</p>
            </div>


          </form>
        </div>
      </div>

    </div>


  )
}
