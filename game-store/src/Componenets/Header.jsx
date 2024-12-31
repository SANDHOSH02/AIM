import React, { useState } from "react";
import logo from "./../assets/Images/logo.svg";

import { HiMiniMagnifyingGlass } from "react-icons/hi2";
import { HiOutlineMoon } from "react-icons/hi2";
import { HiOutlineSun } from "react-icons/hi2";

function Header() {
  const [toggle, setToggle] = useState(true);
  return (
    <div className="flex items-center p-3 ">
      <img src={logo} width={60} height={60} />
      <div
        className="flex bg-slate-200 p-2 w-full items-center mx-5 rounded-full cursor-pointer  "
        onClick={() => setToggle(!toggle)}
      >
        <HiMiniMagnifyingGlass />
        <input
          type="text"
          placeholder="Search Games"
          className="bg-transparent outline-none px-2 "
          
        />
      </div>

      <div>
        {toggle ? (
          <HiOutlineMoon className=" text-[35px] bg-slate-200 text-black p-1 rounded-full cursor-pointer " onClick={()=>setToggle(!toggle)}/>
        ) : (
          <HiOutlineSun className=" text-[35px] bg-slate-200 text-black p-1 rounded-full cursor-pointer "onClick={()=>setToggle(!toggle)} />
        )}
      </div>
    </div>
  );
}

export default Header;
