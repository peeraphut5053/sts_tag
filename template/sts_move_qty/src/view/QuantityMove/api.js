import axios from 'axios';
export default 
axios.create({
  //    http://localhost:88/sts_web_center_new/
  //    http://172.18.1.194/sts_web_center/
  //    http://61.90.156.165/sts_web_center/
  //    http://${window.location.host}/sts_web_center/
  baseURL: `http://${window.location.host}/sts_web_center/`
});