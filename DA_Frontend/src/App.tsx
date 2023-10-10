import { BrowserRouter } from "react-router-dom";
import { Routes, Route } from "react-router";
import BaseLayout from "./pages/Layout/BaseLayout";
import HomePage from "./pages/UserSide/Home/HomePage";
import NewsPage from "./pages/UserSide/News/NewsPage";
import NewsDetailPage from "./pages/UserSide/News/NewsDetailPage";
import BookingPage from "./pages/UserSide/Booking/BookingPage";
import SigninPage from "./pages/UserSide/SigninAndSignup/SigninPage";
import SignupPage from "./pages/UserSide/SigninAndSignup/SignupPage";
import AdminLayout from "./pages/Layout/AdminLayout";
import Dashboard from "./pages/Admin/Dashboard";
import BookingAdmin from "./pages/Admin/BookingAdmin/BookingAdmin";
import StaffAdmin from "./pages/Admin/StaffAdmin/StaffAdmin";
import StaffAdminAdd from "./pages/Admin/StaffAdmin/StaffAdminAdd";
import StaffAdminEdit from "./pages/Admin/StaffAdmin/StaffAdminEdit";
import NewsAdmin from "./pages/Admin/NewsAdmin/NewsAdmin";
import NewsAdminAdd from "./pages/Admin/NewsAdmin/NewsAdminAdd";
import NewsAddminEdit from "./pages/Admin/NewsAdmin/NewsAddminEdit";
import { useEffect, useState } from "react";
import { INews } from "./interface/news";

import { IStaff } from "./interface/staff";
import { getNews, addNews, updateNews, deleteNews } from "./api/news";
import {
  getAllStaff,
  addStaff,
  updateStaff,
  deleteStaff,
  getAllStaffCategory,
  getOneStaffCategory,
  addStaffCategory,
  updateStaffCategory,
  deleteStaffCategory,
} from "./api/staffs";
import NotFound from "./pages/UserSide/NotFoundPage";
import NotFoundPage from "./pages/UserSide/NotFoundPage";
import ServicePage from "./pages/UserSide/Service/ServicePage";
import ContactPage from "./pages/UserSide/Contact/ContactPage";
import AboutUsPage from "./pages/UserSide/AboutUs/AboutUsPage";
import TeamPage from "./pages/UserSide/Team/TeamPage";
import BookingConfirmAdmin from "./pages/Admin/BookingAdmin/BookingConfirmAdmin";
import {
  addBooking,
  addBookingConfirm,
  addBookingHT,
  deleteBooking,
  deleteBookingConfirm,
  deleteBookingHT,
  getBooking,
  getBookingConfirm,
  getBookingHT,
  updateBooking,
  updateBookingConfirm,
  updateBookingHT,
} from "./api/booking";
import { IBooking } from "./interface/booking";
import BookingHtAdmin from "./pages/Admin/BookingAdmin/BookingHtAdmin";
import UserAdmin from "./pages/Admin/UsersAdmin/UserAdmin";
import UserAdminAdd from "./pages/Admin/UsersAdmin/UserAdminAdd";
import UserAdminEdit from "./pages/Admin/UsersAdmin/UserAdminEdit";
import { IUser } from "./interface/user";
import { addUsers, deleteUsers, getUsers, updateUsers ,logIn} from "./api/user";

