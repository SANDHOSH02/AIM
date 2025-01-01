import React, { useState } from 'react';
import './App.css';
import Home from './Pages/Home'
import Header from './Componenets/Header'
import { ThemeContext } from '../Context/ThemeContext';


function App() {
  
  const [theme, setTheme] = useState('light');

  return (
    <ThemeContext.Provider value={{theme,setTheme}} >
    <div className={`${theme} ${theme == 'dark' ? 'bg-[#121212]' : null} h-[100vh]`}>
      <Home />
      <Header />
      
    </div>
    </ThemeContext.Provider>
  );
}

export default App;
