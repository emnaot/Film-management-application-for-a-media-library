import './bootstrap';
import { createApp } from 'vue';

// Import des composants Vue
import FilmsList from './components/FilmsList.vue';
import FilmForm from './components/FilmForm.vue';

const app = createApp({});

// Enregistrement des composants
app.component('films-list', FilmsList);
app.component('film-form', FilmForm);

app.mount('#app');
