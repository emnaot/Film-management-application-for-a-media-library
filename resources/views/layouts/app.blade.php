<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Médiathèque Films')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0891b2;
            --primary-dark: #0e7490;
            --primary-light: #67e8f9;
            --secondary-color: #f0f9ff;
            --accent-color: #f59e0b;
            --accent-dark: #d97706;
            --success-color: #059669;
            --danger-color: #dc2626;
            --warning-color: #f59e0b;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --gradient-primary: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
            --gradient-accent: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --gradient-success: linear-gradient(135deg, #059669 0%, #047857 100%);
            --gradient-danger: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0891b2 0%, #67e8f9 50%, #f0f9ff 100%);
            min-height: 100vh;
            color: var(--text-primary);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-primary) !important;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 8px 16px !important;
            margin: 0 4px;
        }

        .nav-link:hover {
            background: var(--gradient-primary);
            color: white !important;
            transform: translateY(-1px);
        }

        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            margin: 2rem auto;
            padding: 2rem;
            max-width: 1200px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .search-filter-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #bae6fd;
        }

        .search-input {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
            outline: none;
        }

        .btn-modern {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-modern {
            background: var(--gradient-primary);
            color: white;
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(8, 145, 178, 0.3);
            color: white;
        }

        .btn-success-modern {
            background: var(--gradient-success);
            color: white;
        }

        .btn-success-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(5, 150, 105, 0.3);
            color: white;
        }

        .btn-danger-modern {
            background: var(--gradient-danger);
            color: white;
        }

        .btn-danger-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
            color: white;
        }

        .btn-accent-modern {
            background: var(--gradient-accent);
            color: white;
        }

        .btn-accent-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
            color: white;
        }

        .table-modern {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: none;
        }

        .table-modern thead {
            background: var(--gradient-primary);
            color: white;
        }

        .table-modern thead th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table-modern tbody tr:hover {
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.05) 0%, rgba(103, 232, 249, 0.05) 100%);
            transform: scale(1.01);
        }

        .table-modern tbody td {
            padding: 1rem;
            border: none;
            vertical-align: middle;
        }

        .badge-modern {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge-primary {
            background: var(--gradient-primary);
            color: white;
        }

        .badge-accent {
            background: var(--gradient-accent);
            color: white;
        }

        .badge-success {
            background: var(--gradient-success);
            color: white;
        }

        .badge-secondary {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
        }

        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid var(--border-color);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
            opacity: 0.5;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .form-modern {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid #bae6fd;
        }

        .form-group-modern {
            margin-bottom: 1.5rem;
        }

        .form-label-modern {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control-modern {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            width: 100%;
        }

        .form-control-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
            outline: none;
        }

        .alert-modern {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-danger-modern {
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            border-left: 4px solid var(--danger-color);
        }

        .alert-success-modern {
            background: rgba(5, 150, 105, 0.1);
            color: #059669;
            border-left: 4px solid var(--success-color);
        }

        /* Animations et effets */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(8, 145, 178, 0.15);
        }

        .gradient-text {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-border {
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box, var(--gradient-primary) border-box;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 1rem;
                padding: 1rem;
                border-radius: 15px;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .table-responsive {
                border-radius: 15px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-film me-2"></i>Médiathèque Films
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ route('films.liste') }}">
                        <i class="fas fa-list me-1"></i>Liste des Films
                    </a>
                    <a class="nav-link" href="{{ route('films.ajouter') }}">
                        <i class="fas fa-plus me-1"></i>Ajouter un Film
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="main-container">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>