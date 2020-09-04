<html>

<head>
    <title>Cetak PDF</title>
    <style>
        .header {
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            line-height: 30px;
        }

        table {
            width: 90%;
            margin-left: 5%;
            margin-right: 5%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        table th {
            text-align: center;
        }

        table td {
            text-align: justify;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <div class="header">hahah</div>
    <table>
        <tr>
            <th style="width: 2%;">No</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga</th>
            <th style="width: 10%">Jenis</th>
        </tr>
        <?php
        include '../../connections/connection_db.php';
        include '../../connections/tgl_indo.php';
        $no=1;
        $query = mysqli_query($con,"SELECT * FROM surat_masuk INNER JOIN file on surat_masuk.no_surat=file.no_surat ORDER BY file.tgl_masuk desc");
        while ($d = mysqli_fetch_array($query)) {  
          $tgl_surat=$d['tgl_surat'];
          $tgl_masuk=$d['tgl_masuk'];
          ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $d['no_surat']  . '<br>' . strtolower($d['perihal']) ?></td>
            <td><?php echo $d['pengirim']; ?></td>
            <td><?php echo tgl_indo(date('d-m-Y',strtotime($tgl_masuk))) ?></td>
        </tr>
    <?php $no++; } ?>
        </table>
    </body>

    </html>