```mermaid
flowchart TD
    Start([Mulai]) --> Studi[Studi Literatur & Analisis Kebutuhan]
    Studi --> Design[Perancangan Skenario Uji / Test Case]
    Design --> Config[Konfigurasi Lingkungan Pengujian]
    Config --> Scripting[Implementasi Kode Pengujian / Test Scripting]
    Scripting --> Execute[Eksekusi Pengujian (Laravel Dusk)]
    Execute --> Decision{Apakah Bug Ditemukan?}
    Decision -- Ya --> Log[Pencatatan Bug & Screen Capture]
    Decision -- Tidak --> Analyze[Analisis Hasil]
    Log --> Analyze
    Analyze --> Report[Penyusunan Laporan]
    Report --> Finish([Selesai])
```
