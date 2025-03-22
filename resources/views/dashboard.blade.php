@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
@include('layouts.navbar')

<div class="container-fluid py-4">
    <!-- หัวข้อ Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 d-flex align-items-center">
                    <span class="dashboard-title-hr">HR</span>
                    <span class="dashboard-title-dashboard">DASHBOARD</span>
                </h2>
            </div>
        </div>
    </div>

    <!-- Performance Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header performance-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>ผลการปฏิบัติงาน</h5>
                </div>
                <div class="card-body bg-white">
                    <div class="row">
                        
                    <!-- Performance Scores -->
                        <div class="col-12">
                            <div class="card h-100 dashboard-card">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">คะแนนการทำงาน</h6>
                                    <div class="chart-wrapper">
                                        <canvas id="scoresChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endpush 