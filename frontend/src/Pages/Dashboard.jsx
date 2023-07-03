import React from 'react'
import Banner from '../components/Banner'
import Introblogs from '../components/Introblogs'
import Footer from '../components/Footer'
import Header from '../components/Header'
// import Register from '../components/Register'

function Dashboard() {


  
  return (
    <div>
      
      <Header/>
        <Banner/>
        <Introblogs/>
     {/* <Blogs/> */}
      <Footer/> 


    </div>
  )
}

export default Dashboard
