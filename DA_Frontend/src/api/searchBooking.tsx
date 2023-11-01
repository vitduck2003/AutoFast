import instance from "./instance";
import { IBooking } from "../interface/booking";
const searchBooking = () => {
  return instance.get("/admin/bookings");
};
// Đang sử dụng tạm bằng API này


export { searchBooking};
