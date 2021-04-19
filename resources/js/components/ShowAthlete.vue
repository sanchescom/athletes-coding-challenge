<template>
    <div>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">{{ athlete.name }}</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <tbody>
                    <tr>
                        <td class="w-25">Age</td>
                        <td class="w-75">{{ athlete.age }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{ athlete.city }}</td>
                    </tr>
                    <tr>
                        <td>Province</td>
                        <td>{{ athlete.province }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ athlete.country }}</td>
                    </tr>
                    </tbody>
                </table>
                <button class="btn btn-danger" @click="deleteAthlete(athlete.id)">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
import http from "../http-common";
import DeleteService from "../services/DeleteAthleteService";

export default {
    data() {
        return {
            athlete: {}
        }
    },
    created() {
        http
            .get(`/api/athletes/${this.$route.params.id}`)
            .then((response) => {
                this.athlete = response.data.data;
            });
    },
    methods: {
        deleteAthlete(id) {
            DeleteService
                .delete(id)
                .then(response => {
                    this.$router.push({name: 'listAthletes'})
                });
        }
    }
}
</script>
