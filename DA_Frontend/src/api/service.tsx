import instance from "./instance";
import { IService } from "../interface/service";
const getService = () => {
  return instance.get("/admin/services");
};
const addService = (service: IService) => {
  return instance.post("/service-item", service);
};
const updateService = (service: IService) => {
  return instance.patch("/service-item/" + service.id, service);
};
const deleteService= (id: IService) => {
  return instance.delete("/service-item/" + id);
};

export { getService, addService, updateService, deleteService,};