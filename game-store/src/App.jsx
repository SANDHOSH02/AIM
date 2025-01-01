import React, { useState } from 'react';
import './App.css';
import Home from './Pages/Home'
import Header from './Componenets/Header'

function App() {
  const [count, setCount] = useState(0);
  const [theme, setTheme] = useState('dark');

  return (
    <div className={`${theme} ${theme == 'dark' ? 'bg-[#121212]' : null}`}>
      <Home />
      <Header />
    </div>
  );
}

export default App;
