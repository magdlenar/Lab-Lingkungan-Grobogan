@extends('layouts.admin')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    body { background: #eef1f5; font-family: 'Poppins', sans-serif; }
    .admin-dashboard { padding: 30px; }

    /* ====== Section Title ====== */
    .section-head{
        display:flex;
        align-items:center;
        justify-content:space-between;
        margin-bottom: 14px;
        margin-top: 4px;
        gap: 10px;
    }
    .section-left{
        display:flex;
        flex-direction:column;
        gap:2px;
    }
    .section-title{
        font-size: 18px;
        font-weight: 700;
        color:#1f2937;
        margin:0;
        line-height: 1.3;
    }
    .section-subtitle{
        font-size: 13px;
        color:#6b7280;
        margin-top:2px;
        line-height: 1.4;
    }

    /* ===== Statistic Cards ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
        margin-bottom: 26px;
    }
    .stat-card {
        background: white;
        border-radius: 18px;
        padding: 22px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        transition: 0.2s;
        min-height: 110px;
    }
    .stat-card:hover { transform: translateY(-5px); }
    .stat-number { font-size: 30px; font-weight: 700; color: #189e1e; }
    .stat-label { font-size: 14.5px; font-weight: 500; color: #666; }
    .stat-circle {
        position: absolute;
        right: -30px; top: -30px;
        width: 110px; height: 110px;
        background: rgba(0, 208, 76, 0.12);
        border-radius: 50%;
    }

    /* ==== GRID UNTUK 2 GRAFIK BERSAMPINGAN ==== */
    .chart-grid{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-top: 10px;
    }
    .chart-card {
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        padding: 16px 18px;
        border: 1px solid rgba(255,255,255,0.6);
        box-shadow: 0 5px 16px rgba(0,0,0,0.06);
        min-height: 260px;
    }
    .chart-card h4 {
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
        font-size: 15.5px;
        line-height: 1.3;
    }
    .chart-card canvas{
        width:100% !important;
        max-height: 180px !important;
    }

    /* ================= MOBILE TUNING ================= */
    @media(max-width: 992px){
        .admin-dashboard{ padding: 22px; }
        .stats-grid{ gap: 16px; }
        .chart-grid{ gap: 14px; }
    }

    @media(max-width: 768px){
    .admin-dashboard{ padding: 16px; }

    .section-head{
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 10px;
    }
    .section-title{ font-size: 16.5px; }
    .section-subtitle{ font-size: 12.5px; }

    /* ✅ stats jadi 2 kolom (4 baris) */
    .stats-grid{
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .stat-card{ 
        padding: 16px; 
        min-height: 95px; 
        text-align: center; /* biar rapi di mobile */
    }
    .stat-number{ font-size: 24px; }
    .stat-label{ font-size: 12.8px; line-height: 1.25; }

    /* chart jadi single column */
    .chart-grid{ grid-template-columns: 1fr; }
    .chart-card{
        padding: 14px 14px;
        min-height: 240px;
    }
    .chart-card h4{ font-size: 14.5px; }
    .chart-card canvas{ max-height: 170px !important; }
}

    @media(max-width: 420px){
        .admin-dashboard{ padding: 12px; }
        .section-title{ font-size: 15.5px; }
        .section-subtitle{ font-size: 12px; }

        .stat-card{ padding: 16px; min-height: 100px; }
        .stat-number{ font-size: 24px; }

        .chart-card{ min-height: 220px; }
        .chart-card canvas{ max-height: 160px !important; }
    }
</style>


<div class="admin-dashboard">

    <!-- ===== Judul Statistik Status ===== -->
    <div class="section-head">
        <div class="section-left">
            <h3 class="section-title">Statistik Status Permintaan Uji</h3>
            <div class="section-subtitle">
                Ringkasan jumlah permintaan berdasarkan tahapan proses terbaru
            </div>
        </div>
    </div>

    <!-- ===== Statistik Kegiatan ===== -->
    <div class="stats-grid">
        <div class="stat-card"><div class="stat-circle"></div>
            <div class="stat-number">{{ $pemeriksaan }}</div>
            <div class="stat-label">Pemeriksaan Kelengkapan</div>
        </div>

        <div class="stat-card"><div class="stat-circle"></div>
            <div class="stat-number">{{ $tdkLengkap }}</div>
            <div class="stat-label">Persyaratan Tidak Lengkap</div>
        </div>

        <div class="stat-card"><div class="stat-circle"></div>
            <div class="stat-number">{{ $lengkap }}</div>
            <div class="stat-label">Persyaratan Lengkap</div>
        </div>

        <div class="stat-card"><div class="stat-circle"></div>
            <div class="stat-number">{{ $jadwalSampel }}</div>
            <div class="stat-label">Jadwal Pengambilan Sampel</div>
        </div>

        <div class="stat-card"><div class="stat-circle"></div>
            <div class="stat-number">{{ $ambilSampel }}</div>
            <div class="stat-label">Pengambilan Sampel</div>
        </div>

        <div class="stat-card"><div class="stat-circle"></div>
            <div class="stat-number">{{ $ujiSelesai }}</div>
            <div class="stat-label">Uji Selesai</div>
        </div>

        <div class="stat-card"><div class="stat-circle"></div>
            <div class="stat-number">{{ $verifikasi }}</div>
            <div class="stat-label">Verifikasi Hasil Uji</div>
        </div>

        <div class="stat-card"><div class="stat-circle"></div>
            <div class="stat-number">{{ $terbitLHU }}</div>
            <div class="stat-label">Penerbitan LHU</div>
        </div>
    </div>

    <!-- ===== Judul Grafik ===== -->
    <div class="section-head" style="margin-top:6px;">
        <div class="section-left">
            <h3 class="section-title">Grafik Tahunan</h3>
            <div class="section-subtitle">
                Perbandingan distribusi permintaan uji & akun customer per tahun
            </div>
        </div>
    </div>

    <!-- ===== Grafik Bersampingan ===== -->
    <div class="chart-grid">

        <div class="chart-card">
            <h4>Grafik Permintaan Uji per Tahun</h4>
            <canvas id="chartPermintaan"></canvas>
        </div>

        <div class="chart-card">
            <h4>Grafik Jumlah Akun Customer Terdaftar per Tahun</h4>
            <canvas id="chartAkun"></canvas>
        </div>

    </div>
</div>

{{-- simpan data blade dalam JSON --}}
<script type="application/json" id="dashboard-data">
{!! json_encode([
    'labels' => $labelTahun,
    'permintaan' => $dataPermintaanTahun,
    'akun' => $dataAkunTahun
]) !!}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const raw = document.getElementById('dashboard-data').textContent;
    const dashboardData = JSON.parse(raw);

    const labels = dashboardData.labels || [];
    const dataPermintaan = dashboardData.permintaan || [];
    const dataAkun = dashboardData.akun || [];

    // Palet warna kuat (buat bar yg ada data)
    const strongPermintaan = ['#f59e0b','#fb7185','#d946ef','#7c3aed','#5b21b6','#2563eb','#0ea5e9','#16a34a'];
    const strongAkun       = ['#16a34a','#22c55e','#4ade80','#10b981','#06b6d4','#0ea5e9','#6366f1','#a855f7'];

    // Palet soft (buat bar data 0)
    const softPalette = ['#e5e7eb','#eef2f7','#f1f5f9','#e2e8f0'];

    function hexToRgba(hex, alpha = 1){
        const h = hex.replace('#','');
        const r = parseInt(h.substring(0,2),16);
        const g = parseInt(h.substring(2,4),16);
        const b = parseInt(h.substring(4,6),16);
        return `rgba(${r},${g},${b},${alpha})`;
    }

    // bikin gradient per bar kaya contoh gambar
    function buildGradients(chart, values, strongPalette){
        const {ctx, chartArea} = chart;
        if(!chartArea) return strongPalette;

        return values.map((v,i)=>{
            const base = (!v || v === 0)
                ? softPalette[i % softPalette.length]
                : strongPalette[i % strongPalette.length];

            const g = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
            g.addColorStop(0, hexToRgba(base, 0.95)); // bawah lebih pekat
            g.addColorStop(1, hexToRgba(base, 0.35)); // atas lebih terang
            return g;
        });
    }

    function buildPointColors(values, strongPalette){
        return values.map((v,i)=>{
            if(!v || v===0) return '#cbd5e1';
            return strongPalette[i % strongPalette.length];
        });
    }

    function makeFancyBarLineChart(canvasId, values, strongPalette, labelText){
        const el = document.getElementById(canvasId);
        if(!el) return;

        const chart = new Chart(el, {
            data:{
                labels,
                datasets:[
                    // BAR DATASET
                    {
                        type:'bar',
                        label: labelText,
                        data: values,
                        backgroundColor: (context)=>{
                            const c = context.chart;
                            return buildGradients(c, values, strongPalette);
                        },
                        borderRadius: { topLeft: 14, topRight: 14, bottomLeft: 6, bottomRight: 6 },
                        borderSkipped: false,
                        barThickness: 34,
                        categoryPercentage: 0.7,
                        maxBarThickness: 42
                    },
                    // LINE TREND DATASET (mirip gambar)
                    {
                        type:'line',
                        label:'Trend',
                        data: values,
                        borderColor: '#9ca3af',
                        borderWidth: 2,
                        tension: 0.45,
                        fill: false,
                        pointRadius: 4.5,
                        pointHoverRadius: 6,
                        pointBorderWidth: 2,
                        pointBackgroundColor: buildPointColors(values, strongPalette),
                        pointBorderColor: '#ffffff'
                    }
                ]
            },
            options:{
                responsive:true,
                maintainAspectRatio:false,
                layout:{ padding:{ top: 8, left: 6, right: 8, bottom: 0 } },
                plugins:{
                    legend:{ display:false },
                    tooltip:{
                        backgroundColor:'#111827',
                        padding:10,
                        cornerRadius:10,
                        callbacks:{
                            label:(ctx)=> `${ctx.label}: ${ctx.raw ?? 0}`
                        }
                    }
                },
                scales:{
                    x:{
                        grid:{ display:false },
                        ticks:{
                            font:{ size:11, weight:'600' },
                            color:'#6b7280'
                        }
                    },
                    y:{
                        beginAtZero:true,
                        grid:{
                            color:'rgba(148,163,184,0.25)',
                            borderDash:[4,4]
                        },
                        ticks:{
                            precision:0,
                            font:{ size:11 },
                            color:'#94a3b8'
                        }
                    }
                }
            }
        });

        return chart;
    }

    // Render kedua chart dengan style yg sama kaya contoh
    makeFancyBarLineChart('chartPermintaan', dataPermintaan, strongPermintaan, 'Permintaan Uji');
    makeFancyBarLineChart('chartAkun', dataAkun, strongAkun, 'Akun Customer');
});
</script>


@endsection
