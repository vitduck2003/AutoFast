import React from "react";
import { Button, Checkbox, Form, Input } from "antd";
import { Link } from "react-router-dom";
import { useNavigate } from "react-router-dom";
import { IUser } from "../../../interface/user";

const SignupPage = (props) => {
  const navigate = useNavigate();
  type FieldType = {
    name?: string;
    password?: string;
    // password2?: string;
    role_id?: string;
    email?: string;
    remember?: string;
  };
  console.log(props)

  const onFinish = (values: FieldType) => {
    // Call the onAddUsers function with the user data
    props.onAddUsers(values);
    console.log(values)
    // Redirect to the desired location after signup
    // navigate('/dashboard'); // You can change '/dashboard' to your desired route
  };

  const onFinishFailed = (errorInfo: any) => {
    console.log("Failed:", errorInfo);
  };

  return (
    <div>
      <div className="container  h-100; vh-100">
        <div className="row d-flex justify-content-center align-items-center h-100">
          <div className="col-lg-12 col-xl-11">
            <div className="card text-black" style={{ borderRadius: "25px" }}>
              <div className="card-body p-md-4">
                <div className="row justify-content-center">
                  <div className="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                    <p className="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                      Đăng ký
                    </p>

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

                        <Form.Item<FieldType>
                          label=""
                          name="role_id"
                          rules={[
                            {
                              required: true,
                              message: "",
                            },
                          ]}
                          initialValue="2"
                          style={{ display: 'none' }}
                        >
                          <Input />
                        </Form.Item>

                        <Form.Item<FieldType>
                          label="Họ Và Tên"
                          name="name"
                          rules={[
                            {
                              required: true,
                              message: "Vui lòng không bỏ trống tên",
                            },
                          ]}
                        >
                          <Input />
                        </Form.Item>
                        <Form.Item
                          label="Phone"
                          name="phone"
                          rules={[{ required: true, message: "Vui lòng nhập số điện thoại" }]}
                        >
                          <Input />
                        </Form.Item>
                        <Form.Item<FieldType>
                          label="Email"
                          name="email"
                          rules={[
                            {
                              required: true,
                              pattern: /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/,
                              message: "Email không hợp lệ",
                            },
                          ]}
                        >
                          <Input />
                        </Form.Item>

                        <Form.Item<FieldType>
                          label="Mật khẩu"
                          name="password"
                          rules={[
                            {
                              required: true,
                              message: "Vui lòng nhập mật khẩu",
                              min: 6,
                            },
                          ]}
                        >
                          <Input.Password />
                        </Form.Item>
                        {/* <Form.Item<FieldType>
                          label="Nhập lại mật khẩu"
                          name="password2"
                          rules={[
                            {
                              required: true,
                              message: "Vui lòng nhập mật khẩu",
                              min: 6,
                            },
                          ]}
                        >
                          <Input.Password />
                        </Form.Item> */}

                        <Form.Item wrapperCol={{ offset: 8, span: 16 }}>
                          <Button type="primary" htmlType="submit">
                            Đăng ký
                          </Button>
                        </Form.Item>
                      </Form>
                      <span style={{ paddingLeft: '100px' }}>Bạn đã có tài khoản? <Link style={{ textDecoration: 'none' }} to="/signin" >Đăng nhập</Link></span>
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

export default SignupPage;
