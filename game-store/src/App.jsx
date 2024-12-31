import React, { useState } from 'react';
import './App.css';
import Home from './Pages/Home'
import Header from './Componenets/Header'

function App() {
  const [count, setCount] = useState(0);

  return (
    <div>
      <Home/>
      <Header/>
    </div>
  );
}

export default App;