function App() {
  const [staffs, setStaffs] = useState<IStaff[]>([]);
  const [news, setNews] = useState<INews[]>([]);
  const [booking, setBooking] = useState<IBooking[]>([]);
  const [bookingConf, setBookingConf] = useState<IBooking[]>([]);
  const [bookingHT, setBookingHT] = useState<IBooking[]>([]);
  const [users, setUsers] = useState<IUser[]>([]);
  const [mess,setMess]=useState();

  useEffect(() => {
    getAllStaff().then(({ data }) => setStaffs(data));
    getNews().then(({ data }) => setNews(data));
    getBooking().then(({ data }) => setBooking(data));
    getBookingConfirm().then(({ data }) => setBookingConf(data));
    getBookingHT().then(({ data }) => setBookingHT(data));
    getUsers().then(({ data }) => setUsers(data));
  }, []);

  const onHandleAddStaff = (staff: IStaff) => {
    addStaff(staff).then(() =>
      getAllStaff().then(({ data }) => setStaffs(data))
    );
  };

  const onHandleUpdateStaff = (staff: IStaff) => {
    updateStaff(staff).then(() =>
      getAllStaff().then(({ data }) => setStaffs(data))
    );
  };

  const onHandleRemoveStaff = (id: number) => {
    deleteStaff(id).then(() =>
      setStaffs(staffs.filter((item: IStaff) => item.id !== id))
    );
  };

  const onHandleAddNews = (newsItem: INews) => {
    addNews(newsItem).then(() => getNews().then(({ data }) => setNews(data)));
  };

  const onHandleUpdateNews = (newsItem: INews) => {
    updateNews(newsItem).then(() =>
      getNews().then(({ data }) => setNews(data))
    );
  };

  const onHandleRemoveNews = (id: number) => {
    deleteNews(id).then(() =>
      setNews(news.filter((item: INews) => item.id !== id))
    );
  };

  // Booking
  const onHandleBooking = (BookingItem: IBooking) => {
    addBooking(BookingItem).then(() =>
      getBooking().then(({ data }) => setBooking(data))
    );
  };

  const onHandleUpdateBooking = (BookingItem: IBooking) => {
    updateBooking(BookingItem).then(() =>
      getBooking().then(({ data }) => setBooking(data))
    );
  };

  const onHandleRemoveBooking = (id: any) => {
    deleteBooking(id).then(() =>
      setBooking(booking.filter((item: IBooking) => item.id !== id))
    );
  };
  // BookingConfirm

  const onHandleBookingConfirm = (BookingItem: IBooking) => {
    addBookingConfirm(BookingItem).then(() =>
      getBookingConfirm().then(({ data }) => setBookingConf(data))
    );
  };

  const onHandleUpdateBookingConfirm = (BookingItem: IBooking) => {
    updateBookingConfirm(BookingItem).then(() =>
      getBookingConfirm().then(({ data }) => setBookingConf(data))
    );
  };

  const onHandleRemoveBookingConfirm = (id: any) => {
    deleteBookingConfirm(id).then(() =>
      setBookingConf(bookingConf.filter((item: IBooking) => item.id !== id))
    );
  };

  // BookingHT
  const onHandleBookingHT = (BookingItem: IBooking) => {
    addBookingHT(BookingItem).then(() =>
      getBookingHT().then(({ data }) => setBookingHT(data))
    );
  };

  const onHandleUpdateBookingHT = (BookingItem: IBooking) => {
    updateBookingHT(BookingItem).then(() =>
      getBookingHT().then(({ data }) => setBookingHT(data))
    );
  };

  const onHandleRemoveBookingHT = (id: any) => {
    deleteBookingHT(id).then(() =>
      setBookingHT(bookingHT.filter((item: IBooking) => item.id !== id))
    );
  };

  // Users
  const onHandleAddUsers = (users: IUser) => {
    addUsers(users).then((res) =>
      getUsers().then(({ data }) => {
      setMess(res)
        setUsers(data);
      })
    );
  };

  const onHandleUpdateUsers = (users: IUser) => {
    updateUsers(users).then(() =>
      getUsers().then(({ data }) => setUsers(data))
    );
  };

  const onHandleRemoveUsers = (id: number) => {
    deleteUsers(id).then(() =>
      setUsers(users.filter((item: IUser) => item.id !== id))
    );
  };

  const onHandleAdd = (booking: IBooking) => {
    addBooking(booking).then(() => getBooking().then(({ data }) => setBooking(data)))
  }

  return (
    <div>
      <BrowserRouter>
        <Routes>
          {/* User Side */}
          <Route path="/" element={<BaseLayout />}>
            <Route index element={<HomePage onAddBooking={onHandleAdd} />} />
            {/* Booking Page */}
            <Route path="booking">
              <Route index element={<BookingPage onAddBooking={onHandleAdd} />} />
            </Route>

            {/* Contact Page */}
            <Route path="contact">
              <Route index element={<ContactPage />} />
            </Route>

            {/* News Page */}
            <Route path="news">
              <Route index element={<NewsPage />} />
              <Route path=":id" element={<NewsDetailPage />} />
            </Route>
            <Route path="service">
              <Route index element={<ServicePage />} />
            </Route>

            {/* About Page */}
            <Route path="about">
              <Route index element={<AboutUsPage />} />
            </Route>
            {/* Team Page */}
            <Route path="technicians">
              <Route index element={<TeamPage />} />
            </Route>
          </Route>
          {/* End User Side */}
          {/* Not Found Page */}
          <Route path="*" element={<NotFoundPage />} />

          {/* Admin Side */}
          <Route path="/admin" element={<AdminLayout />}>
            <Route index element={<Dashboard />} />

            {/* Booking Admin Page */}
            <Route path="booking">
              <Route
                index
                element={
                  <BookingAdmin
                    booking={booking}
                    onRemoveBooking={onHandleRemoveBooking}
                  />
                }
              />
            </Route>
            {/* Booking Confirm Admin Page */}
            <Route path="bookings">
              <Route
                index
                element={
                  <BookingConfirmAdmin
                    bookingConfirm={bookingConf}
                    onRemoveBookingConfirm={onHandleRemoveBookingConfirm}
                  />
                }
              />
            </Route>
            {/* Booking HT Admin Page */}
            <Route path="bookingHT">
              <Route index element={<BookingHtAdmin bookingHT={bookingHT} />} />
            </Route>
            {/*News Admin Page */}
            <Route path="news">
              <Route
                index
                element={
                  <NewsAdmin news={news} onRemoveNews={onHandleRemoveNews} />
                }
              />{" "}
              <Route
                path="add"
                element={<NewsAdminAdd onAddNews={onHandleAddNews} />}
              />
              <Route
                path=":id/edit"
                element={
                  <NewsAddminEdit
                    news={news}
                    onUpdateNews={onHandleUpdateNews}
                  />
                }
              />
            </Route>

            {/* Staff Admin Page */}
            <Route path="staffs">
              <Route
                index
                element={
                  <StaffAdmin
                    staffs={staffs}
                    onRemoveStaff={onHandleRemoveStaff}
                  />
                }
              />
              <Route
                path="add"
                element={<StaffAdminAdd onAddStaff={onHandleAddStaff} />}
              />
              <Route
                path=":id/edit"
                element={
                  <StaffAdminEdit
                    staffs={staffs}
                    onUpdateStaff={onHandleUpdateStaff}
                  />
                }
              />
            </Route>
            {/*User Admin Page */}
            <Route path="users">
              <Route
                index
                element={
                  <UserAdmin
                    users={users}
                    onRemoveUsers={onHandleRemoveUsers}
                  />
                }
              />{" "}
              <Route
                path="add"
                element={
                  <UserAdminAdd
                    onAddUsers={onHandleAddUsers}
                  
                  />
                }
              />
              <Route
                path=":id/edit"
                element={
                  <UserAdminEdit
                    users={users}
                    onUpdateUsers={onHandleUpdateUsers}
                  />
                }
              />
            </Route>
          </Route>
          {/* End Admin Side */}

          {/* Signin Page */}
          <Route path="signin">

            <Route index element={<SigninPage onSignin={logIn} />} />

          </Route>

          {/* Signup Page */}
          <Route path="signup">
            <Route
              index
              element={<SignupPage onAddUsers={onHandleAddUsers} mess={mess} />}
            />
          </Route>
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
