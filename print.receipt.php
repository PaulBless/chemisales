<?php

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <style>
            * {
                font-size: 16px;
                font-family: Segoe UI;
            }

            td,
            th,
            tr,
            table {
                border-collapse: collapse;
            }

            td.description,
            th.description {
                width: 75px;
                max-width: 75px;
            }

            td.quantity,
            th.quantity {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            td.price,
            th.price {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            .centered {
                text-align: center;
                align-content: center;
            }

            .ticket {
                width: 300px;
                max-width: 300px;
            }

            img {
                max-width: inherit;
                width: inherit;
            }

            @media print {
                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }
            }
        </style>
    </head>
    
    
    <body style="color:#000;font-family:monospace;font-size:12px" >

    <div class="ticket" id="printableArea">
           <center>
<img src="assets/images/pharmsolv-light.png" style=margin:0;width:100%;height:auto alt="..."/><br><small style=font-size:11px;color:#444>
rento pos -
address <br>city, country. - Phone 123456789
</center></small><br>
INVOICE # 90909998<br>
'sewa13' : 'namausers' <br>
'sewa11''tglsewa' / 4:24 PM <br>
'sewa12' : 'tglkembali'<br><br><br>
<table width="100%" style="color:#000;font-family:monospace;font-size:14px">
<thead>
<tr width="100%" style="border-top:1px solid #000;border-right:0;border-left:0;border-bottom:1px solid #000;border-style:dashed;font-family:monospace;padding:3px;font-weight:normal">

<th style="color:#000;font-family:monospace"class="description">'item1'</th>
<th style="color:#000;font-family:monospace"class="quantity"><center>'trans10'</center></th>
<th style="color:#000;font-family:monospace"class="price">'trans11'</th>
</tr>
</thead>
<?php 

//   $query = "SELECT * FROM keranjang where kodesewa='$kodesewa'";

// $select = mysqli_query($mysqli,$query);
// $nos=mysqli_fetch_array(mysqli_query($mysqli, "select sum(total) as total from keranjang where kodesewa='$kodesewa'"));
// $aaaa = $nos['total']; $mew = number_format($aaaa,0,",",".");
// 	while ($result = mysqli_fetch_array($select)) {
// $idproduct=$result['idproduct'];    
// $soq=mysqli_fetch_array(mysqli_query($mysqli, "select * from product where idproduct='$idproduct'"));

// $sultan=$result['total'];
// $sel=mysqli_fetch_array(mysqli_query($mysqli, "select * from sewa where kodesewa='$kodesewa'"));
// $hargadiskon=$sel['hargadiskon']; $kem = number_format($hargadiskon,0,",",".");
// $diskon=$sel['diskon'];
// $sidis=$diskon/100;
// $bundle=$sultan*$sidis;
// $bingas = $sultan-$bundle; $jen = number_format($bingas,0,",",".");
   ?>

<tr>
<td style="color:#000;font-family:monospace;font-size:14px"class="description"><small>['namaproduct']</small></td>
<td style="color:#000;font-family:monospace;font-size:14px"class="quantity"><center>['qty']</center></td>

<td style="color:#000;font-family:monospace;font-size:14px"class="price">['total']</td>

<td style="color:#000;font-family:monospace;font-size:14px"class="price">{bingas}</td>
	
</tr>

</table>
<table width="100%">
<tr width="100%" style="border-top:1px solid #000;border-right:0;border-left:0;border-bottom:1px solid #000;border-style:dashed;font-family:monospace;padding:3px;font-weight:normal">
<td style="color:#000;font-family:monospace"class="description">['trans11']</td>
<td style="color:#000;font-family:monospace"class="quantity" >:</td>
<td style="color:#000;font-family:monospace"class="description">ghc 555 ,- </td>
</tr>

<tr width="100%" style="border-top:1px solid #000;border-right:0;border-left:0;border-bottom:1px solid #000;border-style:dashed;font-family:monospace;padding:3px;font-weight:normal">
<td colspan='2' style="color:#000;font-family:monospace"class="description">Discount: ['keterangan_liburan']</td>
<td style="color:#000;font-family:monospace"class="description">['diskon'] %</td>
</tr>
<tr width="100%" style="border-top:1px solid #000;border-right:0;border-left:0;border-bottom:1px solid #000;border-style:dashed;font-family:monospace;padding:3px;font-weight:normal">
<td style="color:#000;font-family:monospace"class="description">['trans11'] </td>
<td style="color:#000;font-family:monospace"class="quantity" >:</td>
<td style="color:#000;font-family:monospace"class="description">['currency']990,- </td>
</tr>

</table>
<br><br>
<center>['trans25'] :['jaminan'] <br><br> ['trans27'] :  ['keterangan'] </center>

            <p class="centered"> ['slogan'] <small> ['thanks'] </small></p>
        </div>
        
        <button id="btnPrint" class="hidden-print">Print</button>
        <script >
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
                window.print();
            });
        </script>

        <script>
            $(document).ready(function() {

            // var printContents = document.getElementById('printableArea').innerHTML;
            var printContents = $('.ticket').innerHTML;
            
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            document.body.style.marginTop = "-10px";
            setTimeout(function() {
                window.print();
            }, 500);
            document.body.innerHTML = originalContents;

            setTimeout(function() {
                window.close();
            }, 500);
        })
        </script>
    </body>
</html>