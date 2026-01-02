@extends('layouts.app')

@section('title', 'Dashboard - Gym GenZ Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-dark">Dashboard Overview</h1>
            <p class="text-muted">Welcome back, Admin! Here's what's happening with your gym today.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-purple">
                <i class="fas fa-plus me-2"></i>Add Member
            </button>
            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-calendar-alt me-2"></i>This Month
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">This Week</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Total Pengguna</h6>
                            <h2 class="stat-number mb-0">1,248</h2>
                        </div>
                        <div class="icon-container bg-purple-light">
                            <i class="fas fa-users text-purple"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Total Pengguna</h6>
                            <h2 class="stat-number mb-0">1,248</h2>
                        </div>
                        <div class="icon-container bg-purple-light">
                            <i class="fas fa-users text-purple"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Total Pengguna</h6>
                            <h2 class="stat-number mb-0">1,248</h2>
                        </div>
                        <div class="icon-container bg-purple-light">
                            <i class="fas fa-users text-purple"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Total Pengguna</h6>
                            <h2 class="stat-number mb-0">1,248</h2>
                        </div>
                        <div class="icon-container bg-purple-light">
                            <i class="fas fa-users text-purple"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Attendance Overview</h5>
                    <select class="form-select form-select-sm w-auto">
                        <option>Last 7 Days</option>
                        <option selected>Last 30 Days</option>
                        <option>Last 90 Days</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Membership Types</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="chart-container" style="height: 250px;">
                        <canvas id="membershipChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Top Trainers -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Members</h5>
                    <a href="#" class="btn btn-sm btn-outline-dark">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Member</th>
                                    <th>Join Date</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <div class="avatar-circle bg-purple text-white">
                                                    <span>JD</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-medium">John Doe</div>
                                                <div class="text-muted small">Member ID: GZ001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>2024-03-15</td>
                                    <td><span class="badge bg-purple">Premium</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <div class="avatar-circle bg-info text-white">
                                                    <span>JS</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-medium">Jane Smith</div>
                                                <div class="text-muted small">Member ID: GZ002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>2024-03-14</td>
                                    <td><span class="badge bg-warning">Basic</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <div class="avatar-circle bg-success text-white">
                                                    <span>RB</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-medium">Robert Brown</div>
                                                <div class="text-muted small">Member ID: GZ003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>2024-03-13</td>
                                    <td><span class="badge bg-purple">Premium</span></td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <div class="avatar-circle bg-danger text-white">
                                                    <span>LW</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-medium">Lisa White</div>
                                                <div class="text-muted small">Member ID: GZ004</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>2024-03-12</td>
                                    <td><span class="badge bg-info">Student</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Equipment Status</h5>
                    <a href="#" class="btn btn-sm btn-outline-dark">Manage</a>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="equipment-card text-center p-3 rounded">
                                <div class="equipment-icon mb-3">
                                    <i class="fas fa-dumbbell fa-2x text-purple"></i>
                                </div>
                                <h6>Treadmills</h6>
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 85%"></div>
                                </div>
                                <span class="badge bg-success">8/10 Available</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="equipment-card text-center p-3 rounded">
                                <div class="equipment-icon mb-3">
                                    <i class="fas fa-bicycle fa-2x text-info"></i>
                                </div>
                                <h6>Stationary Bikes</h6>
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 90%"></div>
                                </div>
                                <span class="badge bg-success">9/10 Available</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="equipment-card text-center p-3 rounded">
                                <div class="equipment-icon mb-3">
                                    <i class="fas fa-weight-hanging fa-2x text-warning"></i>
                                </div>
                                <h6>Weight Sets</h6>
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                </div>
                                <span class="badge bg-warning">7/10 Available</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="equipment-card text-center p-3 rounded">
                                <div class="equipment-icon mb-3">
                                    <i class="fas fa-running fa-2x text-danger"></i>
                                </div>
                                <h6>Ellipticals</h6>
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar bg-danger" style="width: 50%"></div>
                                </div>
                                <span class="badge bg-danger">5/10 Available</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Toggle Sidebar
document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
});

// Attendance Chart
const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
const attendanceChart = new Chart(attendanceCtx, {
    type: 'line',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Check-ins',
            data: [65, 78, 90, 85, 120, 95, 70],
            borderColor: '#AF69EE',
            backgroundColor: 'rgba(175, 105, 238, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    drawBorder: false
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// Membership Chart
const membershipCtx = document.getElementById('membershipChart').getContext('2d');
const membershipChart = new Chart(membershipCtx, {
    type: 'doughnut',
    data: {
        labels: ['Premium', 'Basic', 'Student', 'Corporate'],
        datasets: [{
            data: [40, 30, 20, 10],
            backgroundColor: [
                '#AF69EE',
                '#3b82f6',
                '#10b981',
                '#f59e0b'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        },
        cutout: '70%'
    }
});
</script>
@endpush