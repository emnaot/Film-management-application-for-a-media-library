@extends('layouts.app')

@section('title', 'Liste des Films')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-film me-3"></i>Liste des Films
    </h1>
    <p class="page-subtitle">Découvrez notre collection de films</p>
</div>

<!-- Section de recherche et filtres -->
<div class="search-filter-section">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="position-relative">
                <i class="fas fa-search position-absolute" style="left: 16px; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input 
                    type="text" 
                    id="searchInput" 
                    class="search-input w-100" 
                    placeholder="Rechercher par titre, réalisateur, pays..."
                    style="padding-left: 45px;"
                >
            </div>
        </div>
        <div class="col-md-3">
            <select id="languageFilter" class="search-input w-100">
                <option value="">Toutes les langues</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="sortBy" class="search-input w-100">
                <option value="titre">Trier par titre</option>
                <option value="date_sortie">Trier par date</option>
                <option value="duree">Trier par durée</option>
                <option value="realisateur">Trier par réalisateur</option>
            </select>
        </div>
    </div>
</div>

<!-- Bouton d'ajout -->
<div class="text-end mb-3">
    <a href="{{ route('films.ajouter') }}" class="btn btn-primary-modern btn-modern">
        <i class="fas fa-plus"></i>
        Ajouter un nouveau film
    </a>
</div>

<!-- Loading -->
<div id="loading" class="text-center py-5">
    <div class="loading-spinner mx-auto mb-3"></div>
    <p class="text-muted">Chargement des films...</p>
</div>

<!-- Tableau des films -->
<div id="films-table-container" style="display: none;">
    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag me-2"></i>ID</th>
                    <th><i class="fas fa-film me-2"></i>Titre</th>
                    <th><i class="fas fa-user-tie me-2"></i>Réalisateur</th>
                    <th><i class="fas fa-flag me-2"></i>Pays</th>
                    <th><i class="fas fa-calendar me-2"></i>Date de sortie</th>
                    <th><i class="fas fa-clock me-2"></i>Durée</th>
                    <th><i class="fas fa-language me-2"></i>Langue</th>
                    <th><i class="fas fa-cogs me-2"></i>Actions</th>
                </tr>
            </thead>
            <tbody id="films-tbody">
                <!-- Les films seront chargés ici -->
            </tbody>
        </table>
    </div>
    
    <!-- Pagination info -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <span class="text-muted">
                Affichage de <span id="showing-count">0</span> film(s) sur <span id="total-count">0</span>
            </span>
        </div>
        <div>
            <span class="badge badge-modern badge-primary">
                <i class="fas fa-database me-1"></i>
                <span id="filtered-count">0</span> résultat(s)
            </span>
        </div>
    </div>
</div>

<!-- État vide -->
<div id="no-films" class="empty-state" style="display: none;">
    <i class="fas fa-film-slash"></i>
    <h3>Aucun film trouvé</h3>
    <p>Aucun film ne correspond à vos critères de recherche.</p>
    <a href="{{ route('films.ajouter') }}" class="btn btn-primary-modern btn-modern mt-3">
        <i class="fas fa-plus"></i>
        Ajouter le premier film
    </a>
</div>

<script>
let allFilms = [];
let filteredFilms = [];

document.addEventListener('DOMContentLoaded', function() {
    loadFilms();
    setupEventListeners();
});

function setupEventListeners() {
    document.getElementById('searchInput').addEventListener('input', filterFilms);
    document.getElementById('languageFilter').addEventListener('change', filterFilms);
    document.getElementById('sortBy').addEventListener('change', sortAndDisplayFilms);
}

async function loadFilms() {
    try {
        const response = await fetch('/api/films');
        const data = await response.json();
        
        const loading = document.getElementById('loading');
        const tableContainer = document.getElementById('films-table-container');
        const noFilms = document.getElementById('no-films');
        
        loading.style.display = 'none';
        
        if (data.success && data.data.length > 0) {
            allFilms = data.data;
            filteredFilms = [...allFilms];
            
            populateLanguageFilter();
            sortAndDisplayFilms();
            
            tableContainer.style.display = 'block';
            updateCounts();
        } else {
            noFilms.style.display = 'block';
        }
    } catch (error) {
        console.error('Erreur lors du chargement des films:', error);
        document.getElementById('loading').innerHTML = `
            <div class="alert alert-danger-modern alert-modern">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Erreur lors du chargement des films. Veuillez réessayer.
            </div>
        `;
    }
}

