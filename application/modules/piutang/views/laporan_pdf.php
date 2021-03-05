<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
                font-size: 12px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }

            p{
              margin-top: 5px;
            }
            h4,h3{
              padding-bottom: 0;
              margin-bottom: 5px;
            }

        </style>
    </head>
    <body>
        <div style="text-align:center">
          <h1><?=setting('web_name')?></h1>
            <h3> <?= $title_pdf;?></h3>
            <p>Waktu Cetak <?=date("d/m/y H:i")?></p>
        </div>
        <table id="table">
            <thead>
                <tr>
                  <th>Data Pelanggan</th>
                  <th>Waktu Pemberian Utang</th>
                  <th>Estimasi Pembayaran</th>
                  <th>Jumlah</th>
                  <th>Bunga</th>
                  <th>Total</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($piutang as $dt): ?>
                <?php
                $total_percent = ($dt->bunga/100) * $dt->jumlah;
                $total = $dt->jumlah+$total_percent;
                 ?>
                <tr>
                  <td><?=$dt->nik?> - <?=$dt->nama?></td>
                  <td><?=date("d/m/Y H:i",strtotime($dt->waktu_utang))?></td>
                  <td><?=date("d/m/Y",strtotime($dt->estimasi_bayar))?></td>
                  <td>Rp.<?=number_format("$dt->jumlah", 0, "", ".")?></td>
                  <td>Rp.<?=number_format("$total_percent", 0, "", ".")?> (<?=$dt->bunga?>%)</td>
                  <td>Rp.<?=number_format("$total", 0, "", ".")?></td>
                  <td><?=$dt->status_pembayaran == "belum" ? "Belum Lunas":"Lunas"?></td>
                </tr>
              <?php endforeach; ?>

            </tbody>
        </table>
    </body>
</html>
