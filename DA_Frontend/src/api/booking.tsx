import instance from "./instance";
import { IBooking } from "../interface/booking";
const getBooking = () => {
  return instance.get("/booking");
};

const addBooking = (booking: IBooking) => {
  return instance.post("/booking", booking);
};
const updateBooking = (booking: IBooking) => {
  return instance.patch("/booking/" + booking.id, booking);
};
const deleteBooking= (id: IBooking) => {
  return instance.delete("/booking/" + id);
};

export { getBooking, addBooking, updateBooking, deleteBooking,};