function populateLanguageFilter() {
    const languages = [...new Set(allFilms.map(film => film.langue))].sort();
    const languageFilter = document.getElementById('languageFilter');
    
    languages.forEach(langue => {
        const option = document.createElement('option');
        option.value = langue;
        option.textContent = langue;
        languageFilter.appendChild(option);
    });
}

function filterFilms() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const selectedLanguage = document.getElementById('languageFilter').value;
    
    filteredFilms = allFilms.filter(film => {
        const matchesSearch = !searchTerm || 
            film.titre.toLowerCase().includes(searchTerm) ||
            film.realisateur.toLowerCase().includes(searchTerm) ||
            film.pays.toLowerCase().includes(searchTerm) ||
            film.description.toLowerCase().includes(searchTerm);
            
        const matchesLanguage = !selectedLanguage || film.langue === selectedLanguage;
        
        return matchesSearch && matchesLanguage;
    });
    
    sortAndDisplayFilms();
    updateCounts();
}

function sortAndDisplayFilms() {
    const sortBy = document.getElementById('sortBy').value;
    
    filteredFilms.sort((a, b) => {
        if (sortBy === 'date_sortie') {
            return new Date(b.date_sortie) - new Date(a.date_sortie);
        } else if (sortBy === 'duree') {
            return b.duree - a.duree;
        } else {
            return a[sortBy].localeCompare(b[sortBy]);
        }
    });
    
    displayFilms();
}

function displayFilms() {
    const tbody = document.getElementById('films-tbody');
    const noFilms = document.getElementById('no-films');
    const tableContainer = document.getElementById('films-table-container');
    
    if (filteredFilms.length === 0) {
        tableContainer.style.display = 'none';
        noFilms.style.display = 'block';
        return;
    }
    
    noFilms.style.display = 'none';
    tableContainer.style.display = 'block';
    
    tbody.innerHTML = '';
    
    filteredFilms.forEach(film => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><span class="badge badge-modern badge-secondary">#${film.id}</span></td>
            <td>
                <div class="fw-bold gradient-text">${film.titre}</div>
                <small class="text-muted">${film.description.substring(0, 50)}...</small>
            </td>
            <td>${film.realisateur}</td>
            <td>
                <span class="badge badge-modern badge-primary">
                    ${film.pays}
                </span>
            </td>
            <td>${formatDate(film.date_sortie)}</td>
            <td>
                <span class="badge badge-modern badge-accent">
                    <i class="fas fa-clock me-1"></i>${film.duree} min
                </span>
            </td>
            <td>${film.langue}</td>
            <td>
                <div class="action-buttons">
                    <a href="/films/modifier/${film.id}" class="btn btn-accent-modern btn-sm" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button onclick="deleteFilm(${film.id})" class="btn btn-danger-modern btn-sm" title="Supprimer">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function updateCounts() {
    document.getElementById('total-count').textContent = allFilms.length;
    document.getElementById('showing-count').textContent = filteredFilms.length;
    document.getElementById('filtered-count').textContent = filteredFilms.length;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

async function deleteFilm(filmId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce film ? Cette action est irréversible.')) {
        try {
            const response = await fetch(`/api/films/${filmId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            const data = await response.json();
            if (data.success) {
                // Animation de suppression
                const row = event.target.closest('tr');
                row.style.transition = 'all 0.3s ease';
                row.style.transform = 'translateX(100%)';
                row.style.opacity = '0';
                
                setTimeout(() => {
                    loadFilms(); // Recharger la liste
                }, 300);
                
                // Notification de succès
                showNotification('Film supprimé avec succès', 'success');
            }
        } catch (error) {
            console.error('Erreur lors de la suppression:', error);
            showNotification('Erreur lors de la suppression du film', 'error');
        }
    }
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
</script>
@endsection