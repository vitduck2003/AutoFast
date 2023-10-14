import React from 'react';
import { useParams } from 'react-router-dom';
import instance from "./instance";
import { IUser } from "../interface/user";

const VerifyPage = () => {
  // Use the useParams hook to get the `sdt` parameter from the URL
  const { sdt } = useParams();
  const verify = ( verify_code) => {
  
    return instance.post("register/verify-code", verify_code)
      .then((response) => {
        // Handle the response as needed
        return response.data;
      })
      .catch((error) => {
        // Handle errors
        console.error("Error:", error);
        throw error;
      });
  };
  
const send_phone_number = (sdt)=>{
    return instance.post("register/verify-code", sdt)
      .then((response) => {
        // Handle the response as needed
        return response.data;
      })
      .catch((error) => {
        // Handle errors
        console.error("Error:", error);
        throw error;
      });
}
 
  return (
    <div>
      <h1>VerifyPage</h1>
      <p>sdt: {sdt}</p>
    </div>
  );
}

export default VerifyPage;
