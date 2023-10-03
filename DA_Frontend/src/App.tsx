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
import ReviewPage from "./pages/UserSide/Reviews/ReviewPage";

function App() {
  const [staffs, setStaffs] = useState<IStaff[]>([]);
  const [news, setNews] = useState<INews[]>([]);

  useEffect(() => {
    getAllStaff().then(({ data }) => setStaffs(data));
    getNews().then(({ data }) => setNews(data));
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

  return (
    <div>
      <BrowserRouter>
        <Routes>
          {/* User Side */}
          <Route path="/" element={<BaseLayout />}>
            <Route index element={<HomePage />} />
            {/* Booking Page */}
            <Route path="booking">
              <Route index element={<BookingPage />} />
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
<Route path='*' element={<NotFoundPage />} />

          {/* Admin Side */}
          <Route path="/admin" element={<AdminLayout />}>
            <Route index element={<Dashboard />} />

            {/* Booking Admin Page */}
            <Route path="booking">
              <Route index element={<BookingAdmin />} />
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
          </Route>
          {/* End Admin Side */}

          {/* Signin Page */}
          <Route path="signin">
            <Route index element={<SigninPage />} />
          </Route>

          {/* Signup Page */}
          <Route path="signup">
            <Route index element={<SignupPage />} />
          </Route>

          
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
