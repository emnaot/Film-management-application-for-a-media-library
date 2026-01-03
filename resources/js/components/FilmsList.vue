<template>
  <div class="container mt-4">
    <h1 class="mb-4">Liste des Films</h1>
    
    <div class="row">
      <div class="col-md-4 mb-3" v-for="film in films" :key="film.id">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">{{ film.titre }}</h5>
            <p class="card-text">
              <strong>Réalisateur:</strong> {{ film.realisateur }}<br>
              <strong>Pays:</strong> {{ film.pays }}<br>
              <strong>Date de sortie:</strong> {{ formatDate(film.date_sortie) }}<br>
              <strong>Durée:</strong> {{ film.duree }} minutes<br>
              <strong>Langue:</strong> {{ film.langue }}
            </p>
            <p class="card-text">{{ film.description }}</p>
            <div class="btn-group" role="group">
              <button @click="editFilm(film)" class="btn btn-primary btn-sm">Modifier</button>
              <button @click="deleteFilm(film.id)" class="btn btn-danger btn-sm">Supprimer</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="films.length === 0" class="text-center">
      <p>Aucun film trouvé.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FilmsList',
  data() {
    return {
      films: []
    }
  },
  mounted() {
    this.fetchFilms();
  },
  methods: {
    async fetchFilms() {
      try {
        const response = await fetch('/api/films');
        const data = await response.json();
        if (data.success) {
          this.films = data.data;
        }
      } catch (error) {
        console.error('Erreur lors du chargement des films:', error);
      }
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString('fr-FR');
    },
    editFilm(film) {
      // Rediriger vers la page de modification
      window.location.href = `/films/modifier/${film.id}`;
    },
    async deleteFilm(filmId) {
      if (confirm('Êtes-vous sûr de vouloir supprimer ce film ?')) {
        try {
          const response = await fetch(`/api/films/${filmId}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          });
          const data = await response.json();
          if (data.success) {
            this.fetchFilms(); // Recharger la liste
            alert('Film supprimé avec succès');
          }
        } catch (error) {
          console.error('Erreur lors de la suppression:', error);
          alert('Erreur lors de la suppression du film');
        }
      }
    }
  }
}
</script>