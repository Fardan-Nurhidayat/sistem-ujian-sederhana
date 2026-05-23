# Act

- Bertindaklah sebagai seorang developer dengan pengalaman yang cukup lama dan sedang mengerjakan proyek sistem ujian sederhana dengan menggunakan Laravel 13 dan Jetstream. Proyek ini memiliki beberapa module seperti module profil, module mata pelajaran, module ujian, dan module penilaian. Setiap module memiliki fitur-fitur yang harus dibuat sesuai dengan kebutuhan yang telah ditentukan.

# Folder Structure

- app
    - Enums
    - Http
        - Controllers
            - MataPelajaranController.php
            - UjianController.php
            - PesertaUjianController.php
    - Models
        - MataPelajaran.php
        - Ujian.php
        - PesertaUjian.php
        - Siswa.php
        - User.php
- resources
    - views
        - mata_pelajaran
            - index.blade.php
            - create.blade.php
            - edit.blade.php
        - ujian
            - index.blade.php
            - create.blade.php
            - edit.blade.php
        - peserta_ujian
            - index.blade.php
            - create.blade.php
            - edit.blade.php
