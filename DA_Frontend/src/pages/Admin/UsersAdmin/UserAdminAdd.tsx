import React from "react";
import { IUser } from "../../../interface/user";
import { Button, Checkbox, Form, Input, Select, Slider, InputNumber } from "antd";
import { useNavigate } from "react-router-dom";
import { InboxOutlined, UploadOutlined } from "@ant-design/icons";
import { useForm, SubmitHandler } from "react-hook-form";

interface IProps {
  onAddUsers: (uses: IUser) => void;
}

const UserAdminAdd = (props: IProps) => {
  const navigate = useNavigate();

  const onFinish = (values: any) => {
    props.onAddUsers(values);
    alert("Success")
    navigate("/admin/users");
  };

  const onFinishFailed = (errorInfo: any) => {
    console.log("Failed:", errorInfo);
  };
  const { Option } = Select;

  const prefixSelector = (
    <Form.Item  name="prefix" noStyle>
      <Select style={{ width: 70 }}>
        <Option value="84">+84</Option>
      </Select>
    </Form.Item>
  );

  return (
    <div><Form
    name="basic"
    labelCol={{ span: 8 }}
    wrapperCol={{ span: 16 }}
    style={{ width: 1000, margin: "0 auto" }}
    initialValues={{ remember: true }}
    onFinish={onFinish}
    onFinishFailed={onFinishFailed}
    autoComplete="off"
  >
    <Form.Item
      label="Name"
      name="name"
      rules={[{  message: "Vui lòng nhập họ và tên!" }]}
    >
      <Input />
    </Form.Item>
    <Form.Item
      label="Tên tài khoản"
      name="username"
      rules={[{ required: true, message: "Vui lòng nhập tên tài khoản" }]}
    >
      <Input />
    </Form.Item>

    <Form.Item
      label="Email"
      name="email"
      rules={[
        {
          required: true,
          type: "email",
          message: "Vui lòng không bỏ trống email",
        },
      ]}
    >
      <Input />
    </Form.Item>

    <Form.Item
      label=""
      name="role"
      rules={[
        {
          required: true,
          message: "",
        },
      ]}
      initialValue="admin"
      style={{ display: 'none' }}
    >
      <Input />
    </Form.Item>

    <Form.Item
      label="Mật khẩu"
      name="password"
      rules={[{ required: true, message: "Vui lòng nhập mật khẩu" }]}
    >
      <Input />
    </Form.Item>
    <Form.Item
      label="Nhập lại mật khẩu"
      name="password2"
      rules={[{ required: true, message: "Vui lòng nhập mật khẩu" }]}
    >
      <Input />
    </Form.Item>

    

    <Form.Item wrapperCol={{ offset: 8, span: 16 }}>
      <Button type="primary" htmlType="submit">
        Add New Account
      </Button>
    </Form.Item>
  </Form></div>
  )
}

export default UserAdminAdd