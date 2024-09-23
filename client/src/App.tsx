import './App.css'
import AppRouter from './router'
import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000/api/';

function App() {

  return (
    <>
      <AppRouter />
    </>
  )
}

export default App
