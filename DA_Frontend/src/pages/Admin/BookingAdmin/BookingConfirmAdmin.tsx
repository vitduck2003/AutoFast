import React, { useEffect, useState } from "react";

import { Space, Table, Tag, Popconfirm, message,   } from 'antd';
import type { ColumnsType } from 'antd/es/table';
import { Button, Modal  } from 'antd';
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
  booking: IBooking[],
  onRemoveBooking: (id: any) => void
}

const BookingConfirmAdmin = (props: IProps) => {
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [selectedService, setSelectedService] = useState<IBooing | null>(null);
  
  
  const showModal = (serviceData: IBooking) => {
    setSelectedService(serviceData);
    setIsModalVisible(true);
  };
  
  const closeModal = () => {
    setIsModalVisible(false);
    setSelectedService(null);
  };
  
  const removeBooking = (id: any) => {
    props.onRemoveBooking(id)
}
const columns: ColumnsType<DataType> = [
  {
    title: 'Họ và tên',
    dataIndex: 'full_name',
    key: 'full_name',
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
    render: (_, record) => (
      <Button type="dashed" onClick={() => showModal(record)}>
        Chi tiết
      </Button>
    ),
  },
  
  {
    title: 'Ngày đến',
    dataIndex: 'target_date',
    key: 'target_date',
    render: (text) => <a>{text}</a>,
  },
  {
    title: 'Ghi chú',
    dataIndex: 'note',
    key: 'note',
    render: (text) => <a>{text}</a>,
  },
  {
    title: 'Trạng thái',
    dataIndex: 'status',
    key: 'status',
    render: (text) => <a>{text}</a>,
  },
  {
    title: 'Action',
    key: 'action',
    render: ( record) => (
      <Space size="middle">
        <Popconfirm
  title="Xóa lịch"
  description="Bạn có chắc muốn xóa lịch này?"
  onConfirm={() => {
    removeBooking(record.id)
  }}
  okText="Có"
  okButtonProps={{
    style: {background: "orange", color: "white"},
  }}
  cancelText="Không"
>
  <Button danger>Delete</Button>
</Popconfirm>
        <Link to={``}><Button type="primary">Xác nhận</Button></Link>
        
      </Space>
    ),
  },
];

const data: DataType[] = props.booking
  .filter((item: IBooking) => item.status === "Đã xác nhận")
  .map((item: IBooking) => {
    return {
      key: item.id,
      ...item
    }
  });

  return (
    <div>
      <Table columns={columns} dataSource={data} pagination={{ pageSize: 5 }} />
      <Modal
  title="Thông tin dịch vụ"
  visible={isModalVisible}
  onOk={closeModal}
  onCancel={closeModal}
>
  {selectedService && (
    <div>
      <p>Họ và tên: {selectedService.full_name}</p>
      <p>Số điện thoại: {selectedService.phone}</p>
      <p>Email: {selectedService.email}</p>
      <p>Tên xe: {selectedService.name_car}</p>
      <p>Trạng thái: {selectedService.status}</p>
      <p>Thời gian đến dự kiến: {selectedService.target_time} Ngày {selectedService.target_date}</p>
      <p>Ghi chú: {selectedService.note}</p>
      
      
      
    </div>
  )}
</Modal>
    </div>
  )
}

export default BookingConfirmAdmin