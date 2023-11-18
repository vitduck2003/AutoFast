import instance from "./instance";
import { IReview } from "../interface/reviews";
const getReviewByUser = (id: number) => {
    return instance.get(`/client/review/user/${id}`);
};

const addReviews = (reviews: IReview) => {
  return instance.post("/client/reviews", reviews);
};
const updateReviews = (reviews: IReview) => {
  return instance.patch("/client/reviews/" + reviews.id, reviews);
};
const deleteReviews = (id: number) => {
  return instance.delete("/client/reviews/" + id);
};
export { getReviewByUser, addReviews, updateReviews, deleteReviews };
