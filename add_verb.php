<!DOCTYPE html>
<html>
<head>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Повтори эти гребанные глаголы ленивая скотина!</title>
  <meta charset='UTF-8'>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

require 'includes/dbconf.php';

if ( isset($_POST['eu_verb']) ) {
  $arr = array();
  $arr_verb = array();
  $arr_translation = array();

  array_push( $arr, $_POST['eu'] );
  array_push( $arr_verb, $_POST['eu_verb'] );
  array_push( $arr_translation, $_POST['eu_translation'] );

  array_push( $arr, $_POST['tu'] );
  array_push( $arr_verb, $_POST['tu_verb'] );
  array_push( $arr_translation, $_POST['tu_translation'] );

  array_push( $arr, $_POST['el'] );
  array_push( $arr_verb, $_POST['el_verb'] );
  array_push( $arr_translation, $_POST['el_translation'] );

  array_push( $arr, $_POST['noi'] );
  array_push( $arr_verb, $_POST['noi_verb'] );
  array_push( $arr_translation, $_POST['noi_translation'] );

  array_push( $arr, $_POST['voi'] );
  array_push( $arr_verb, $_POST['voi_verb'] );
  array_push( $arr_translation, $_POST['voi_translation'] );

  array_push( $arr, $_POST['ei'] );
  array_push( $arr_verb, $_POST['ei_verb'] );
  array_push( $arr_translation, $_POST['ei_translation'] );
  
  for ($i = 0; $i < 6; $i = $i + 1) {
    mysql_query("INSERT INTO verbs(verb_face,verb_word,verb_translation) VALUES ('$arr[$i]', '$arr_verb[$i]', '$arr_translation[$i]');");
  }
  echo 'Добавленно!';
}
?>

  <form action='add_verb.php' method='post'>
    <table>
      <tr>
        <th>Местоим.</th>
        <th>Глагол</th>
        <th>Перевод</th>
      </tr>

      <tr>
        <td><input name='eu' type='text' value='eu' hidden>eu</td>
        <td><input name='eu_verb' type='text' required></td>
        <td><input name='eu_translation' type='text' required></td>
      </tr>

      <tr>
        <td><input name='tu' type='text' value='tu' hidden>tu</td>
        <td><input name='tu_verb' type='text' required></td>
        <td><input name='tu_translation' type='text'required></td>
      </tr>

      <tr>
        <td><input name='el' type='text' value='el,ea' hidden>el,ea</td>
        <td><input name='el_verb' type='text' required></td>
        <td><input name='el_translation' type='text' required></td>
      </tr>

      <tr>
        <td><input name='noi' type='text' value='noi' hidden>noi</td>
        <td><input name='noi_verb' type='text' required></td>
        <td><input name='noi_translation' type='text' required></td>
      </tr>

      <tr>
        <td><input name='voi' type='text' value='voi' hidden>voi</td>
        <td><input name='voi_verb' type='text' required></td>
        <td><input name='voi_translation' type='text' required></td>
      </tr>

      <tr>
        <td><input name='ei' type='text' value='ei,ele' hidden>ei, ele</td>
        <td><input name='ei_verb' type='text' required></td>
        <td><input name='ei_translation' type='text' required></td>
      </tr>

    </table>
    <input class='verb-button' type='submit'>
  </form>



</body>
</html>
