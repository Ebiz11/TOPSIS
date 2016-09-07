<?php
spl_autoload_register(function($class){
  require_once $class.'.php';
});

$topsis = new Topsis();
 ?>

<!-- ############################################# Tampil Data Kriteria ######################################################### -->

<h2>Kriteria</h2>
<table border="1" cellspacing="0" width="400" height="200">
  <tr>
    <th>No</th>
    <th>Nama Kriteria</th>
    <th>Jenis</th>
    <th>Bobot</th>
  </tr>

  <?php
    $no=1;
    $kriteria = $topsis->get_data_kriteria();
    $jml_kriteria = $kriteria->rowCount();
    while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>

  <tr>
    <td>C<?php echo $data_kriteria['id_kriteria']; ?></td>
    <td><?php echo $data_kriteria['nama_kriteria']; ?></td>
    <td><?php echo $data_kriteria['jenis']; ?></td>
    <td><?php echo $data_kriteria['bobot']; ?></td>
  </tr>

  <?php } ?>
</table>

<!-- ######################################################################################################################################### -->
<br><br><hr>

<!-- ############################################# Tampil Data Produk ######################################################### -->
<h2>Produk</h2>
<table border="1" cellspacing="0" width="400" height="200">
  <tr>
    <th>No</th>
    <th>Nama Produk</th>
    <th>Detail</th>
  </tr>

  <?php
    $no=1;
    $produk = $topsis->get_data_produk();
    while ($data_produk = $produk->fetch(PDO::FETCH_ASSOC)) {
  ?>
  <tr>
    <td>K<?php echo $data_produk['id_produk']; ?></td>
    <td><?php echo $data_produk['nama_produk']; ?></td>
    <td><?php echo $data_produk['detail']; ?></td>
  </tr>

<?php } ?>
</table>

<!-- ######################################################################################################################################### -->
<br><br><hr>

<!-- ############################################# Tampil Data Produk Kriteria ######################################################### -->
<h2>Produk Kriteria</h2>
<table border="1" cellspacing="0" height="200" width="600">

  <tr>
    <th rowspan="2">Produk</th>
    <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
  <tr>
  <?php
  $kriteria = $topsis->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <th>C<?php echo $data_kriteria['id_kriteria']; ?></th>

  <?php } ?>
  </tr>

  <?php
  $produk = $topsis->get_data_produk();
  while ($data_produk = $produk->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
      <td><center>K<?php echo $data_produk['id_produk']; ?></center></td>
      <?php
      $nilai = $topsis->get_data_nilai_id($data_produk['id_produk']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) { ?>
        <td><center><?php echo $data_nilai['nilai']; ?></center></td>

      <?php } ?>
    </tr>

  <?php } ?>
</table>

<!-- ##################################################################################################################### -->
<br><br><hr>

<!-- ############################################# Matrik Ternormalisasi ######################################################### -->
<h2>Matrik Ternormalisasi</h2>
<table border="1" cellspacing="0" height="200" width="1200">

  <tr>
    <th rowspan="2">Produk</th>
    <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
  <tr>
  <?php
  $kriteria = $topsis->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <th>C<?php echo $data_kriteria['id_kriteria']; ?></th>

  <?php } ?>
  </tr>

  <?php
  $produk = $topsis->get_data_produk();
  while ($data_produk = $produk->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
      <td><center>K<?php echo $data_produk['id_produk']; ?></center></td>
      <?php
      $nilai = $topsis->get_data_nilai_id($data_produk['id_produk']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
      $pembagi = $topsis->pembagi($data_nilai['id_kriteria']);
      ?>
      <td><center><?php echo $hasil=$data_nilai['nilai']/$pembagi; ?></center></td>

    <?php } ?>
    </tr>
  <?php  } ?>

</table>
<!-- ######################################################################################################### -->

<br><br><hr>
<!-- #########################################  Pembobotan  ###################################### -->

<h2>Pembobotan Matrik Ternormalisasi</h2>
<table border="1" cellspacing="0" height="200" width="1200">

  <tr>
    <th rowspan="2">Produk</th>
    <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
  <tr>
  <?php
  $kriteria = $topsis->get_data_kriteria();
  while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <th>C<?php echo $data_kriteria['id_kriteria']; ?></th>

  <?php } ?>
  </tr>

  <?php
  $max_min=array();
  // $_hasil_pembobotan=array();

  $produk = $topsis->get_data_produk();
  while ($data_produk = $produk->fetch(PDO::FETCH_ASSOC)) {
  ?>
    <tr>
      <td><center>K<?php echo $data_produk['id_produk']; ?></center></td>
      <?php

      $nilai = $topsis->get_data_nilai_id($data_produk['id_produk']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
        $pembagi = $topsis->pembagi($data_nilai['id_kriteria']);
      ?>
      <td>
        <center>
          <?php
            $hasil=$data_nilai['nilai']/$pembagi;
            // pembobotan
            $bobot=$topsis->get_data_kriteria_id($data_nilai['id_kriteria']);
            while ($data_bobot = $bobot->fetch(PDO::FETCH_ASSOC)) {
              $pembobotan=$hasil*$data_bobot['bobot'];
              echo $pembobotan;
              // $max_mins['nilai']= $data_nilai['nilai'];
              $max_mins['pembobotan']= $pembobotan;
              $max_mins['id_kriteria']= $data_nilai['id_kriteria'];
              $max_mins['id_produk']= $data_produk['id_produk'];
              array_push($max_min,$max_mins);


            }
            // end pembobotan
            // print_r($max_min);

           ?>
         </center>
       </td>
    <?php } ?>
    </tr>
  <?php  } ?>

