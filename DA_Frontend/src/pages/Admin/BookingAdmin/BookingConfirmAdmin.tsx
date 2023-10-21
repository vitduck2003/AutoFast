import React, { useEffect, useState } from "react";

import { Space, Table, Tag, Popconfirm, message,   } from 'antd';
import type { ColumnsType } from 'antd/es/table';
import { Button, Modal  } from 'antd';
import { Link } from 'react-router-dom'

import { IBooking } from "../../../interface/booking";

interface DataType {
  id: number,
  name: string,
  email: string,
  service?: string,
  phone: number,
  note: string,
  target_date: string ,
  target_time: string ,
  name_car: string ,
  created_at?: string,
  updated_at?: string
}

interface IProps {
  booking: IBooking[],
  onRemoveBooking: (id: DataType) => void
  onUpdateBooking: (booking: IBooking) => void
}

const BookingConfirmAdmin = (props: IProps) => {
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [selectedService, setSelectedService] = useState<IBooking | null>(null);
  
  
  const showModal = (serviceData: IBooking) => {
    setSelectedService(serviceData);
    setIsModalVisible(true);
  };
  
  const closeModal = () => {
    setIsModalVisible(false);
    setSelectedService(null);
  };
  
  const removeBooking = (id: DataType) => {
    props.onRemoveBooking(id)
}
const confirmBooking = (record: DataType) => {
  // Tạo một bản sao của record để không thay đổi trực tiếp state
  const updatedRecord = { ...record, status: "Đã hoàn thành" };
console.log(updatedRecord);

  // Gửi dữ liệu đã cập nhật lên API
  props.onUpdateBooking(updatedRecord);
}
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
    render: (text) => <a style={{color: 'orange'}}>{text}</a>,
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
<Popconfirm
  title="Xác nhận hoàn thành"
  description="Xác nhận lịch này đã hoàn thành"
  onConfirm={() => {
    confirmBooking(record)
  }}
  okText="Có"
  okButtonProps={{
    style: {background: "orange", color: "white"},
  }}
  cancelText="Không"
>
  <Button>Xác nhận hoàn thành</Button>
</Popconfirm>
        
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
      <p>Họ và tên: {selectedService.name}</p>
      <p>Số điện thoại: {selectedService.phone}</p>
      <p>Email: {selectedService.email}</p>
      <p>Tên xe: {selectedService.name_car}</p>
      <p>Trạng thái: <span style={{color: 'orange'}}>{selectedService.status}</span></p>
      <p>Thời gian đến dự kiến: {selectedService.target_time} Ngày {selectedService.target_date}</p>
      <p>Ghi chú: {selectedService.note}</p>
      
      
      
    </div>
  )}
</Modal>
    </div>
  )
}

export default BookingConfirmAdmin