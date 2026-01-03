@extends('layouts.app')

@section('title', 'Ajouter un Film')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-plus-circle me-3"></i>Ajouter un Film
    </h1>
    <p class="page-subtitle">Ajoutez un nouveau film à votre médiathèque</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-modern">
            <form id="film-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="titre" class="form-label-modern">
                                <i class="fas fa-film me-2"></i>Titre *
                            </label>
                            <input type="text" class="form-control-modern" id="titre" name="titre" required>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="realisateur" class="form-label-modern">
                                <i class="fas fa-user-tie me-2"></i>Réalisateur *
                            </label>
                            <input type="text" class="form-control-modern" id="realisateur" name="realisateur" required>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="pays" class="form-label-modern">
                                <i class="fas fa-flag me-2"></i>Pays *
                            </label>
                            <input type="text" class="form-control-modern" id="pays" name="pays" required>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="date_sortie" class="form-label-modern">
                                <i class="fas fa-calendar me-2"></i>Date de sortie *
                            </label>
                            <input type="date" class="form-control-modern" id="date_sortie" name="date_sortie" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="poster" class="form-label-modern">
                                <i class="fas fa-image me-2"></i>Poster (URL) *
                            </label>
                            <input type="url" class="form-control-modern" id="poster" name="poster" placeholder="https://exemple.com/poster.jpg" required>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="duree" class="form-label-modern">
                                <i class="fas fa-clock me-2"></i>Durée (minutes) *
                            </label>
                            <input type="number" class="form-control-modern" id="duree" name="duree" min="1" max="500" required>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="langue" class="form-label-modern">
                                <i class="fas fa-language me-2"></i>Langue *
                            </label>
                            <select class="form-control-modern" id="langue" name="langue" required>
                                <option value="">Sélectionnez une langue</option>
                                <option value="Français">Français</option>
                                <option value="Anglais">Anglais</option>
                                <option value="Espagnol">Espagnol</option>
                                <option value="Italien">Italien</option>
                                <option value="Allemand">Allemand</option>
                                <option value="Japonais">Japonais</option>
                                <option value="Coréen">Coréen</option>
                                <option value="Chinois">Chinois</option>
                                <option value="Arabe">Arabe</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="genre" class="form-label-modern">
                                <i class="fas fa-tags me-2"></i>Genre
                            </label>
                            <select class="form-control-modern" id="genre" name="genre">
                                <option value="">Sélectionnez un genre</option>
                                <option value="Action">Action</option>
                                <option value="Aventure">Aventure</option>
                                <option value="Comédie">Comédie</option>
                                <option value="Drame">Drame</option>
                                <option value="Horreur">Horreur</option>
                                <option value="Science-fiction">Science-fiction</option>
                                <option value="Thriller">Thriller</option>
                                <option value="Romance">Romance</option>
                                <option value="Documentaire">Documentaire</option>
                                <option value="Animation">Animation</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group-modern">
                    <label for="description" class="form-label-modern">
                        <i class="fas fa-align-left me-2"></i>Description *
                    </label>
                    <textarea class="form-control-modern" id="description" name="description" rows="4" placeholder="Décrivez l'intrigue du film..." required></textarea>
                </div>
                
                <div class="d-flex gap-3 justify-content-center">
                    <button type="submit" class="btn btn-success-modern btn-modern" id="submit-btn">
                        <i class="fas fa-save"></i>
                        <span>Ajouter le film</span>
                    </button>
                    <a href="{{ route('films.liste') }}" class="btn btn-modern btn-accent-modern">
                        <i class="fas fa-times"></i>
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="errors" class="alert alert-danger-modern alert-modern" style="display: none;">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <ul id="error-list" class="mb-0 mt-2"></ul>
</div>

<script>
document.getElementById('film-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submit-btn');
    const originalText = submitBtn.innerHTML;
    
    // Animation de chargement
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Ajout en cours...';
    submitBtn.disabled = true;
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    try {
        const response = await fetch('/api/films', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const result = await response.json();
        
        if (result.success) {
            // Animation de succès
            submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Film ajouté !';
            submitBtn.style.background = 'var(--accent-color)';
            
            setTimeout(() => {
                window.location.href = '/films/liste';
            }, 1000);
        } else {
            showErrors(result.errors || [result.message]);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    } catch (error) {
        console.error('Erreur:', error);
        showErrors(['Une erreur est survenue lors de la soumission du formulaire']);
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
});

function showErrors(errors) {
    const errorDiv = document.getElementById('errors');
    const errorList = document.getElementById('error-list');
    
    errorList.innerHTML = '';
    
    if (Array.isArray(errors)) {
        errors.forEach(error => {
            const li = document.createElement('li');
            li.textContent = error;
            errorList.appendChild(li);
        });
    } else {
        Object.values(errors).flat().forEach(error => {
            const li = document.createElement('li');
            li.textContent = error;
            errorList.appendChild(li);
        });
    }
    
    errorDiv.style.display = 'block';
    errorDiv.scrollIntoView({ behavior: 'smooth' });
}

// Validation en temps réel
document.querySelectorAll('.form-control-modern').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.hasAttribute('required') && !this.value.trim()) {
            this.style.borderColor = 'var(--danger-color)';
        } else {
            this.style.borderColor = 'var(--border-color)';
        }
    });
    
    input.addEventListener('input', function() {
        if (this.style.borderColor === 'rgb(239, 68, 68)') {
            this.style.borderColor = 'var(--border-color)';
        }
    });
});
</script>
@endsection