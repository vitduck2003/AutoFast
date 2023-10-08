import instance from "./instance";
import { IUser } from "../interface/user";
const getUsers = () => {
  return instance.get("/users");
};

const addUsers = (users: IUser) => {
  return instance.post("/register", users);
};
const updateUsers = (users: IUser) => {
  return instance.patch("/users/" + users.id, users);
};
const deleteUsers = (id: number) => {
  return instance.delete("/users/" + id);
};
export { getUsers, addUsers, updateUsers, deleteUsers };
