import React from 'react'
import logo from './../assets/Images/logo.svg'

import { HiMiniMagnifyingGlass } from "react-icons/hi2";
import { HiOutlineMoon } from "react-icons/hi2";



function Header() {
  return (
    <div className='flex items-center' >
      <img src={logo} width={60} height={60} />
      <div className='flex bg-stone-200 p-2 w-full items-center mr-5 rounded-full  ' >
      <HiMiniMagnifyingGlass />
        <input type='text' className='bg-transparent outline-none ' />
        <div>
        <HiOutlineMoon />
        </div>    

        

      </div>
     

    </div>
  )
}

export default Header
