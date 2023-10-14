import React from "react";
import { Button, Checkbox, Form, Input } from "antd";
import { Link } from "react-router-dom";
import { useNavigate } from "react-router-dom";
import { IUser } from "../../../interface/user";
import { useState } from "react";
import { Alert, Space } from "antd";
import { notification } from "antd";
import instance from "../../api/instance";
import { useParams } from "react-router-dom";
const VerifyPage = () => {
  // Use the useParams hook to get the `sdt` parameter from the URL
  const { sdt } = useParams();
  const navigate = useNavigate();
  const [api, contextHolder] = notification.useNotification();
  const [showNotification, setShowNotification] = useState(false);
  const resend =(sdt)=>{
    return instance.post('register/resend-verification-code',sdt).then((response)=>{console.log(response)})
  }
  const verify = (values) => {
    return instance
      .post("register/verify-code", values)
      .then((response) => {
        if (response.data.message === "Vui lòng xác thực tài khoản") {
          openNotification(response.data.message, "black", "green", "Success");
        
          // Use a nested .then block to navigate after handling the success case
          return new Promise<void>((resolve) => {
            setTimeout(() => {
              navigate(`/verify/${response.data.phone_verified}`); // Navigate to the verification page with the phone number
              resolve();
            }, 3000); // Delay for 3 seconds
          });
        }else if (response?.data?.message == "Mã xác minh không đúng") {
          console.log(response);
          return openNotification(
            response?.data?.message,
            "white",
            "red",
            "Failed"
          );
        }
        console.log(response.data.message);
      })
      .catch((error) => {
        // Handle errors
        console.error(":", error);
        return openNotification(error.data?.message, "white", "red", "Failed");
        throw error;
      });
  };
  const openNotification = (mess, text_color, bg_color, title) => {
    setShowNotification(true);
    api.open({
      message: title,
      description: mess,
      duration: 3,
      style: {
        backgroundColor: bg_color,
        color: text_color,
      },
      onClose: () => {
        setShowNotification(false);
      },
    });
  };
  const onFinish = (values) => {
    verify(values)
      .then((response) => {
        // if (response?.data?.message == "Xác minh mã thành công") {
        //   console.log(response?.data?.message)
        //   openNotification(response?.data?.message, "black", "green", "Success");
        // } else if(response?.data?.message == "Mã xác minh không đúng"){
        //   console.log(response)
        //   return openNotification(response?.data?.message, "white", "red", "Failed");
        // }
        console.log(response.data);
      })
      .then(() => {
        console.log(sdt, values);
      })
      .catch((error) => {
        // Handle any errors here if needed
        console.error("Error:", error);
        throw error; // Rethrow the error for further handling in your component
      });
  };
  const onFinishFailed = (errorInfo: any) => {
    console.log("Failed:", errorInfo);
  };
  return (
    <div>
      <div className="container  h-100; vh-100">
        <div className="row d-flex justify-content-center align-items-center h-100">
          {contextHolder}
          <div className="col-lg-12 col-xl-11">
            <div className="card text-black" style={{ borderRadius: "25px" }}>
              <div className="card-body p-md-4">
                <div className="row justify-content-center">
                  <div className="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                    <p className="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                      Nhập mã xác thực
                    </p>
                    <p> Mã xác thực của bạn đã được gửi về số +84 {sdt}</p>
                    <div>
                      <Form
                        name="basic"
                        labelCol={{ span: 8 }}
                        wrapperCol={{ span: 16 }}
                        style={{ maxWidth: 600 }}
                        initialValues={{ remember: true }}
                        onFinish={onFinish}
                        onFinishFailed={onFinishFailed}
                        autoComplete="off"
                      >
                        <Form.Item
                          label="Code"
                          name="code"
                          rules={[
                            {
                              required: true,
                              message:
                                "Vui lòng nhập mã số được gửi vào  điện thoại bạn ",
                            },
                          ]}
                        >
                          <Input />
                        </Form.Item>
                        <Form.Item
                          name="phone"
                          initialValue={sdt} // Set the initial value to {sdt}
                        ></Form.Item>
                        <Form.Item wrapperCol={{ offset: 8, span: 16 }}>
                          <Button
                            type="primary"
                            htmlType="submit"
                            style={{ marginRight: "10px" }}
                          >
                            Xác thực
                          </Button>
                          <Button
                            type="primary"
                            style={{ backgroundColor: "blue", color: "white" }}
                            onClick={()=>resend(sdt)}
                          >
                            Gửi lại mã
                          </Button>
                        </Form.Item>
                      </Form>
                    </div>
                  </div>
                  <div className="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                    <img
                      src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                      className="img-fluid"
                      alt="Sample image"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default VerifyPage;
