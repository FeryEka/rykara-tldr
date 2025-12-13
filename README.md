# 🚀 Rykara TL;DR (Tech & Gaming Blog)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind/Bootstrap](https://img.shields.io/badge/Tailwind-00B8DB?style=for-the-badge&logo=Tailwind&logoColor=white)
![Railway](https://img.shields.io/badge/Railway-131415?style=for-the-badge&logo=railway&logoColor=white)

> **"Too Long; Didn't Read"** – Platform blog simpel buat sharing berita teknologi & game tanpa basa-basi.

---

## 👋 About This Project

Halo! Project ini adalah hasil eksplorasi gua dalam membangun **Fullstack Web Application** menggunakan **Laravel**. Tujuan utamanya bukan cuma bikin blog, tapi memahami _flow_ deployment ke production dan integrasi 3rd party services.

Web ini sudah **Live Production** di Railway dan menggunakan custom domain.

🔗 **Live Demo:** [https://www.tldr-ry.web.id](https://www.tldr-ry.web.id)

---

## 🔥 Key Features

Fitur-fitur utama yang sudah jalan 100%:

-   **Authentication System:** Register, Login, & Logout (Laravel Breeze/UI).
-   **Email Verification:** Integrasi **Resend API** (Bye-bye SMTP timeout!). User baru wajib verifikasi email sebelum posting.
-   **Dashboard Management:** CRUD (Create, Read, Update, Delete) Postingan artikel.
-   **Slug Otomatis:** Judul artikel otomatis jadi slug URL yang SEO-friendly.
-   **Production Ready:** Deploy di **Railway** dengan Database MySQL terpisah.

---

## 📸 Screenshots

---

## 🛠️ Tech Stack

Project ini dibangun dengan "bumbu-bumbu" berikut:

-   **Framework:** Laravel 10/11
-   **Database:** MySQL
-   **Frontend:** Blade Templating + Flowbite Tailwind
-   **Deployment:** Railway (App & Database Service)
-   **Email Service:** Resend API (Custom Domain Verified)
-   **Version Control:** Git & GitHub

---

## 💡 Lessons Learned (Story Time)

Jujur, tantangan terbesar di project ini bukan di kodingan Laravel-nya, tapi di **Deployment & Mailing**.

1.  **The SMTP Drama:** Sempat frustasi karena Google SMTP (Port 465/587) diblokir terus sama firewall server cloud. Solusinya? Pindah haluan pakai **Resend API** via HTTP. _Works like a charm!_
2.  **Database Migration:** Belajar pentingnya `migrate --force` dan manajemen schema database di production biar data nggak ilang-ilangan.
3.  **DNS Propagation:** Belajar sabar nungguin DNS Verified biar email bisa kirim ke publik (SPF, DKIM, MX Records).

---

## 🗺️ Roadmap & Future Development

Project ini tidak berhenti di sini! Berikut adalah fitur-fitur prioritas yang sedang dalam tahap pengembangan (Work in Progress) untuk meningkatkan interaksi dan skalabilitas:

### 🛡️ Comment Moderation System (Anti-Toxic)
Agar kolom komentar tetap sehat dan bebas spam, sistem ini menggunakan alur moderasi:
* **Approval Workflow:** Setiap komentar baru dari user akan berstatus **Pending** (Hidden) secara default.
* **Author Control:** Penulis artikel memiliki menu khusus di Dashboard untuk meninjau komentar yang masuk.
* **Action:** Penulis berhak melakukan **Approve** (Tampilkan ke publik) atau **Delete** (Hapus) komentar tersebut.

### 🔐 Role-Based Access Control (RBAC)
Pemisahan hak akses yang lebih ketat menggunakan Laravel Gates/Policies:
* **Super Admin:** Mengelola Master Data (Categories, Tags) dan User Management.
* **Author:** Fokus pada konten kreator. Hanya bisa mengelola artikel dan komentar di postingan milik sendiri.

### 👥 User Management Dashboard
* Monitoring user terdaftar.
* Fitur **Suspend/Ban** untuk menindak user yang melanggar aturan komunitas.

### 🎨 UI/UX Improvements
* **Dark Mode Toggle:** Kenyamanan visual adalah prioritas (terutama untuk audiens Tech/Gaming).
* **Rich Text Editor:** Upgrade penulisan artikel agar mendukung formatting teks yang lebih ekspresif.

---

## 🚀 How to Run Locally

Mau coba jalanin di laptop sendiri? Gas ikuti langkah ini:

1.  **Clone Repo**

    ```bash
    git clone [https://github.com/FeryEka/rykara-tldr.git](https://github.com/FeryEka/rykara-tldr.git)
    cd nama-repo
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3.  **Setup .env**
    Copy file `.env.example` jadi `.env`

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Migrate Database**

    ```bash
    php artisan migrate --seed
    ```

5.  **Run Server**
    ```bash
    php artisan serve
    ```
    Buka `http://localhost:8000`

---

## 🤝 Contact

Author: **Fery Eka Mahendra (Rykara)**

-   LinkedIn: [\[Link LinkedIn\]](linkedin.com/in/feryekamahendra/)
-   Email: ferrh.mahendra@gmail.com

---

_Happy Coding! ☕_
