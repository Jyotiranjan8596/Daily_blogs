import React, { useState } from 'react'

import { Link } from 'react-router-dom'

export default function Register() {

    const [name,setName]=useState("");
    const [email,setEmail]=useState("");
    const [password,setPassword]=useState("");
    const [confirm_password,setConfirmPassword]=useState("");

function saveUser(){

    console.warn(name,email,password,confirm_password);
    let data={name,email,password}
    fetch("http://localhost:8000/api/register",{
        method:'post',
        headers:{
            'Accept':'application/json',
            'Content-Type':'application/json'
        },
        body:JSON.stringify(data)  
    }).then((result)=>{
        console.warn("result",result)

    })

}


  return (
    <div className=' h-screen w-full ' >

    <div className='hidden sm:block'>
      {/* <img className='w-full h-full  object-cover' src={loginImg} alt="" /> */}
    </div>

    <div className='bg-gray-800 flex flex-col justify-center h-screen'>
      <div >
      <form className='max-w-[400px] w-full mx-auto bg-gray-900 p-8 px-8 rounded-lg'>
        <h2 className='text-4x4 font-bold text-white text-center'>Register</h2>

        <div className='flex flex-col text-gray-400 py-2'>
          <label>User Name</label>
          <input type="text"  value={name} onChange={(e)=>{setName(e.target.value)}} name="username" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
        </div>

        <div className='flex flex-col text-gray-400 py-2'>
          <label>Email</label>
          <input type="text"  value={email} onChange={(e)=>{setEmail(e.target.value)}} name="email" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
        </div>
        <div className='flex flex-col text-gray-400 py-2'>
          <label>Password</label>
          <input type="password"  value={password} onChange={(e)=>{setPassword(e.target.value)}} name="password" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
        </div>
        <div className='flex flex-col text-gray-400 py-2'>
          <label>Confirm Password</label>
          <input type="password" value={confirm_password} onChange={(e)=>{setConfirmPassword(e.target.value)}} name="confirm_password" className='rounded-lg bg-gray-700 mt-2 p-2 focus:border-blue-500 focus:bg-gray-800 focus:outline-none' />
        </div>
        

        <button type="button" onClick={saveUser} className='w-full my-5 py-2 bg-teal-500 shadow-lg shadow-teal-500/50 hover:shadow-teal-500/40 text-white font-semibold rounded-lg'>Submit</button>
        <div className='flex justify-between text-gray-400 py-2'>
          <p>
            <Link to="/login">already a member?</Link>
          </p>
        </div>


      </form>
      </div>
    </div>

  </div>
  )
}
