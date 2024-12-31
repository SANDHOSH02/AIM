import React from 'react'
import logo from './../assets/Images/logo.svg'

import { HiMiniMagnifyingGlass } from "react-icons/hi2";
import { HiOutlineMoon } from "react-icons/hi2";
import { HiOutlineSun } from "react-icons/hi2";




function Header() {
  const [toggle,setToggle]
  return (
    <div className='flex items-center p-3 ' >
      <img src={logo} width={60} height={60} />
      <div className='flex bg-stone-200 p-2 w-full items-center mx-5 rounded-full  ' >
      <HiMiniMagnifyingGlass />
        <input type='text' placeholder='Search Games' className='bg-transparent outline-none px-2 ' />
        <div>
        <HiOutlineMoon />
        <HiOutlineSun />

        </div>    

        

      </div>
     

    </div>
  )
}

export default Header
