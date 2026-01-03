@extends('layouts.app')

@section('title', 'Modifier un Film')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-edit me-3"></i>Modifier le Film
    </h1>
    <p class="page-subtitle">Modifiez les informations du film</p>
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
                            <input type="url" class="form-control-modern" id="poster" name="poster" required>
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
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label-modern mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Film ID
                                </label>
                                <span class="badge badge-modern badge-primary" id="film-id-badge">
                                    #<span id="film-id-display">-</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group-modern">
                    <label for="description" class="form-label-modern">
                        <i class="fas fa-align-left me-2"></i>Description *
                    </label>
                    <textarea class="form-control-modern" id="description" name="description" rows="4" required></textarea>
                </div>
                
                <div class="d-flex gap-3 justify-content-center">
                    <button type="submit" class="btn btn-success-modern btn-modern" id="submit-btn">
                        <i class="fas fa-save"></i>
                        <span>Mettre à jour</span>
                    </button>
                    <a href="{{ route('films.liste') }}" class="btn btn-modern btn-accent-modern">
                        <i class="fas fa-arrow-left"></i>
                        Retour à la liste
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
// Récupérer l'ID du film depuis l'URL
const urlParts = window.location.pathname.split('/');
const filmId = urlParts[urlParts.length - 1];

document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded, film ID:', filmId);
    // Charger les données immédiatement sans écran de chargement
    loadFilm();
});

async function loadFilm() {
    try {
        console.log('Loading film with ID:', filmId);
        
        // Vérifier que l'ID est valide
        if (!filmId || filmId === 'modifier' || isNaN(filmId)) {
            console.error('ID de film invalide:', filmId);
            return;
        }
        
        const response = await fetch(`/api/films/${filmId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            console.error('Erreur HTTP:', response.status);
            return;
        }
        
        const data = await response.json();
        console.log('API Response:', data);
        
        if (data.success && data.data) {
            const film = data.data;
            
            // Remplir le formulaire avec les données
            document.getElementById('titre').value = film.titre || '';
            document.getElementById('realisateur').value = film.realisateur || '';
            document.getElementById('pays').value = film.pays || '';
            document.getElementById('date_sortie').value = film.date_sortie ? film.date_sortie.split('T')[0] : '';
            document.getElementById('poster').value = film.poster || '';
            document.getElementById('duree').value = film.duree || '';
            document.getElementById('langue').value = film.langue || '';
            document.getElementById('description').value = film.description || '';
            document.getElementById('film-id-display').textContent = film.id;
            
            console.log('Film data loaded successfully');
        }
        
    } catch (error) {
        console.error('Erreur lors du chargement du film:', error);
        // En cas d'erreur, on laisse le formulaire vide mais fonctionnel
    }
}

document.getElementById('film-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submit-btn');
    const originalText = submitBtn.innerHTML;
    
    // Animation de chargement
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mise à jour...';
    submitBtn.disabled = true;
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    console.log('Submitting data:', data);
    
    try {
        const response = await fetch(`/api/films/${filmId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });
        
        console.log('Update response status:', response.status);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.log('Update error response:', errorText);
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const result = await response.json();
        console.log('Update result:', result);
        
        if (result.success) {
            // Animation de succès
            submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Mis à jour !';
            submitBtn.style.background = 'var(--accent-color)';
            
            showNotification('Film mis à jour avec succès !', 'success');
            
            setTimeout(() => {
                window.location.href = '/films/liste';
            }, 1500);
        } else {
            showErrors(result.errors || [result.message]);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    } catch (error) {
        console.error('Erreur lors de la mise à jour:', error);
        showErrors(['Une erreur est survenue lors de la mise à jour: ' + error.message]);
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

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'}-modern alert-modern position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
        ${message}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
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
        if (this.style.borderColor === 'rgb(220, 38, 38)') {
            this.style.borderColor = 'var(--border-color)';
        }
    });
});
</script>
@endsection