import ListAthletes from './components/ListAthletes.vue';
import ShowAthlete from './components/ShowAthlete.vue';
import UploadFile from './components/UploadFile.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: UploadFile
    },
    {
        name: 'listAthletes',
        path: '/athletes',
        component: ListAthletes
    },
    {
        name: 'showAthlete',
        path: '/athletes/:id',
        component: ShowAthlete
    }
];
