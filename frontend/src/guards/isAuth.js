import Axios from "axios";
import Cookies from "js-cookie";

function isAuth(to, from, next)
{
  if(Cookies.get("token")){
    next()
  } else {
    next("/login")
  }
}

export default isAuth;