import Axios from "axios";
import Cookies from "js-cookie";

function isGuest(to , from ,next)
{
  if(Cookies.get("token")){
    Axios.post("http://127.0.0.1:8000/api/isAuth",null,{
      headers: {
        Accept: "application/json",
        Authorization : "Bearer" + Cookies.get("token")
      }
    }).then((response)=>{
      next("/")
    }).catch((response)=>{
      next()
    })
  } else {
    next()
  }

}

export default isGuest;