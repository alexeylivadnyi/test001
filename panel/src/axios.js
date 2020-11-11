import axios from "axios";

let base = "";
const { hostname } = window.location;

if (["localhost", "hicaliber.test"].includes(hostname)) {
  base = "api.hicaliber.test:8010";
}

export default axios.create({
  baseURL: `${window.location.protocol}//${base}/api/`
});
