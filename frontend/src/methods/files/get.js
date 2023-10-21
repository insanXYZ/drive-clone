import axios from "axios";
import Cookies from "js-cookie";

function get()
{
  return axios.get("http://127.0.0.1:8000/api/file",{
    headers: {
      Accept : "application/json",
      Authorization: "Bearer "+Cookies.get("token"),
    }
  })
}

export default get