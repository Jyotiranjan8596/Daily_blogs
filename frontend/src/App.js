import Login from './components/Login';
import './App.css';
import Dashboard from './Pages/Dashboard';
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Register from './components/Register';
import Blogs from './components/Blogs';
import ForgotPassword from './components/ForgotPassword';
import Createblogs from './components/Createblogs';

function App() {




  return (
    <div >
      <BrowserRouter>
      

        <Routes>
          <Route path='/' element={<Dashboard />} />
          <Route path='/posts' element={<Blogs />} />
          <Route path='/register' element={<Register />} />
          <Route path='/login' element={<Login />}/>
          <Route path="/posts/:id" element={<Blogs/>} />
          <Route path='/forgotpassword' element={<ForgotPassword/>} />
          <Route path='/createpost' element={<Createblogs/>} />
        </Routes>

      </BrowserRouter>


    </div>
  );
}

export default App;
