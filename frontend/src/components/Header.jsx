import React, { } from 'react'
import logo from './../media/Logo.webp'
import { Link, useNavigate } from 'react-router-dom'

export default function Header() {
  const navigate = useNavigate();
  function logout() {
    const localStorageData = JSON.parse(localStorage.getItem('user-info'));
    if (localStorageData) {

      localStorage.clear();
      navigate("/login");

    }
  }


  return (
    <div className='flex justify-between items-center bg-slate-700 sticky top-0'>
      <img src={logo} alt='logo' className='' />
      <ul className='flex gap-4 md:gap-12'>
        <li className='hover:font-bold hover:text-red-900 font-red cursor-pointer'>
          <Link to="/">Home</Link></li>
        
        <li className='hover:font-bold hover:text-red-900 cursor-pointer'>
          <Link to={"/createpost"}>New Blog</Link>
        </li>
        <li className='hover:font-bold hover:text-red-900 cursor-pointer'>
          <Link to="/blogs">Contact Us</Link></li>
      </ul>

      {localStorage.getItem('user-info') ?

        <button className='bg-slate-400 mr-4 p-2 rounded-full' onClick={logout} >
          <Link to={'/login'}>Logout</Link>
        </button>
        :
        <button className='bg-slate-400 mr-4 p-2 rounded-full'  >
          <Link to={'/login'}>Login</Link>
        </button>
      }

    </div>
  )
}
