import instance from "./instance";
import { IService, ISeviceItem } from "../interface/service";
const getService = () => {
  return instance.get("/admin/services");
};
const addService = (service: IService) => {
  return instance.post("/service", service);
};
const updateService = (service: IService) => {
  return instance.patch("/service" + service.id, service);
};
const deleteService= (id: any) => {
  return instance.delete(`/service/${id}`);
};

const getServiceItem = () => {
  return instance.get("/client/service-item");
};
const addServiceItem = (service: ISeviceItem) => {
  return instance.post("/serviceitem", service);
};
const updateServiceItem = (service: ISeviceItem) => {
  return instance.patch(`/serviceitem/${service.id}/` , service);
};
const deleteServiceItem= (id: any) => {
  return instance.delete(`/serviceitem${id}` );
};


export { getService, addService, updateService, deleteService, getServiceItem, addServiceItem, updateServiceItem, deleteServiceItem};