import axios from "axios";

export default axios.create({
    baseURL: process.env.MIX_BASE_URL,
    headers: {
        "Content-type": "application/json"
    }
});
