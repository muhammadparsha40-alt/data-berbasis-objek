<?php
// ============================================================
// File No. 4 - edit.php
// Halaman untuk mengedit data buku — Tema Emerald
// ============================================================

require_once "../controllers/BukuController.php";

$controller = new BukuController();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id   = (int)$_GET['id'];
$data = $controller->show($id);
$row  = $data->fetch_assoc();

if (!$row) {
    header("Location: ../index.php");
    exit();
}

$pesan = "";
if (isset($_POST['update'])) {
    $judul     = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);

    if (!empty($judul) && !empty($pengarang)) {
        $controller->update($id, $judul, $pengarang);
        header("Location: ../index.php?notif=edit");
        exit();
    } else {
        $pesan = "Judul dan Pengarang tidak boleh kosong!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Buku | Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #022c22 0%, #064e3b 50%, #065f46 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(110,231,183,0.15);
            border-radius: 24px;
            padding: 44px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        }

        .card-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .icon-wrap {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 26px;
            box-shadow: 0 8px 24px rgba(16,185,129,0.4);
        }

        .card-header h2 {
            color: #ecfdf5;
            font-size: 22px;
            font-weight: 700;
        }

        .card-header p {
            color: #6ee7b7;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert-error {
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.35);
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .form-group { margin-bottom: 22px; }

        label {
            display: block;
            color: #a7f3d0;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.03em;
        }

        input[type="text"] {
            width: 100%;
            padding: 13px 16px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(110,231,183,0.2);
            border-radius: 12px;
            color: #ecfdf5;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #10b981;
            background: rgba(255,255,255,0.1);
            box-shadow: 0 0 0 3px rgba(16,185,129,0.2);
        }

        input[type="text"]::placeholder { color: #4b7c6e; }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: 0.02em;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            box-shadow: 0 4px 15px rgba(16,185,129,0.4);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16,185,129,0.55);
        }

        .btn-cancel {
            background: rgba(255,255,255,0.07);
            color: #a7f3d0;
            border: 1px solid rgba(110,231,183,0.2);
        }

        .btn-cancel:hover {
            background: rgba(255,255,255,0.13);
            color: #ecfdf5;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="icon-wrap">✏️</div>
            <h2>Edit Data Buku</h2>
            <p>Perbarui informasi buku di bawah ini</p>
        </div>

        <?php if ($pesan): ?>
            <div class="alert-error">⚠️ <?= $pesan ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="judul">📖 Judul Buku</label>
                <input type="text" id="judul" name="judul"
                       value="<?= htmlspecialchars($row['judul']) ?>"
                       placeholder="Masukkan judul buku..." required>
            </div>

            <div class="form-group">
                <label for="pengarang">✍️ Pengarang</label>
                <input type="text" id="pengarang" name="pengarang"
                       value="<?= htmlspecialchars($row['pengarang']) ?>"
                       placeholder="Masukkan nama pengarang..." required>
            </div>

            <div class="btn-group">
                <a href="../index.php" class="btn btn-cancel">← Batal</a>
                <button type="submit" name="update" class="btn btn-success">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>
