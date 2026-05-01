<?php
// ============================================================
// File No. 5 - views/list.php
// Tampilan daftar buku — Tema Emerald Hijau
// ============================================================

$notif = $_GET['notif'] ?? "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku | Perpustakaan PBO</title>
    <meta name="description" content="Sistem manajemen data buku perpustakaan berbasis OOP PHP">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(160deg, #022c22 0%, #064e3b 100%);
            min-height: 100vh;
            color: #d1fae5;
        }

        /* ── Header ── */
        .header {
            background: rgba(255,255,255,0.03);
            border-bottom: 1px solid rgba(110,231,183,0.1);
            padding: 18px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-logo {
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 16px rgba(16,185,129,0.45);
        }

        .brand-text h1 {
            font-size: 17px;
            font-weight: 800;
            color: #ecfdf5;
        }

        .brand-text h1 span { color: #34d399; }

        .brand-text p {
            font-size: 11px;
            color: #4b7c6e;
            margin-top: 2px;
        }

        /* ── Container ── */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* ── Notifikasi ── */
        .notif {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 26px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .notif-success {
            background: rgba(16,185,129,0.12);
            border: 1px solid rgba(16,185,129,0.3);
            color: #6ee7b7;
        }

        .notif-danger {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
        }

        /* ── Top Bar ── */
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .top-bar h2 {
            font-size: 26px;
            font-weight: 800;
            color: #ecfdf5;
        }

        .top-bar h2 span { color: #34d399; }

        .badge {
            display: inline-block;
            background: rgba(16,185,129,0.15);
            color: #34d399;
            border: 1px solid rgba(16,185,129,0.3);
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-left: 10px;
            vertical-align: middle;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(16,185,129,0.4);
            letter-spacing: 0.02em;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16,185,129,0.55);
        }

        /* ── Tabel ── */
        .table-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(110,231,183,0.1);
            border-radius: 20px;
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }

        thead {
            background: rgba(16,185,129,0.08);
            border-bottom: 1px solid rgba(110,231,183,0.1);
        }

        th {
            padding: 16px 22px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #34d399;
        }

        td {
            padding: 16px 22px;
            font-size: 14px;
            color: #a7f3d0;
            border-bottom: 1px solid rgba(110,231,183,0.06);
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tbody tr { transition: background 0.2s ease; }
        tbody tr:hover { background: rgba(16,185,129,0.04); }

        .col-no {
            color: #4b7c6e;
            font-size: 13px;
            font-weight: 700;
            width: 60px;
        }

        .col-judul {
            font-weight: 700;
            color: #ecfdf5;
        }

        .pengarang-badge {
            display: inline-block;
            background: rgba(16,185,129,0.12);
            color: #6ee7b7;
            border: 1px solid rgba(16,185,129,0.22);
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ── Tombol Aksi ── */
        .action-col { display: flex; gap: 8px; }

        .btn-edit, .btn-hapus {
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-edit {
            background: rgba(251,191,36,0.12);
            color: #fbbf24;
            border: 1px solid rgba(251,191,36,0.25);
        }

        .btn-edit:hover {
            background: rgba(251,191,36,0.25);
            transform: translateY(-1px);
        }

        .btn-hapus {
            background: rgba(239,68,68,0.12);
            color: #f87171;
            border: 1px solid rgba(239,68,68,0.25);
        }

        .btn-hapus:hover {
            background: rgba(239,68,68,0.25);
            transform: translateY(-1px);
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center;
            padding: 70px 20px;
        }

        .empty-state .empty-icon { font-size: 54px; margin-bottom: 16px; opacity: 0.5; }
        .empty-state p { font-size: 15px; color: #4b7c6e; margin-bottom: 24px; }

        /* ── Footer ── */
        .footer {
            text-align: center;
            padding: 30px;
            color: #1f5443;
            font-size: 12px;
            margin-top: 16px;
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="brand">
            <div class="brand-logo">📚</div>
            <div class="brand-text">
                <h1>Perpustakaan <span>PBO</span></h1>
                <p>Sistem Manajemen Data Buku Berbasis Objek</p>
            </div>
        </div>
    </header>

    <main class="container">

        <?php if ($notif === 'tambah'): ?>
            <div class="notif notif-success">✅ Buku berhasil ditambahkan ke katalog.</div>
        <?php elseif ($notif === 'edit'): ?>
            <div class="notif notif-success">✏️ Data buku berhasil diperbarui.</div>
        <?php elseif ($notif === 'hapus'): ?>
            <div class="notif notif-danger">🗑️ Buku berhasil dihapus dari katalog.</div>
        <?php endif; ?>

        <div class="top-bar">
            <div>
                <h2>
                    Katalog <span>Buku</span>
                    <span class="badge"><?= $data->num_rows ?> Judul</span>
                </h2>
            </div>
            <a href="views/tambah.php" class="btn-add">➕ Tambah Buku</a>
        </div>

        <div class="table-card">
            <?php if ($data->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $data->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="col-no"><?= $no++ ?></td>
                        <td class="col-judul">
                            📖 <?= htmlspecialchars($row['judul']) ?>
                        </td>
                        <td>
                            <span class="pengarang-badge">
                                ✍️ <?= htmlspecialchars($row['pengarang']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-col">
                                <a href="views/edit.php?id=<?= $row['id'] ?>"
                                   class="btn-edit">✏️ Edit</a>
                                <a href="index.php?hapus=<?= $row['id'] ?>"
                                   class="btn-hapus"
                                   onclick="return confirm('Hapus buku: <?= htmlspecialchars($row['judul']) ?>?')">
                                   🗑️ Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <p>Katalog masih kosong. Belum ada buku yang ditambahkan.</p>
                <a href="views/tambah.php" class="btn-add">➕ Tambah Buku Pertama</a>
            </div>
            <?php endif; ?>
        </div>

    </main>

    <footer class="footer">
        <p>Perpustakaan PBO Parsha &copy; <?= date('Y') ?> — Praktikum Manajemen Data Berbasis Objek</p>
    </footer>

</body>
</html>
