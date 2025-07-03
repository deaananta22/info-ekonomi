<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Rapat - Laravel MongoDB App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --danger-gradient: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            --dark-gradient: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-elegant: 0 20px 40px rgba(0, 0, 0, 0.1);
            --shadow-glow: 0 0 30px rgba(102, 126, 234, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-gradient);
            min-height: 100vh;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(10px) rotate(-1deg); }
        }

        /* Enhanced Navbar */
        .navbar {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: var(--shadow-elegant);
            transition: all 0.3s ease;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            opacity: 0.1;
            z-index: -1;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-brand::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
        }

        .navbar-brand:hover::after {
            width: 100%;
        }

        .navbar-text {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            animation: slideInLeft 0.6s ease;
        }

        .btn-logout {
            background: var(--secondary-gradient);
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-logout::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-logout:hover::before {
            left: 100%;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 87, 108, 0.4);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            padding: 10px 20px !important;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            opacity: 0;
            border-radius: 20px;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        /* Enhanced Main Container */
        .main-container {
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease;
        }

        .content-wrapper {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: var(--shadow-elegant);
            position: relative;
            overflow: hidden;
        }

        .content-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--primary-gradient);
            opacity: 0.5;
        }

        /* Meeting specific styles */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            animation: slideInDown 0.8s ease;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            font-weight: 400;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .btn-modern {
            border: none;
            border-radius: 25px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-modern {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-success-modern {
            background: var(--success-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
        }

        .btn-warning-modern {
            background: var(--warning-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(240, 147, 251, 0.3);
        }

        .btn-danger-modern {
            background: var(--danger-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Form Styles */
        .form-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-elegant);
            display: none;
        }

        .form-card.active {
            display: block;
            animation: slideInUp 0.5s ease;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control-modern {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 12px 16px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-control-modern:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
            outline: none;
        }

        .form-control-modern::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Table Styles */
        .table-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-elegant);
            overflow: hidden;
        }

        .table-modern {
            color: white;
            margin-bottom: 0;
        }

        .table-modern thead th {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .table-modern tbody td {
            border-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            vertical-align: middle;
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: scale(1.01);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-scheduled {
            background: var(--primary-gradient);
            color: white;
        }

        .status-completed {
            background: var(--success-gradient);
            color: white;
        }

        .status-cancelled {
            background: var(--danger-gradient);
            color: white;
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 0.875rem;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--success-gradient);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: var(--shadow-elegant);
            z-index: 1100;
            display: none;
        }

        .notification.error {
            background: var(--danger-gradient);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-modern {
                justify-content: center;
            }
            
            .content-wrapper {
                padding: 1.5rem;
            }
            
            .form-card, .table-card {
                padding: 1rem;
            }
        }

        /* Floating shapes */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            background: rgba(102, 126, 234, 0.1);
            top: 20%;
            left: 10%;
            animation-delay: -2s;
        }

        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            background: rgba(245, 87, 108, 0.1);
            top: 60%;
            right: 10%;
            animation-delay: -4s;
        }

        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            background: rgba(120, 219, 255, 0.1);
            bottom: 20%;
            left: 20%;
            animation-delay: -1s;
        }
    </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Info Ekonomi')</title>

  {{-- Bootstrap & Fonts --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

  <style>
    body {
      font-family: 'Inter', sans-serif;

      background: linear-gradient(135deg,rgb(89, 109, 198),rgb(230, 103, 213),rgb(241, 242, 244));
      color: #fff;
      margin: 0;
    }

    .navbar {
      background:rgb(12, 85, 241);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 1.4rem;
      color: #fff;
    }

    .nav-link, .dropdown-toggle {
      color: rgba(255, 255, 255, 0.85) !important;
      font-weight: 500;
    }

    .nav-link:hover, .dropdown-toggle:hover {
      color: #fff !important;
    }

    .btn-login {
      background: linear-gradient(135deg, #f093fb, #f5576c);
      color: white;
      border-radius: 20px;
      padding: 6px 16px;
      font-weight: 500;
    }

    .btn-login {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 25px;
    padding: 10px 24px;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(118, 75, 162, 0.3);
    transition: all 0.3s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(251, 251, 251, 0.5);
}
 
.card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
    box-shadow: 0 0 20px rgba(236, 237, 242, 1);
}


    /* .content-wrapper {
      margin-top: 2rem;
      background: rgb(234, 230, 230);
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgb(239, 234, 234);
    } */
  </style>
</head>
<body>

    <!-- Notification -->
    <div id="notification" class="notification"></div>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-database me-2"></i>Laravel MongoDB
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto align-items-center">
                    <span class="navbar-text me-3">
                        <i class="fas fa-user-circle me-2"></i>Halo, Admin User!
                    </span>
                    <button class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="container main-container">
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-calendar-alt me-3"></i>
                    Manajemen Rapat
                </h1>
                <p class="page-subtitle">Kelola semua jadwal rapat dengan mudah dan efisien</p>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn-modern btn-primary-modern" onclick="toggleForm()">
                    <i class="fas fa-plus"></i>
                    Tambah Rapat Baru
                </button>
                <button class="btn-modern btn-success-modern" onclick="exportData()">
                    <i class="fas fa-download"></i>
                    Export Data
                </button>
            </div>

            <!-- Add/Edit Form -->
            <div id="meetingForm" class="form-card">
                <h4 class="mb-4">
                    <i class="fas fa-calendar-plus me-2"></i>
                    <span id="formTitle">Tambah Rapat Baru</span>
                </h4>
                <form id="meetingFormElement">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-heading me-2"></i>Judul Rapat
                                </label>
                                <input type="text" class="form-control-modern" id="title" placeholder="Masukkan judul rapat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-2"></i>Tanggal
                                </label>
                                <input type="date" class="form-control-modern" id="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-clock me-2"></i>Waktu
                                </label>
                                <input type="time" class="form-control-modern" id="time" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                </label>
                                <input type="text" class="form-control-modern" id="location" placeholder="Masukkan lokasi rapat" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-users me-2"></i>Jumlah Peserta
                                </label>
                                <input type="number" class="form-control-modern" id="participants" placeholder="Jumlah peserta" min="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-info-circle me-2"></i>Status
                                </label>
                                <select class="form-control-modern" id="status">
                                    <option value="scheduled">Dijadwalkan</option>
                                    <option value="completed">Selesai</option>
                                    <option value="cancelled">Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-align-left me-2"></i>Deskripsi
                        </label>
                        <textarea class="form-control-modern" id="description" rows="3" placeholder="Deskripsi rapat (opsional)"></textarea>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn-modern btn-success-modern">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                        <button type="button" class="btn-modern btn-warning-modern" onclick="resetForm()">
                            <i class="fas fa-redo"></i>
                            Reset
                        </button>
                        <button type="button" class="btn-modern btn-danger-modern" onclick="toggleForm()">
                            <i class="fas fa-times"></i>
                            Batal
                        </button>
                    </div>
                </form>
            </div>

            <!-- Meeting Table -->
            <div class="table-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Daftar Rapat
                    </h4>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control-modern" id="searchInput" placeholder="Cari rapat..." style="width: 200px;">
                        <button class="btn-modern btn-primary-modern" onclick="searchMeetings()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tanggal & Waktu</th>
                                <th>Lokasi</th>
                                <th>Peserta</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="meetingTableBody">
                            <!-- Sample data -->
                            <tr>
                                <td>
                                    <strong>Meeting Bulanan Tim</strong>
                                    <br>
                                    <small class="text-muted">Review progress proyek</small>
                                </td>
                                <td>
                                    <i class="fas fa-calendar me-2"></i>2025-07-15
                                    <br>
                                    <i class="fas fa-clock me-2"></i>09:00
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt me-2"></i>Ruang Meeting A
                                </td>
                                <td>
                                    <i class="fas fa-users me-2"></i>8 orang
                                </td>
                                <td>
                                    <span class="status-badge status-scheduled">Dijadwalkan</span>
                                </td>
                                <td>
                                    <button class="btn-modern btn-warning-modern btn-sm" onclick="editMeeting(1)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-modern btn-danger-modern btn-sm" onclick="deleteMeeting(1)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Presentasi Klien</strong>
                                    <br>
                                    <small class="text-muted">Demo produk terbaru</small>
                                </td>
                                <td>
                                    <i class="fas fa-calendar me-2"></i>2025-07-10
                                    <br>
                                    <i class="fas fa-clock me-2"></i>14:30
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt me-2"></i>Auditorium
                                </td>
                                <td>
                                    <i class="fas fa-users me-2"></i>25 orang
                                </td>
                                <td>
                                    <span class="status-badge status-completed">Selesai</span>
                                </td>
                                <td>
                                    <button class="btn-modern btn-warning-modern btn-sm" onclick="editMeeting(2)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-modern btn-danger-modern btn-sm" onclick="deleteMeeting(2)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    
    <script>
        // Sample data storage (in real app, this would be connected to backend)
        let meetings = [
            {
                id: 1,
                title: "Meeting Bulanan Tim",
                description: "Review progress proyek",
                date: "2025-07-15",
                time: "09:00",
                location: "Ruang Meeting A",
                participants: 8,
                status: "scheduled"
            },
            {
                id: 2,
                title: "Presentasi Klien",
                description: "Demo produk terbaru",
                date: "2025-07-10",
                time: "14:30",
                location: "Auditorium",
                participants: 25,
                status: "completed"
            }
        ];

        let editingId = null;

        // Toggle form visibility
        function toggleForm() {
            const form = document.getElementById('meetingForm');
            const isVisible = form.classList.contains('active');
            
            if (isVisible) {
                form.classList.remove('active');
                resetForm();
            } else {
                form.classList.add('active');
                document.getElementById('formTitle').textContent = 'Tambah Rapat Baru';
                editingId = null;
            }
        }

        // Reset form
        function resetForm() {
            document.getElementById('meetingFormElement').reset();
            editingId = null;
            document.getElementById('formTitle').textContent = 'Tambah Rapat Baru';
        }

        // Form submission
        document.getElementById('meetingFormElement').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                title: document.getElementById('title').value,
                date: document.getElementById('date').value,
                time: document.getElementById('time').value,
                location: document.getElementById('location').value,
                participants: parseInt(document.getElementById('participants').value) || 0,
                status: document.getElementById('status').value,
                description: document.getElementById('description').value
            };

            if (editingId) {
                // Update existing meeting
                const index = meetings.findIndex(m => m.id === editingId);
                if (index !== -1) {
                    meetings[index] = { ...meetings[index], ...formData };
                    showNotification('Rapat berhasil diperbarui!', 'success');
                }
            } else {
                // Add new meeting
                const newMeeting = {
                    id: meetings.length > 0 ? Math.max(...meetings.map(m => m.id)) + 1 : 1,
                    ...formData
                };
                meetings.push(newMeeting);
                showNotification('Rapat berhasil ditambahkan!', 'success');
            }

            refreshTable();
            toggleForm();
        });

        // Edit meeting
        function editMeeting(id) {
            const meeting = meetings.find(m => m.id === id);
            if (!meeting) return;

            // Fill form with meeting data
            document.getElementById('title').value = meeting.title;
            document.getElementById('date').value = meeting.date;
            document.getElementById('time').value = meeting.time;
            document.getElementById('location').value = meeting.location;
            document.getElementById('participants').value = meeting.participants;
            document.getElementById('status').value = meeting.status;
            document.getElementById('description').value = meeting.description || '';

            // Show form and set editing mode
            document.getElementById('meetingForm').classList.add('active');
            document.getElementById('formTitle').textContent = 'Edit Rapat';
            editingId = id;
        }

        // Delete meeting
        function deleteMeeting(id) {
            if (confirm('Apakah Anda yakin ingin menghapus rapat ini?')) {
                meetings = meetings.filter(m => m.id !== id);
                refreshTable();
                showNotification('Rapat berhasil dihapus!', 'success');
            }
        }

        // Search meetings
        function searchMeetings() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filteredMeetings = meetings.filter(meeting => 
                meeting.title.toLowerCase().includes(searchTerm) ||
                meeting.location.toLowerCase().includes(searchTerm) ||
                meeting.description.toLowerCase().includes(searchTerm)
            );
            renderTable(filteredMeetings);
        }

        // Export data
        function exportData() {
            const csvContent = [
                ['Judul', 'Tanggal', 'Waktu', 'Lokasi', 'Peserta', 'Status', 'Deskripsi'],
                ...meetings.map(m => [
                    m.title,
                    m.date,
                    m.time,
                    m.location,
                    m.participants,
                    m.status,
                    m.description || ''
                ])
            ].map(row => row.join(',')).join('\n');

            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'rapat_data.csv';
            a.click();
            window.URL.revokeObjectURL(url);
            
            showNotification('Data berhasil diekspor!', 'success');
        }

        // Refresh table
        function refreshTable() {
            renderTable(meetings);
        }

        // Render table
        function renderTable(data) {
            const tbody = document.getElementById('meetingTableBody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 2rem;">
                            <i class="fas fa-inbox fa-3x mb-3" style="color: rgba(255, 255, 255, 0.3);"></i>
                            <br>
                            <span style="color: rgba(255, 255, 255, 0.6);">Tidak ada rapat ditemukan</span>
                        </td>
                    </tr>
                `;
                return;
            }

            data.forEach(meeting => {
                const statusClass = {
                    'scheduled': 'status-scheduled',
                    'completed': 'status-completed',
                    'cancelled': 'status-cancelled'
                }[meeting.status];

                const statusText = {
                    'scheduled': 'Dijadwalkan',
                    'completed': 'Selesai',
                    'cancelled': 'Dibatalkan'
                }[meeting.status];

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <strong>${meeting.title}</strong>
                        <br>
                        <small class="text-muted">${meeting.description || 'Tidak ada deskripsi'}</small>
                    </td>
                    <td>
                        <i class="fas fa-calendar me-2"></i>${meeting.date}
                        <br>
                        <i class="fas fa-clock me-2"></i>${meeting.time}
                    </td>
                    <td>
                        <i class="fas fa-map-marker-alt me-2"></i>${meeting.location}
                    </td>
                    <td>
                        <i class="fas fa-users me-2"></i>${meeting.participants} orang
                    </td>
                    <td>
                        <span class="status-badge ${statusClass}">${statusText}</span>
                    </td>
                    <td>
                        <button class="btn-modern btn-warning-modern btn-sm" onclick="editMeeting(${meeting.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-modern btn-danger-modern btn-sm" onclick="deleteMeeting(${meeting.id})" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification ${type === 'error' ? 'error' : ''}`;
            notification.style.display = 'block';
            
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }

        // Search on enter key
        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                searchMeetings();
            }
        });

        // Clear search when input is empty
        document.getElementById('searchInput').addEventListener('input', function(e) {
            if (e.target.value === '') {
                refreshTable();
            }
        });

        // Logout functionality
        document.querySelector('.btn-logout').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                showNotification('Logout berhasil!', 'success');
                setTimeout(() => {
                    // In real app, redirect to login page
                    window.location.href = '/login';
                }, 1000);
            }
        });

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            refreshTable();
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = today;
            
            // Add some entrance animations
            const elements = document.querySelectorAll('.content-wrapper, .form-card, .table-card');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + N for new meeting
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                if (!document.getElementById('meetingForm').classList.contains('active')) {
                    toggleForm();
                }
            }
            
            // Escape to close form
            if (e.key === 'Escape') {
                if (document.getElementById('meetingForm').classList.contains('active')) {
                    toggleForm();
                }
            }
        });

        // Add tooltip functionality
        function addTooltips() {
            const tooltipElements = document.querySelectorAll('[title]');
            tooltipElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'tooltip-custom';
                    tooltip.textContent = this.getAttribute('title');
                    tooltip.style.cssText = `
                        position: absolute;
                        background: var(--dark-gradient);
                        color: white;
                        padding: 8px 12px;
                        border-radius: 6px;
                        font-size: 0.8rem;
                        z-index: 1000;
                        pointer-events: none;
                        box-shadow: var(--shadow-elegant);
                    `;
                    document.body.appendChild(tooltip);
                    
                    const rect = this.getBoundingClientRect();
                    tooltip.style.left = rect.left + 'px';
                    tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
                    
                    this.addEventListener('mouseleave', function() {
                        if (tooltip.parentNode) {
                            tooltip.parentNode.removeChild(tooltip);
                        }
                    });
                });
            });
        }

        // Initialize tooltips
        setTimeout(addTooltips, 100);

        // Auto-save form data (optional feature)
        let autoSaveTimeout;
        const formInputs = document.querySelectorAll('#meetingFormElement input, #meetingFormElement textarea, #meetingFormElement select');
        
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(() => {
                    // Save to local storage or send to server
                    console.log('Auto-saving form data...');
                }, 1000);
            });
        });

        // Add meeting statistics
        function updateStatistics() {
            const stats = {
                total: meetings.length,
                scheduled: meetings.filter(m => m.status === 'scheduled').length,
                completed: meetings.filter(m => m.status === 'completed').length,
                cancelled: meetings.filter(m => m.status === 'cancelled').length
            };
            
            // Update page subtitle with stats
            const subtitle = document.querySelector('.page-subtitle');
            subtitle.innerHTML = `
                Kelola semua jadwal rapat dengan mudah dan efisien
                <br>
                <small style="color: rgba(255, 255, 255, 0.5);">
                    Total: ${stats.total} | Dijadwalkan: ${stats.scheduled} | Selesai: ${stats.completed} | Dibatalkan: ${stats.cancelled}
                </small>
            `;
        }

        // Update statistics when table is refreshed
        const originalRefreshTable = refreshTable;
        refreshTable = function() {
            originalRefreshTable();
            updateStatistics();
        };

        // Initialize statistics
        updateStatistics();
    </script>
  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">✨ INFO EKONOMI</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto align-items-center gap-2">
          {{-- Dropdown Tim Kerja --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="timDropdown" role="button" data-bs-toggle="dropdown">
              Tim Kerja
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Tim Kemiskinan</a></li>
              <li><a class="dropdown-item" href="#">Tim Kawasan Industri & PSN</a></li>
              <li><a class="dropdown-item" href="#">Tim Peluang Investasi</a></li>
              <li><a class="dropdown-item" href="#">Tim CSR</a></li>
              <li><a class="dropdown-item" href="#">Tim DBH perkebunan</a></li>
            </ul>
          </li>

          {{-- Agenda Rapat --}}
          <li class="nav-item">
            <a class="nav-link" href="#">Agenda Rapat</a>
          </li>

          {{-- Login / Logout --}}
          @auth
            <li class="nav-item me-2 text-white">
              Halo, {{ Auth::user()->name }}
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-login btn-sm">Logout</button>
              </form>
            </li>
          @else
            <li class="nav-item">
              <a class="btn btn-login btn-sm" href="{{ route('login') }}">Login</a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  {{-- Konten --}}
  <main class="container">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </main>

  {{-- Script Bootstrap --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
