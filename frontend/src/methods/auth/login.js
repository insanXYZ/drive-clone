import Axios from "axios"

function login(email, password)
{
  return Axios.post("http://127.0.0.1:8000/api/login",{
    email:email,
    password:password
  },{
    headers:{ 
      Accept: "application/json",
    }
  })
}

export default login;