</table>
<br><br>
<hr>

<?php
// print_r($max_min);

foreach ($max_min as $insert_data) {
  $topsis->insert_data_max_min($insert_data['id_kriteria'], $insert_data['pembobotan']);
}

$data_hasil_min_max=array();
$data= $topsis->min_max();
while ($data_min_max=$data->fetch(PDO::FETCH_ASSOC)){
 // print_r($data_min_max);
 $data_hasil_min_maxs['id_kriteria']= $data_min_max['id_kriteria'];
 $data_hasil_min_maxs['min']= $data_min_max['min'];
 $data_hasil_min_maxs['max']= $data_min_max['max'];
 array_push($data_hasil_min_max,$data_hasil_min_maxs);

}

$topsis->delete_min_max();
// print_r($data_hasil_min_max);
// print_r($max_min);
 ?>

<h2>Min Max</h2>
 <table border="1" cellspacing="0">
   <tr>
     <th>Id Kriteria</th>
     <th>Min</th>
     <th>Max</th>
   </tr>

<?php foreach ($data_hasil_min_max as $data) { ?>

   <tr>
     <td>C<?php echo $data['id_kriteria']; ?></td>
     <td><?php echo $data['min']; ?></td>
     <td><?php echo $data['max']; ?></td>
   </tr>
   <?php } ?>
 </table>
</table>
<br><br>

<hr><br>

<h2>Hasil Pangkat</h2>

<table border="1" cellspacing="0">
  <tr>
    <th>Id Produk</th>
    <th>Id Kriteria</th>
    <th>Hasil Pangkat</th>
  </tr>
<?php foreach ($max_min as $row) { ?>
  <tr>
    <td><?php echo $row['id_produk']; ?></td>
    <td><?php echo $row['id_kriteria']; ?></td>
    <td><?php  $row['pembobotan']; ?>
    <?php foreach ($data_hasil_min_max as $data) {
      if ($row['id_kriteria']==$data['id_kriteria']) {
        $hasil=$data['max']-$row['pembobotan'];
        $pangkat=pow($hasil,2);

      }
    }
    echo number_format($pangkat,2);
    ?>
    </td>
  </tr>
  <?php } ?>
</table>
<br><br><br>

<table border="1" cellspacing="0" width="400" height="200">
  <tr>
    <th>Id Produk</th>
    <th>D+</th>
    <th>D-</th>
    <th>V1</th>
  </tr>

<?php
$ranking_array=array();
$produk = $topsis->get_data_produk();
while ($data_produk = $produk->fetch(PDO::FETCH_ASSOC)) {

?>
<tr>
<td>
  <?php echo $data_produk['nama_produk']; ?>
</td>
<?php
$nilai_d_plus=0;
$nilai_d_min=0;
    foreach ($max_min as $row) {
       foreach ($data_hasil_min_max as $data) {
          if ($row['id_kriteria']==$data['id_kriteria']) {
            $hasil_plus=$data['max']-$row['pembobotan'];
            $hasil_min=$data['min']-$row['pembobotan'];
            $pangkat_plus=pow($hasil_plus,2);
            $pangkat_min=pow($hasil_min,2);
          }
        }
      if ($data_produk['id_produk']==$row['id_produk']) {
        $nilai_d_plus=$nilai_d_plus+$pangkat_plus;
        $nilai_d_min=$nilai_d_min+$pangkat_min;
      }
    }
  ?>
  <td>
    <?php
    echo number_format($nilai_d_plus,2); ?>
  </td>
  <td>
    <?php
    echo number_format($nilai_d_min,2); ?>
  </td>
  <td>
    <?php
    $bagi=$nilai_d_min+$nilai_d_plus;
    echo $nilai_v=number_format($nilai_d_min/$bagi,2); ?>
  </td>
    <?php
    $ranking_arrays['nilai_v'] = $nilai_v;
    $ranking_arrays['nama_produk'] =  $data_produk['nama_produk'];
    array_push($ranking_array,$ranking_arrays);
    ?>
</tr>
<?php } ?>
</table>
<br><br>
<hr>

<h2>Ranking</h2>
<table border="1" cellspacing="0" width="400" height="200">
  <tr>
    <th>Ranking</th>
    <th>Nama Produk</th>
    <th>Nilai</th>
  </tr>
<?php
$no=1;
rsort($ranking_array);
foreach ($ranking_array as $ranking) {
  ?>
  <tr>
    <td>
      <?php echo $no++; ?>
    </td>
    <td><?php echo $ranking['nama_produk']; ?></td>
    <td><?php echo $ranking['nilai_v']; ?></td>
  </tr>
  <?php } ?>
</table>

<center>Lustria Ebis -  <?php echo date("Y"); ?> </center>
<br><br>
