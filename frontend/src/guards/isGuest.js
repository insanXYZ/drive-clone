import Axios from "axios";
import Cookies from "js-cookie";

function isGuest(to , from ,next)
{
  if(Cookies.get("token")){
    next("/")
  } else {
    next()
  }

}

export default isGuest;