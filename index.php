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

  /* найти минимальное число из счетчика повторений глагола в базе 'verb_use'*/
  $verbs_min_use = mysql_query("SELECT MIN(verb_use) FROM verbs;"); /* SELECT * FROM verbs where verb_use=(SELECT MIN(verb_use) FROM verbs); */
  $verbs_min_use_arr = mysql_fetch_array($verbs_min_use);
  $verbs_use_min_number = $verbs_min_use_arr['MIN(verb_use)'];

  /* находим минимально повторенные глаголы и и добавляеем их id-шки в массив кторый будет использоваться в "лотерее"*/
  $verbs_lottery_arr = array();
  $verbs_result = mysql_query("SELECT * FROM verbs WHERE verb_use=$verbs_use_min_number;"); // SELECT * FROM verbs WHERE verb_use=$verbs_use_min_number;

  while ( $verbs_arr = mysql_fetch_array($verbs_result) ) {
    $verb_id = $verbs_arr['verb_id'];
    array_push($verbs_lottery_arr, $verb_id);
  }

  /* выбираем рендомно один id глагола и находим его в таблице*/
  $verbs_lottery_arr_length = count($verbs_lottery_arr);
  $verb_rand_number = mt_rand(0, $verbs_lottery_arr_length - 1);

  $your_verb_id = $verbs_lottery_arr[$verb_rand_number];
  $result_for_your_verb = mysql_query("SELECT * FROM verbs WHERE verb_id=$your_verb_id;");
  $arr_for_your_verb = mysql_fetch_array($result_for_your_verb);

  /* выводим эти глаголы на страницу */
  $verb_face = $arr_for_your_verb['verb_face'];
  $verb_word = $arr_for_your_verb['verb_word'];
  $verb_translation = $arr_for_your_verb['verb_translation'];
  $verb_use = $arr_for_your_verb['verb_use'] + 1;
  $verb_counter = mysql_query("UPDATE verbs SET verb_use='$verb_use' WHERE verb_id=$verb_id;");
 
  /* БЛОК pretext */
  $pretext_min_use = mysql_query("SELECT MIN(pretext_use) FROM pretext;");
  $pretext_min_use_arr = mysql_fetch_array($pretext_min_use);
  $pretext_use_min_number = $pretext_min_use_arr['MIN(pretext_use)'];
  
  $pretext_lottery_arr = array();
  $pretext_result = mysql_query("SELECT * FROM pretext WHERE pretext_use=$pretext_use_min_number;");

  while ( $arr_pretext = mysql_fetch_array($pretext_result) ) {
    $pretext_id = $arr_pretext['pretext_id'];
    array_push($pretext_lottery_arr, $pretext_id);
  }

  $pretext_lottery_arr_length = count($pretext_lottery_arr);
  $pretext_rand_number = mt_rand(0, $pretext_lottery_arr_length - 1);
  
  $your_pretext_id = $pretext_lottery_arr[$pretext_rand_number];
  $result_for_your_pretext =  mysql_query("SELECT * FROM pretext WHERE pretext_id=$your_pretext_id;");
  $arr_for_your_pretext = mysql_fetch_array($result_for_your_pretext);

  $pretext_translation = $arr_for_your_pretext['pretext_translation'];
  $pretext_word = $arr_for_your_pretext['pretext_word'];
  $pretext_cecui = $arr_for_your_pretext['pretext_cecui'];
  $pretext_use = $arr_for_your_pretext['pretext_use'] + 1;
  $pretext_counter = mysql_query("UPDATE pretext SET pretext_use='$pretext_use' WHERE pretext_id=$pretext_id;");
  
  /* БЛОК substan */
  $substan_min_use = mysql_query("SELECT MIN(substan_use) FROM substan;");
  $substan_min_use_arr = mysql_fetch_array($substan_min_use);
  $substan_use_min_number = $substan_min_use_arr['MIN(substan_use)'];

  $substan_lottery_arr = array();
  $substan_result = mysql_query("SELECT * FROM substan WHERE substan_cecui=$pretext_cecui;"); 
  echo $pretext_cecui;

  while ( $arr_substan = mysql_fetch_array($substan_result) ) {
    $substan_id = $arr_substan['substan_id'];
    array_push($substan_lottery_arr, $substan_id);
  }

  $substan_lottery_arr_length = count($substan_lottery_arr);
  $substan_rand_number = mt_rand(0, $substan_lottery_arr_length - 1);

  $your_substan_id = $substan_lottery_arr[$substan_rand_number];
  $result_for_your_substan =  mysql_query("SELECT * FROM substan WHERE substan_id=$your_substan_id;");
  $arr_for_your_substan = mysql_fetch_array($result_for_your_substan);

  $substan_translation = $arr_for_your_substan['substan_translation'];
  $substan_word = $arr_for_your_substan['substan_word'];
  $substan_use = $arr_for_your_substan['substan_use'] + 1;
  $substan_counter = mysql_query("UPDATE substan SET substan_use='$substan_use' WHERE substan_id=$substan_id;");

  /* Вывод на страницу */ 
  echo "<div class='verb'>
    <h1>$verb_translation $pretext_translation $substan_translation</h1>
    <form>
      $verb_face <input name='verb_word' pattern='^[$verb_word]+$' autocomplete='off' placeholder='сюда глагол' required autofocus>
      <input name='pretext_word' pattern='^[$pretext_word]+$' autocomplete='off' placeholder='сюда предлог' required autofocus> 
      <input name='substan_word' pattern='^[$substan_word]+$' autocomplete='off' placeholder='сюда существительное' required autofocus><br><br> 
      <input type='submit' class='verb-button'> 
    <form>
  </div>";

?>



</body>
</html>
