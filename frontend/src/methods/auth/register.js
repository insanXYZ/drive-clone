import Axios from "axios"

function register(name, email, password)
{
  return Axios.post("http://127.0.0.1:8000/api/register",{
    name:name,
    email:email,
    password:password
  },{
    headers:{
      Accept: "application/json"
    }
  })
}

export default register;