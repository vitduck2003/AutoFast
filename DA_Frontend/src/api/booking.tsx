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
// Booking đã xác nhận
const getBookingConfirm = () => {
  return instance.get("/bookings");
};

const addBookingConfirm = (bookings: IBooking) => {
  return instance.post("/bookings", bookings);
};
const updateBookingConfirm = (bookings: IBooking) => {
  return instance.patch("/bookings/" + bookings.id, bookings);
};
const deleteBookingConfirm= (id: IBooking) => {
  return instance.delete("/bookings/" + id);
};

// Booking đã hoàn thành
const getBookingHT = () => {
  return instance.get("/bookingHT");
};

const addBookingHT = (booking: IBooking) => {
  return instance.post("/bookingHT", booking);
};
const updateBookingHT = (booking: IBooking) => {
  return instance.patch("/bookingHT/" + booking.id, booking);
};
const deleteBookingHT= (id: IBooking) => {
  return instance.delete("/bookingHT/" + id);
};
export { getBooking, addBooking, updateBooking, deleteBooking, getBookingConfirm, addBookingConfirm, updateBookingConfirm, deleteBookingConfirm, getBookingHT, addBookingHT, updateBookingHT, deleteBookingHT };