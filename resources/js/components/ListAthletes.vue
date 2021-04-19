<template>
    <div>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Athletes</h1>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="w-50">Name</th>
                <th class="w-25 text-center">Age</th>
                <th class="w-50 text-center">Location</th>
                <th class="w-25">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="athlete in athletes" :key="athlete.id">
                <td>{{ athlete.name }}</td>
                <td class="text-center">{{ athlete.age }}</td>
                <td class="text-center">{{ athlete.location }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'showAthlete', params: { id: athlete.id }}" class="btn btn-primary">
                            View
                        </router-link>
                        <button class="btn btn-danger" @click="deleteAthlete(athlete.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import http from "../http-common";
import DeleteService from "../services/DeleteAthleteService";

export default {
    data() {
        return {
            athletes: []
        }
    },
    created() {
        http
            .get('/api/athletes')
            .then(response => {
                this.athletes = response.data.data;
            });
    },
    methods: {
        deleteAthlete(id) {
            DeleteService.delete(id).then(response => {
                let i = this.athletes.map(item => item.id).indexOf(id);
                this.athletes.splice(i, 1)
            });
        }
    }
}
</script>
