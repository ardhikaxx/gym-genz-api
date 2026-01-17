@extends('layouts.app')

@section('title', 'Feedback Pengguna - Gym GenZ Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/feedback-pengguna.css') }}">
    <style>
        .search-input-container {
            position: relative;
            width: 400px;
        }

        .search-input-container i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 10;
        }

        .search-input-container input {
            padding-left: 40px;
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }

        .no-data i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #cbd5e1;
        }

        .loading-spinner {
            text-align: center;
            padding: 2rem;
        }

        .avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .initials-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #AF69EE, #7C3AED);
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Rating stars in table */
        .table-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Review text ellipsis */
        .review-text {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Responsive pagination */
        @media (max-width: 576px) {
            .search-input-container {
                width: 100% !important;
            }

            .table-responsive {
                font-size: 0.85rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .card-header .text-muted {
                align-self: flex-start;
            }

            .pagination-container .d-flex {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .pagination-info {
                order: -1;
            }

            .review-text {
                max-width: 150px;
            }
        }

        /* Simplified Modal Styles */
        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(90deg, #f8fafc, #ffffff);
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
        }

        .modal-header .btn-close {
            padding: 0.75rem;
            margin: -0.75rem -0.75rem -0.75rem auto;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            background: #f8fafc;
        }

        /* User Header */
        .detail-modal-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            background: linear-gradient(90deg, #f8fafc, #ffffff);
            border-bottom: 1px solid #e2e8f0;
            margin: -1.5rem -1.5rem 1.5rem;
        }

        #detailUserAvatar .user-avatar-large {
            width: 70px;
            height: 70px;
            font-size: 1.25rem;
        }

        /* Rating Display */
        .rating-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .rating-display i {
            font-size: 1.5rem;
        }

        /* Review Content */
        .review-content {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        /* Timestamp */
        .timestamp {
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Info Cards */
        .card.bg-light {
            background-color: #f8fafc !important;
            border-radius: 12px;
            transition: transform 0.2s ease;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
        }

        /* Responsive Modal */
        @media (max-width: 768px) {
            .modal-dialog.modal-lg {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }

            .modal-body {
                padding: 1rem;
            }

            .detail-modal-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 1rem;
            }

            #detailUserAvatar .user-avatar-large {
                width: 60px;
                height: 60px;
                font-size: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .row.g-3 {
                gap: 1rem !important;
            }
        }

        /* Hover Effects */
        .btn-secondary:hover {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            color: #334155;
        }

        /* Animation for modal */
        .modal.fade .modal-content {
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal.show .modal-content {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 text-dark">Feedback Pengguna</h1>
                <p class="text-muted">Kelola ulasan dan rating dari pengguna</p>
            </div>
        </div>

        <!-- Search -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="search-input-container">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" id="searchInput"
                        placeholder="Cari feedback berdasarkan nama atau review...">
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end gap-3">
                    <div class="text-end">
                        <h5 class="mb-0">{{ $feedbacks->total() }}</h5>
                        <small class="text-muted">Total Feedback</small>
                    </div>
                    <div class="vr"></div>
                </div>
            </div>
        </div>

        <!-- Feedback Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Feedback</h5>
                <div class="text-muted small">
                    Menampilkan {{ $feedbacks->firstItem() ?: 0 }}-{{ $feedbacks->lastItem() ?: 0 }} dari
                    {{ $feedbacks->total() }} feedback
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th style="width: 60px;">Pengguna</th>
                                <th>Nama Pengguna</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Tanggal</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="feedbackTableBody">
                            @forelse ($feedbacks as $index => $feedback)
                                <tr data-feedback-id="{{ $feedback->id }}">
                                    <td data-label="No">{{ $feedbacks->firstItem() + $index }}</td>
                                    <td data-label="Pengguna">
                                        @if ($feedback->pengguna)
                                            @php
                                                $initials = '';
                                                $nameParts = explode(' ', $feedback->pengguna->nama_lengkap);
                                                if (count($nameParts) >= 2) {
                                                    $initials = strtoupper(
                                                        substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1),
                                                    );
                                                } else {
                                                    $initials = strtoupper(substr($feedback->pengguna->nama_lengkap, 0, 2));
                                                }
                                            @endphp
                                            <div class="initials-avatar">
                                                {{ $initials }}
                                            </div>
                                        @else
                                            <div class="initials-avatar">??</div>
                                        @endif
                                    </td>
                                    <td data-label="Nama Pengguna">
                                        @if ($feedback->pengguna)
                                            <div class="fw-medium">{{ $feedback->pengguna->nama_lengkap }}</div>
                                            <div class="text-muted small">ID: USR{{ str_pad($feedback->pengguna->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        @else
                                            <span class="text-muted">Pengguna tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td data-label="Review">
                                        <div class="review-text" title="{{ $feedback->review }}">
                                            {{ $feedback->review ?: 'Tidak ada review' }}
                                        </div>
                                    </td>
                                    <td data-label="Rating">
                                        <div class="table-rating">
                                            <span class="rating-value">{{ $feedback->rating }}</span>
                                            <div class="rating-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $feedback->rating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-muted"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Tanggal">
                                        <div class="timestamp">
                                            <i class="far fa-clock"></i>
                                            {{ $feedback->created_at->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td data-label="Aksi">
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-purple"
                                                onclick="showDetail({{ $feedback->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="no-data">
                                        <i class="fas fa-comment-slash mt-3"></i>
                                        <p class="text-muted">Belum ada feedback dari pengguna</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($feedbacks->hasPages())
                    <div class="pagination-container">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="pagination-info">
                                Halaman {{ $feedbacks->currentPage() }} dari {{ $feedbacks->lastPage() }}
                            </div>
                            <nav>
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($feedbacks->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="fas fa-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $feedbacks->previousPageUrl() }}" rel="prev">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @php
                                        $start = max(1, $feedbacks->currentPage() - 2);
                                        $end = min($feedbacks->lastPage(), $feedbacks->currentPage() + 2);
                                    @endphp

                                    @if ($start > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $feedbacks->url(1) }}">1</a>
                                        </li>
                                        @if ($start > 2)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                    @endif

                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="page-item {{ $feedbacks->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $feedbacks->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if ($end < $feedbacks->lastPage())
                                        @if ($end < $feedbacks->lastPage() - 1)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $feedbacks->url($feedbacks->lastPage()) }}">{{ $feedbacks->lastPage() }}</a>
                                        </li>
                                    @endif

                                    {{-- Next Page Link --}}
                                    @if ($feedbacks->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $feedbacks->nextPageUrl() }}" rel="next">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="fas fa-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Detail Feedback Modal -->
    <div class="modal fade" id="detailFeedbackModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- User Header -->
                    <div class="detail-modal-header">
                        <div id="detailUserAvatar" class="user-avatar-large">
                            <!-- Avatar will be dynamically inserted here -->
                        </div>
                        <div class="d-flex justify-content-start align-items-start flex-column">
                            <h4 id="detailNamaLengkap" class="mb-1"></h4>
                            <p class="text-muted mb-2" id="detailEmail"></p>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge bg-purple bg-opacity-10 text-white border border-purple border-opacity-25 px-3 py-1 rounded-pill"
                                    id="detailUserId"></span>
                                <span class="timestamp" id="detailTimestamp"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Rating Display -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Rating</h6>
                        <div class="rating-display">
                            <span id="detailRatingValue" class="me-2"></span>
                            <div id="detailRatingStars" class="rating-stars-large">
                                <!-- Stars will be dynamically inserted here -->
                            </div>
                        </div>
                    </div>

                    <!-- Review Content -->
                    <div>
                        <h6 class="text-muted mb-3">Review</h6>
                        <div class="review-content">
                            <p id="detailReview" class="mb-0 review-text-full"></p>
                        </div>
                    </div>

                    <!-- Feedback Info -->
                    <div class="row g-3 mt-4">
                        <!-- Feedback ID -->
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title mb-3 text-dark">Informasi Feedback</h6>
                                    <div class="mb-2">
                                        <small class="text-muted d-block mb-1">ID Feedback</small>
                                        <div id="detailFeedbackId" class="fw-medium"></div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted d-block mb-1">Tanggal Submit</small>
                                        <div id="detailCreatedAt" class="fw-medium"></div>
                                    </div>
                                    <div class="mb-0">
                                        <small class="text-muted d-block mb-1">Terakhir Diupdate</small>
                                        <div id="detailUpdatedAt" class="fw-medium"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title mb-3 text-dark">Informasi Pengguna</h6>
                                    <div class="mb-2">
                                        <small class="text-muted d-block mb-1">Email</small>
                                        <div id="detailUserEmail" class="fw-medium"></div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted d-block mb-1">Terdaftar Sejak</small>
                                        <div id="detailUserCreatedAt" class="fw-medium"></div>
                                    </div>
                                    <div class="mb-0">
                                        <small class="text-muted d-block mb-1">Status Akun</small>
                                        <div>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">
                                                Aktif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Get initials from name
        function getInitials(name) {
            if (!name) return '??';
            const nameParts = name.split(' ');
            if (nameParts.length >= 2) {
                return (nameParts[0].charAt(0) + nameParts[1].charAt(0)).toUpperCase();
            }
            return name.substring(0, 2).toUpperCase();
        }

        // Format date
        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return date.toLocaleDateString('id-ID', options);
        }

        // Format date for timestamp
        function formatTimestamp(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            const now = new Date();
            const diffMs = now - date;
            const diffSec = Math.floor(diffMs / 1000);
            const diffMin = Math.floor(diffSec / 60);
            const diffHour = Math.floor(diffMin / 60);
            const diffDay = Math.floor(diffHour / 24);

            if (diffDay > 0) {
                return `${diffDay} hari yang lalu`;
            } else if (diffHour > 0) {
                return `${diffHour} jam yang lalu`;
            } else if (diffMin > 0) {
                return `${diffMin} menit yang lalu`;
            } else {
                return 'Baru saja';
            }
        }

        // Generate stars HTML
        function generateStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += `<i class="fas fa-star text-warning"></i>`;
                } else {
                    stars += `<i class="far fa-star text-muted"></i>`;
                }
            }
            return stars;
        }

        // Show feedback detail
        async function showDetail(id) {
            try {
                const response = await fetch(`/admin/feedback-pengguna/${id}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    const feedback = data.data;
                    const pengguna = feedback.pengguna;

                    // Set user avatar
                    const avatar = document.getElementById('detailUserAvatar');
                    if (pengguna) {
                        const initials = getInitials(pengguna.nama_lengkap);
                        avatar.innerHTML = `<div class="user-avatar-large">${initials}</div>`;
                    } else {
                        avatar.innerHTML = '<div class="user-avatar-large">??</div>';
                    }

                    // Set user info
                    document.getElementById('detailNamaLengkap').textContent = pengguna ? pengguna.nama_lengkap : 'Pengguna tidak ditemukan';
                    document.getElementById('detailEmail').textContent = pengguna ? pengguna.email : '-';
                    document.getElementById('detailUserId').textContent = pengguna ? 
                        `ID: USR${String(pengguna.id).padStart(4, '0')}` : '-';
                    document.getElementById('detailUserEmail').textContent = pengguna ? pengguna.email : '-';

                    // Set rating
                    document.getElementById('detailRatingValue').textContent = `${feedback.rating}/5`;
                    document.getElementById('detailRatingStars').innerHTML = generateStars(feedback.rating);

                    // Set review
                    document.getElementById('detailReview').textContent = feedback.review || 'Tidak ada review';

                    // Set timestamps
                    document.getElementById('detailTimestamp').innerHTML = `
                        <i class="far fa-clock"></i>
                        ${formatTimestamp(feedback.created_at)}
                    `;
                    document.getElementById('detailCreatedAt').textContent = formatDate(feedback.created_at);
                    document.getElementById('detailUpdatedAt').textContent = formatDate(feedback.updated_at);
                    document.getElementById('detailUserCreatedAt').textContent = pengguna ? formatDate(pengguna.created_at) : '-';
                    
                    // Set feedback ID
                    document.getElementById('detailFeedbackId').textContent = `FDB${String(feedback.id).padStart(4, '0')}`;

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('detailFeedbackModal'));
                    modal.show();
                } else {
                    showToast('Gagal mengambil data feedback', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Terjadi kesalahan', 'error');
            }
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#feedbackTableBody tr');

            rows.forEach(row => {
                if (row.querySelector('.no-data')) return;

                const name = row.querySelector('td:nth-child(3) .fw-medium')?.textContent.toLowerCase() || '';
                const review = row.querySelector('td:nth-child(4) .review-text')?.textContent.toLowerCase() || '';
                const rating = row.querySelector('td:nth-child(5) .rating-value')?.textContent.toLowerCase() || '';

                if (name.includes(searchTerm) || review.includes(searchTerm) || rating.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Toast notification
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast-notification toast-${type}`;
            toast.innerHTML = `
                <div class="toast-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 
                                    type === 'warning' ? 'exclamation-triangle' : 
                                    'info-circle'} me-2"></i>
                    ${message}
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('show');
            }, 10);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.parentElement.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }

        // Make table responsive on mobile
        function makeTableResponsive() {
            if (window.innerWidth <= 576) {
                const table = document.querySelector('.table');
                const headers = table.querySelectorAll('thead th');
                const rows = table.querySelectorAll('tbody tr');

                headers.forEach((header, index) => {
                    const label = header.textContent;
                    rows.forEach(row => {
                        if (!row.querySelector('.no-data')) {
                            const cell = row.querySelector(`td:nth-child(${index + 1})`);
                            if (cell) {
                                cell.setAttribute('data-label', label);
                            }
                        }
                    });
                });
            }
        }

        // Initialize responsive table
        document.addEventListener('DOMContentLoaded', function() {
            makeTableResponsive();
            window.addEventListener('resize', makeTableResponsive);
        });
    </script>
@endpush