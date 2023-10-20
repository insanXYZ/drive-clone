import axios from "axios";
import Cookies from "js-cookie";

async function input(formData)
{
  return axios.post("http://127.0.0.1:8000/api/input", formData, {
    headers: {
      "Content-Type" : "multipart/form-data",
      Accept : "application/json",
      Authorization: "Bearer "+Cookies.get("token")
    }
  })
}

export default input