<x-app-admin>
    <div class="p-6 space-y-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
            <p class="mt-2 text-gray-600">Selamat datang! Berikut adalah ringkasan aktivitas aplikasi Anda.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Pengguna</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                        <p class="text-xs text-gray-500 mt-1">Semua pengguna terdaftar</p>
                    </div>
                    <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Approvals Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Menunggu Persetujuan</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $usersDiproses }}</p>
                        <p class="text-xs text-gray-500 mt-1">Pengguna yang perlu diproses</p>
                    </div>
                    <div class="bg-gradient-to-r from-yellow-100 to-yellow-200 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Feedback Pending Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Feedback Tertunda</p>
                        <p class="text-2xl font-bold text-orange-600">{{ $feedbackDiproses }}</p>
                        <p class="text-xs text-gray-500 mt-1">Feedback yang belum dibalas</p>
                    </div>
                    <div class="bg-gradient-to-r from-orange-100 to-orange-200 p-3 rounded-full">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Forms Revision Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Formulir Revisi</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $formulirRevisi }}</p>
                        <p class="text-xs text-gray-500 mt-1">Formulir yang perlu revisi</p>
                    </div>
                    <div class="bg-gradient-to-r from-purple-100 to-purple-200 p-3 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Status Overview -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Ringkasan Status</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- User Status Chart -->
                            <div class="space-y-4">
                                <h3 class="text-sm font-medium text-gray-700 mb-4">Status Pengguna</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                            <span class="text-sm text-gray-600">Disetujui</span>
                                        </div>
                                        <span class="text-sm font-semibold text-green-600">{{ $usersDisetujui }}</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                            <span class="text-sm text-gray-600">Diproses</span>
                                        </div>
                                        <span class="text-sm font-semibold text-yellow-600">{{ $usersDiproses }}</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                                            <span class="text-sm text-gray-600">Ditolak</span>
                                        </div>
                                        <span class="text-sm font-semibold text-red-600">{{ $usersDitolak }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulir Status Chart -->
                            <div class="space-y-4">
                                <h3 class="text-sm font-medium text-gray-700 mb-4">Status Formulir</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                            <span class="text-sm text-gray-600">Selesai</span>
                                        </div>
                                        <span class="text-sm font-semibold text-green-600">{{ $formulirSelesai }}</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-orange-500 rounded-full mr-3"></div>
                                            <span class="text-sm text-gray-600">Revisi</span>
                                        </div>
                                        <span class="text-sm font-semibold text-orange-600">{{ $formulirRevisi }}</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                            <span class="text-sm text-gray-600">Diproses</span>
                                        </div>
                                        <span class="text-sm font-semibold text-yellow-600">{{ $formulirDiproses }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Feedback Status Chart -->
                            <div class="space-y-4">
                                <h3 class="text-sm font-medium text-gray-700 mb-4">Status Feedback</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                            <span class="text-sm text-gray-600">Selesai</span>
                                        </div>
                                        <span class="text-sm font-semibold text-green-600">{{ $feedbackSelesai ?? 0 }}</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-orange-500 rounded-full mr-3"></div>
                                            <span class="text-sm text-gray-600">Diproses</span>
                                        </div>
                                        <span class="text-sm font-semibold text-orange-600">{{ $feedbackDiproses }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Tasks Alert -->
            <div class="space-y-6">
                <!-- Tasks Alert -->
                @if($usersDiproses > 0 || $feedbackDiproses > 0 || $formulirRevisi > 0)
                <div class="bg-yellow-50 rounded-lg border border-yellow-200">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <h3 class="text-sm font-medium text-yellow-800">Perhatian!</h3>
                        </div>
                        <p class="text-sm text-yellow-700 mb-3">Ada beberapa item yang memerlukan perhatian Anda:</p>
                        <div class="space-y-1 text-sm text-yellow-700">
                            @if($usersDiproses > 0)
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                    {{ $usersDiproses }} pengguna menunggu persetujuan
                                </div>
                            @endif
                            @if($feedbackDiproses > 0)
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                    {{ $feedbackDiproses }} feedback belum dibalas
                                </div>
                            @endif
                            @if($formulirRevisi > 0)
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                    {{ $formulirRevisi }} formulir perlu revisi
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900">Aktivitas Terbaru</h3>
                    </div>
                    <div class="p-4">
                        <div class="space-y-3">
                            <div class="flex items-center text-sm">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                <span class="text-gray-600">User baru disetujui</span>
                                <span class="ml-auto text-gray-400">2 jam lalu</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                                <span class="text-gray-600">Feedback baru masuk</span>
                                <span class="ml-auto text-gray-400">4 jam lalu</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                <span class="text-gray-600">Formulir butuh revisi</span>
                                <span class="ml-auto text-gray-400">6 jam lalu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
            <!-- Weekly Activity Chart -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-[#EDBC19] to-[#8F181A] p-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Aktivitas Mingguan
                    </h2>
                    <p class="text-yellow-100 mt-2">Data 7 hari terakhir</p>
                </div>
                <div class="p-6">
                    <div class="h-80">
                        <canvas id="weeklyChart"></canvas>
                    </div>
                    <div class="mt-6 grid grid-cols-3 gap-4 text-center">
                        <div class="bg-blue-50 rounded-lg p-3">
                            <div class="text-blue-600 font-semibold">Users</div>
                            <div class="text-2xl font-bold text-blue-800">{{ array_sum(array_column($weeklyActivity, 'users')) }}</div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-3">
                            <div class="text-green-600 font-semibold">Feedback</div>
                            <div class="text-2xl font-bold text-green-800">{{ array_sum(array_column($weeklyActivity, 'feedbacks')) }}</div>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-3">
                            <div class="text-purple-600 font-semibold">Formulir</div>
                            <div class="text-2xl font-bold text-purple-800">{{ array_sum(array_column($weeklyActivity, 'formulirs')) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Distribution Chart -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-[#EDBC19] to-[#8F181A] p-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                        Distribusi Status
                    </h2>
                    <p class="text-yellow-100 mt-2">Status keseluruhan sistem</p>
                </div>
                <div class="p-6">
                    <div class="h-80">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-yellow-50 rounded-lg p-4">
                            <div class="text-yellow-600 font-semibold mb-2">Dalam Proses</div>
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="text-sm">Users</span>
                                    <span class="font-semibold">{{ $statusDistribution['users']['diproses'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm">Feedback</span>
                                    <span class="font-semibold">{{ $statusDistribution['feedbacks']['diproses'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm">Formulir</span>
                                    <span class="font-semibold">{{ $statusDistribution['formulirs']['diproses'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="text-green-600 font-semibold mb-2">Selesai</div>
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="text-sm">Users</span>
                                    <span class="font-semibold">{{ $statusDistribution['users']['disetujui'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm">Feedback</span>
                                    <span class="font-semibold">{{ $statusDistribution['feedbacks']['selesai'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm">Formulir</span>
                                    <span class="font-semibold">{{ $statusDistribution['formulirs']['selesai'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Metrics dengan Progress Bars -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-[#EDBC19] to-[#8F181A] p-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Metrik Performa Sistem
                </h2>
                <p class="text-yellow-100 mt-2">Analisis kinerja berdasarkan data real</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Response Time -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-blue-800">Tingkat Respons</h3>
                                <p class="text-blue-600 text-sm">Feedback selesai</p>
                            </div>
                            <div class="text-3xl font-bold text-blue-600">
                                {{ $performanceMetrics['response_time'] }}%
                            </div>
                        </div>
                        <div class="w-full bg-blue-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-3 rounded-full transition-all duration-1000 ease-out" 
                                style="width: {{ $performanceMetrics['response_time'] }}%"></div>
                        </div>
                    </div>

                    <!-- User Approval Rate -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-green-800">Tingkat Persetujuan</h3>
                                <p class="text-green-600 text-sm">User disetujui</p>
                            </div>
                            <div class="text-3xl font-bold text-green-600">
                                {{ $performanceMetrics['user_approval_rate'] }}%
                            </div>
                        </div>
                        <div class="w-full bg-green-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-full transition-all duration-1000 ease-out" 
                                style="width: {{ $performanceMetrics['user_approval_rate'] }}%"></div>
                        </div>
                    </div>

                    <!-- Task Completion -->
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-purple-800">Penyelesaian Tugas</h3>
                                <p class="text-purple-600 text-sm">Formulir selesai</p>
                            </div>
                            <div class="text-3xl font-bold text-purple-600">
                                {{ $performanceMetrics['task_completion_rate'] }}%
                            </div>
                        </div>
                        <div class="w-full bg-purple-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-3 rounded-full transition-all duration-1000 ease-out" 
                                style="width: {{ $performanceMetrics['task_completion_rate'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <script>
        // Weekly Activity Chart
        const weeklyData = @json($weeklyActivity);
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');

        new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: weeklyData.map(item => item.day),
                datasets: [{
                    label: 'Users',
                    data: weeklyData.map(item => item.users),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Feedback',
                    data: weeklyData.map(item => item.feedbacks),
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Formulir',
                    data: weeklyData.map(item => item.formulirs),
                    borderColor: 'rgb(168, 85, 247)',
                    backgroundColor: 'rgba(168, 85, 247, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: 'bold'
                            }
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 6,
                        hoverRadius: 8
                    }
                }
            }
        });

        // Status Distribution Chart
        const statusData = @json($statusDistribution);
        const statusCtx = document.getElementById('statusChart').getContext('2d');

        // Prepare data for doughnut chart
        const statusLabels = [];
        const statusValues = [];
        const statusColors = [];

        // Users data
        statusLabels.push('Users Diproses', 'Users Disetujui', 'Users Ditolak');
        statusValues.push(statusData.users.diproses, statusData.users.disetujui, statusData.users.ditolak);
        statusColors.push('rgb(59, 130, 246)', 'rgb(34, 197, 94)', 'rgb(239, 68, 68)');

        // Feedback data
        statusLabels.push('Feedback Diproses', 'Feedback Selesai');
        statusValues.push(statusData.feedbacks.diproses, statusData.feedbacks.selesai);
        statusColors.push('rgb(251, 191, 36)', 'rgb(16, 185, 129)');

        // Formulir data
        statusLabels.push('Formulir Diproses', 'Formulir Revisi', 'Formulir Selesai');
        statusValues.push(statusData.formulirs.diproses, statusData.formulirs.revisi, statusData.formulirs.selesai);
        statusColors.push('rgb(168, 85, 247)', 'rgb(245, 101, 101)', 'rgb(52, 211, 153)');

        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusValues,
                    backgroundColor: statusColors,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                cutout: '60%'
            }
        });

        // Add loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.bg-gradient-to-r');
            progressBars.forEach(bar => {
                if (bar.style.width) {
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = bar.getAttribute('data-width') || bar.style.width;
                    }, 500);
                }
            });
        });
        </script>

        <style>
        .chart-container {
            position: relative;
            height: 300px;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Animate progress bars */
        .transition-all {
            transition: all 1s ease-in-out;
        }

        /* Hover effects */
        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        </style>
    </div>
</x-app-admin>