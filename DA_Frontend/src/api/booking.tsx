import instance from "./instance";
import { IBooking } from "../interface/booking";
const getBooking = () => {
  return instance.get("/booking");
};

const addBooking = (booking: any) => {
  return instance.post("/bookings", booking);
};
const updateBooking = (booking: any) => {
  return instance.patch("/booking/" + booking.id, booking);
};
const deleteBooking= (id: any) => {
  return instance.delete("/booking/" + id);
};

export { getBooking, addBooking, updateBooking, deleteBooking,};