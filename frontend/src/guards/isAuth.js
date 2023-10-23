import Axios from "axios";
import Cookies from "js-cookie";

function isAuth(to, from, next)
{
  if(Cookies.get("token")){
    Axios.post("http://127.0.0.1:8000/api/isAuth",null,{
      headers: {
        Accept: "application/json",
        Authorization : "Bearer " + Cookies.get("token")
      }
    }).then((response)=>{
      if(response.data.token){
        Cookies.set("token", response.data.token)
      }
      next()
    }).catch((error)=>{
      next("/login")
    })
  } else {
    next("/login")
  }
}

export default isAuth;