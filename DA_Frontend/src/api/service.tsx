import instance from "./instance";
import { IService } from "../interface/service";
const getService = () => {
  return instance.get("/service");
};
const addService = (service: IService) => {
  return instance.post("/service", service);
};
const updateService = (service: IService) => {
  return instance.patch("/service/" + service.id, service);
};
const deleteService= (id: IService) => {
  return instance.delete("/service/" + id);
};

export { getService, addService, updateService, deleteService,};