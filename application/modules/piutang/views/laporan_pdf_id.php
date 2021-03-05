<?php
$total_percent = ($dt->bunga/100) * $dt->jumlah;
$total = $dt->jumlah+$total_percent;
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style>
        #table-data th{
          width: 200px;
        }
        #table-data th,td{
          padding: 2px;
          text-align:left;
          font-size: 13px;
          color:#1d1d1d;
        }
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

            /* #table tr:nth-child(even){background-color: #f2f2f2;} */

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                /* background-color: #4CAF50; */
                color: #212121;
                width: 200px;
            }
            h1{
              margin: 0;
            }

            p{
              margin-top: 5px;
            }
            h4,h3{
              margin-top: 5px;
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

        <h4 style="">Data Pelanggan</h4>
        <table id="table-data">
          <tr>
            <th>Nik</th>
            <td>: <?=$dt->nik?></td>
          </tr>

          <tr>
            <th>Nama</th>
            <td>: <?=$dt->nama?></td>
          </tr>

          <tr>
            <th>Tempat, Tanggal lahir</th>
            <td>: <?=$dt->tempat_lahir?>, <?=date("d-m-Y",strtotime($dt->tanggal_lahir))?></td>
          </tr>

          <tr>
            <th>Jenis Kelamin</th>
            <td>: <?=$dt->jenis_kelamin?></td>
          </tr>

          <tr>
            <th>Alamat</th>
            <td>: <?=$dt->alamat?></td>
          </tr>

          <tr>
            <th>Telepon</th>
            <td>: <?=$dt->telepon?></td>
          </tr>

            </tbody>
        </table>

        <h4 style="margin-top:20px;">Data Piutang</h4>

        <table id="table-data">
          <tbody>
            <tr>
              <th>Waktu Pemberian Utang</th>
              <td>: <?=date("d/m/Y H:i",strtotime($dt->waktu_utang))?></td>
            </tr>


            <tr>
              <th>Estimasi Pembayaran</th>
              <td>: <?=date("d/m/Y",strtotime($dt->estimasi_bayar))?></td>
            </tr>

            <tr>
              <th>Jumlah</th>
              <td>: Rp.<?=number_format("$dt->jumlah", 0, "", ".")?></td>
            </tr>

            <tr>
              <th>Bunga</th>
              <td>: Rp.<?=number_format("$total_percent", 0, "", ".")?> (<?=$dt->bunga?>%)</td>
            </tr>

            <tr>
              <th>Total</th>
              <td>: Rp.<?=number_format("$total", 0, "", ".")?></td>
            </tr>

            <tr>
              <th>Status Lunas</th>
              <td>: <?=$dt->status_pembayaran == "belum" ? "Belum Lunas":"Lunas"?></td>
            </tr>

          </tbody>
        </table>

        <h4 style="margin-top:20px;">Data Pembayaran</h4>
        <table id="table">
          <thead>
            <tr>
              <th style="width:10px">No</th>
              <th>Waktu Pembayaran</th>
              <th>Jumlah</th>
            </tr>
          </thead>

          <tbody>
          <?php if ($pembayaran->num_rows() > 0): ?>
            <?php $no=1;foreach ($pembayaran->result() as $row): ?>
              <tr>
                <td><?=$no++?></td>
                <td><?=date("d/m/Y H:i",strtotime($row->waktu_pembayaran))?></td>
                <td>Rp.<?=number_format("$row->jumlah_pembayaran", 0, "", ".")?></td>
              </tr>

            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" style="text-align:center"><i>Belum pernah membayar</i></td>
            </tr>
          <?php endif; ?>
            <tr style="background-color:#c1c1c1;font-weight:bold">
              <td colspan="2" style="text-align:center">Total</td>
              <td>Rp.<?=number_format("$total_pembayaran", 0, "", ".")?></td>
            </tr>
          </tbody>
        </table>
    </body>
</html>
