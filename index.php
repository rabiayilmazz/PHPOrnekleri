<?php
include("db.php");

if (isset($_POST["ad"])) {

  if($_POST["sehir"] == "" ) {
    $HataMesaji[] = "Şehir seçimi yapılmamış !";
  }

  if($_POST["parola"] == "" ) {
    $HataMesaji[] = "Parola girilmemiş !";
  }

  if($_POST["soyad"] == "" ) {
    $HataMesaji[] = "Soyad girilmemiş !";
  }
  if($_POST["mail"] == "" ) {
    $HataMesaji[] = "ePosta girilmemiş !";
  }

  $SQL = "SELECT * FROM uye WHERE mail = '{$_POST["mail"]}' ";
  $rows  = mysqli_query($db, $SQL);

  $KayitSayisi = mysqli_num_rows($rows);
  if ($KayitSayisi != 0) {
    $HataMesaji[] = "Bu Hesap Zaten Kayıtlı !";
  }

  if (!isset($HataMesaji)) {
    $SQL = sprintf("
        INSERT INTO
          uye
        SET
          ad       = '%s',
          soyad    = '%s',
          mail     = '%s',
          parola   = '%s',
          gender   = '%s',
          sehir    = '%s',
          dil      ='%s'  ",
    $_POST["ad"],
    $_POST["soyad"],
    $_POST["mail"],
    md5($_POST["parola"]),
    $_POST["gender"],
    $_POST["sehir"],
    implode(", ", $_POST["dil"]));

    $rows  = mysqli_query($db, $SQL);

    echo "<h4 style='color:green'>Kayıt eklendi...</h4>";
  }
}
?>

<h3 style="color:red">
  <?php
    for ($i=0; $i < count($HataMesaji); $i++) {
      echo $HataMesaji[$i] . "<br />";
    }
  ?>
</h3>

<link rel="stylesheet" href="index.css">
<br /><br />

<div class="form" autocomplete="off">
  <h3>YENİ KAYIT</h3>
    <form class="" action="index.php" autocomplete="off" method="post">
      <input type="text" name="ad" placeholder="Adınızı giriniz" /><br />
      <input type="text" name="soyad" placeholder="Soyadınızı giriniz" /><br />
      <input type="text" name="mail" placeholder="Mail adresinizi giriniz" /><br />
      <input type="password" name="parola" placeholder="Parolanızı giriniz" /><br />

      <table>
        <tr>
          <td>
            <p>Cinsiyetinizi Seçiniz</p>
          </td>
          <td>
            <div class="">
              <input type="radio" name="gender" value="Kadın" />Kadın<br />
              <input type="radio" name="gender" value="Erkek" />Erkek<br />
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <p>Şehir Seçiniz</p>
          </td>
          <td>
            <select name="sehir">
              <option value="Ankara">Ankara</option>
              <option value="İstanbul">İstanbul</option>
              <option value="İzmir">İzmir</option>
              <option value="Bursa">Bursa</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <p>Bildiğiniz Diller</p>
          </td>
          <td>
            <input type="checkbox" name="dil[]" value="html" />html<br />
            <input type="checkbox" name="dil[]" value="css" />css<br />
            <input type="checkbox" name="dil[]" value="js" />js<br />
            <input type="checkbox" name="dil[]" value="php" />php<br />
            <input type="checkbox" name="dil[]" value="java" />java<br />
            <input type="checkbox" name="dil[]" value="c++" />c++<br />
          </td>
        </tr>
      </table>
      <div class="button">
        <input type="submit" value="Kayıt Yap" />
        <input type="reset" value="Sil" />
      </div>
    </form>
</div>
