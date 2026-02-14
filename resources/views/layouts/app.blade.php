<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EcoCarFinder - SPK Kendaraan Ramah Lingkungan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #10b981;
            --secondary-color: #059669;
            --dark-color: #1f2937;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            padding: 20px 0;
            z-index: 1050;
        }
        
        .sidebar .brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }
        
        .sidebar .brand h4 {
            margin: 0;
            font-weight: bold;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .table thead {
            background-color: #f9fafb;
        }
        
        .badge-rank {
            font-size: 1.2rem;
            padding: 10px 15px;
        }

        /* RESPONSIVE SIDEBAR */
        @media (max-width: 768px) {
        .sidebar {
            left: -250px;
            transition: all 0.3s ease;
        }

        .sidebar.show {
            left: 0;
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1040;
        }

        .sidebar.show ~ .sidebar-overlay {
            display: block;
        }

    }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-leaf fa-2x mb-2"></i>
            <h4>EcoCarFinder</h4>
            <small>Green Vehicle System</small>
        </div>

        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}" href="{{ route('kriteria.index') }}">
                <i class="fas fa-list-check me-2"></i> Kriteria
            </a>
            <a class="nav-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}" href="{{ route('kendaraan.index') }}">
                <i class="fas fa-car me-2"></i> Data Kendaraan
            </a>
            <a class="nav-link {{ request()->routeIs('spk.*') ? 'active' : '' }}" href="{{ route('spk.index') }}">
                <i class="fas fa-ranking-star me-2"></i> Hasil Perangkingan
            </a>
            <hr style="border-color: rgba(255,255,255,0.2);">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <nav class="navbar navbar-light bg-white d-md-none shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-outline-success" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <span class="navbar-brand mb-0 h6">EcoCarFinder</span>
    </div>
    </nav>

    <div class="sidebar-overlay"></div>


    <!-- Main Content (Konten Dinamis) -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

    <script>
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.sidebar-overlay');

    document.getElementById('toggleSidebar')?.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.style.display = 'none';
    });
    </script>


</body>
</html>