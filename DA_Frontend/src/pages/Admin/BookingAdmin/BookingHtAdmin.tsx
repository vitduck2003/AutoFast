import React, { useEffect, useState } from "react";

import { Space, Table, Tag, Popconfirm, message,   } from 'antd';
import type { ColumnsType } from 'antd/es/table';
import { Button } from 'antd';
import { Link } from 'react-router-dom'

import { IBooking } from "../../../interface/booking";

interface DataType {
  id: number,
    full_name: string,
    email: string,
    service: string,
    phone: number,
    desc: string,
    time: any ,
    active: any,
    date: any,
    created_at: any,
    updated_at: any
}

interface IProps {
  bookingHT: IBooking[],
}


const BookingHtAdmin = (props: IProps) => {
  
 

const columns: ColumnsType<DataType> = [
  {
    title: 'Họ và tên',
    dataIndex: 'name',
    key: 'name',
    render: (number) => <a>{number}</a>,
  },
  {
    title: 'Số điện thoại',
    dataIndex: 'phone',
    key: 'phone',
  },
  {
    title: 'Dịch vụ',
    dataIndex: 'service',
    key: 'service',
    render: (text) => <a>{text}</a>,
  },
  {
    title: 'Ngày đến',
    dataIndex: 'date',
    key: 'date',
    render: (text) => <a>{text}</a>,
  },
  {
    title: 'Ghi chú',
    dataIndex: 'desc',
    key: 'desc',
    render: (text) => <a>{text}</a>,
  },
  {
    title: 'Trạng thái',
    dataIndex: 'active',
    key: 'active',
    render: (text) => <a>{text}</a>,
  },
  {
    title: 'Action',
    key: 'action',
    render: ( record) => (
      <Space size="middle">
        <Link to={``}><Button type="primary">Kiểm tra lại</Button></Link>
        
      </Space>
    ),
  },
];

const data: DataType[] = props.bookingHT.map((item: IBooking) => {
  return {
      key: item.id,
      ...item
  }
})

  return (
    <div><Table columns={columns} dataSource={data} pagination={{ pageSize: 5 }} /></div>
  )
}

export default BookingHtAdmin