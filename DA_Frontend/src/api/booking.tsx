import instance from "./instance";
import { IBooking } from "../interface/booking";
const getBooking = () => {
  return instance.get("/admin/bookings");
};

const addBooking = (booking: any) => {
  return instance.post("/booking", booking);
};
const updateBooking = (booking: any) => {
  return instance.patch("/booking/" + booking.id, booking);
};
const deleteBooking = (id: any) => {
  return instance.delete("/booking/" + id);
};

export { getBooking, addBooking, updateBooking, deleteBooking };
