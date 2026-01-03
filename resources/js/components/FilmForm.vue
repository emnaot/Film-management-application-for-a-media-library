<template>
  <div class="container mt-4">
    <h1 class="mb-4">{{ isEdit ? 'Modifier le Film' : 'Ajouter un Film' }}</h1>
    
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="titre" class="form-label">Titre *</label>
            <input 
              type="text" 
              class="form-control" 
              id="titre" 
              v-model="form.titre" 
              required
            >
          </div>
          
          <div class="mb-3">
            <label for="realisateur" class="form-label">Réalisateur *</label>
            <input 
              type="text" 
              class="form-control" 
              id="realisateur" 
              v-model="form.realisateur" 
              required
            >
          </div>
          
          <div class="mb-3">
            <label for="pays" class="form-label">Pays *</label>
            <input 
              type="text" 
              class="form-control" 
              id="pays" 
              v-model="form.pays" 
              required
            >
          </div>
          
          <div class="mb-3">
            <label for="date_sortie" class="form-label">Date de sortie *</label>
            <input 
              type="date" 
              class="form-control" 
              id="date_sortie" 
              v-model="form.date_sortie" 
              required
            >
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="mb-3">
            <label for="poster" class="form-label">Poster (URL) *</label>
            <input 
              type="text" 
              class="form-control" 
              id="poster" 
              v-model="form.poster" 
              required
            >
          </div>
          
          <div class="mb-3">
            <label for="duree" class="form-label">Durée (minutes) *</label>
            <input 
              type="number" 
              class="form-control" 
              id="duree" 
              v-model="form.duree" 
              min="1" 
              required
            >
          </div>
          
          <div class="mb-3">
            <label for="langue" class="form-label">Langue *</label>
            <input 
              type="text" 
              class="form-control" 
              id="langue" 
              v-model="form.langue" 
              required
            >
          </div>
        </div>
      </div>
      
      <div class="mb-3">
        <label for="description" class="form-label">Description *</label>
        <textarea 
          class="form-control" 
          id="description" 
          rows="4" 
          v-model="form.description" 
          required
        ></textarea>
      </div>
      
      <div class="mb-3">
        <button type="submit" class="btn btn-success me-2">
          {{ isEdit ? 'Mettre à jour' : 'Ajouter' }}
        </button>
        <a href="/films/liste" class="btn btn-secondary">Annuler</a>
      </div>
    </form>
    
    <div v-if="errors.length > 0" class="alert alert-danger">
      <ul class="mb-0">
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FilmForm',
  props: {
    filmId: {
      type: String,
      default: null
    }
  },
  data() {
    return {
      form: {
        titre: '',
        realisateur: '',
        pays: '',
        date_sortie: '',
        description: '',
        poster: '',
        duree: '',
        langue: ''
      },
      errors: [],
      isEdit: false
    }
  },
  mounted() {
    if (this.filmId) {
      this.isEdit = true;
      this.fetchFilm();
    }
  },
  methods: {
    async fetchFilm() {
      try {
        const response = await fetch(`/api/films/${this.filmId}`);
        const data = await response.json();
        if (data.success) {
          this.form = { ...data.data };
        }
      } catch (error) {
        console.error('Erreur lors du chargement du film:', error);
      }
    },
    async submitForm() {
      this.errors = [];
      
      try {
        const url = this.isEdit ? `/api/films/${this.filmId}` : '/api/films';
        const method = this.isEdit ? 'PUT' : 'POST';
        
        const response = await fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.form)
        });
        
        const data = await response.json();
        
        if (data.success) {
          alert(data.message);
          window.location.href = '/films/liste';
        } else {
          if (data.errors) {
            this.errors = Object.values(data.errors).flat();
          } else {
            this.errors = [data.message];
          }
        }
      } catch (error) {
        console.error('Erreur lors de la soumission:', error);
        this.errors = ['Une erreur est survenue lors de la soumission du formulaire'];
      }
    }
  }
}
</script>