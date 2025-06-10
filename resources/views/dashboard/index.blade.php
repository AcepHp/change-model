<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Dashboard'])
    @include('layouts.head-css')

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body>
    @include('layouts.layout-vertical')

    <div class="pc-container">
        <div class="pc-content">
            @include('layouts.breadcrumb', [
            'breadcrumbs' => [
            ['label' => 'Home', 'url' => '/dashboard', 'active' => false],
            ['label' => 'Dashboard', 'url' => '/dashboard', 'active' => true],
            ]
            ])

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: var(--primary-color);">
                        <svg width="20" height="20" fill="white" viewBox="0 0 20 20">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                    </div>
                    <div class="stat-label">Total Users</div>
                    <h3 class="stat-value">{{ number_format($totalUsers) }}</h3>
                </div>

                <div class="stat-card success">
                    <div class="stat-icon" style="background: var(--success-color);">
                        <svg width="20" height="20" fill="white" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" />
                        </svg>
                    </div>
                    <div class="stat-label">Total Log CS</div>
                    <h3 class="stat-value">{{ number_format($totalLogCS) }}</h3>
                </div>

                <div class="stat-card warning">
                    <div class="stat-icon" style="background: var(--warning-color);">
                        <svg width="20" height="20" fill="white" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" />
                        </svg>
                    </div>
                    <div class="stat-label">Total Log Detail CS</div>
                    <h3 class="stat-value">{{ number_format($totalLogDetailCS) }}</h3>
                </div>

                <div class="stat-card info">
                    <div class="stat-icon" style="background: var(--info-color);">
                        <svg width="20" height="20" fill="white" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" />
                        </svg>
                    </div>
                    <div class="stat-label">Total CS Change Model</div>
                    <h3 class="stat-value">{{ number_format($totalCSChangeModel) }}</h3>
                </div>
            </div>

        </div>


        <!-- JS Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        
</body>

</html>