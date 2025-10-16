<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - eTicketingKapal</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS Tambahan Khusus Admin Page (sama seperti di admin.php) */
        .admin-section {
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .admin-section h3 {
            color: #007bff;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .form-group-admin {
            margin-bottom: 15px;
        }
        .form-group-admin label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group-admin input[type="text"],
        .form-group-admin input[type="date"],
        .form-group-admin input[type="time"],
        .form-group-admin select {
            width: calc(100% - 22px); /* adjust for padding and border */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group-admin button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .form-group-admin button:hover {
            background-color: #0056b3;
        }
        .action-buttons a, .action-buttons button {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            margin-right: 5px;
            font-size: 0.9em;
            cursor: pointer;
            border: none;
            display: inline-block; /* Agar bisa diatur margin */
        }
        .action-buttons .edit-btn { background-color: #ffc107; } /* Kuning */
        .action-buttons .edit-btn:hover { background-color: #e0a800; }
        .action-buttons .delete-btn { background-color: #dc3545; } /* Merah */
        .action-buttons .delete-btn:hover { background-color: #c82333; }
        .action-buttons .add-btn { background-color: #28a745; margin-bottom: 15px;} /* Hijau */
        .action-buttons .add-btn:hover { background-color: #218838; }

        /* Pesan-pesan ini biasanya diisi oleh backend */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }