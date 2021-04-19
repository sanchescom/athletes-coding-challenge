import http from "../http-common";

class DeleteAthleteService {
    delete(id) {
        if(confirm("Do you really want to delete?")) {
            return http.delete(`/api/athletes/${id}`);
        }
    }
}

export default new DeleteAthleteService();
