import React from 'react'
import banner from './../media/banner-img.png'

function Banner() {
  return (
    <div className='bg-slate-200 grid grid-cols-2 md:grid-cols-2 sm:grid-cols-1 h-screen overflow-hidden'>
      <div className=' bg-slate-200 mt-40 ml-32 overflow-hidden'>
        <h3 className='font-serif text-lg font-semibold '>
          Find Discussion of Countries </h3>
        <h1 className='text-5xl font-extrabold font-serif justify-items-start'>
          Join with us to make a Creative world
          </h1>

      </div>
      <div className=''>
        <img src={banner} alt="banner" className='mt-20' />
      </div>
    </div>
  )
}

export default Banner