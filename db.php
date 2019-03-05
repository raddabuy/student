<?php
    $user = 'root';
    $password = '';
    $db = 'entrance';
    $host = 'localhost';

    $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
    $pdo = new PDO($dsn, $user, $password);

    $id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $phys = trim(filter_var($_POST['phys'], FILTER_SANITIZE_STRING));
    $math = trim(filter_var($_POST['math'], FILTER_SANITIZE_STRING));
    $lang = trim(filter_var($_POST['lang'], FILTER_SANITIZE_STRING));
    $pr1 = trim(filter_var($_POST['pr1'], FILTER_SANITIZE_STRING));
    $pr2 = trim(filter_var($_POST['pr2'], FILTER_SANITIZE_STRING));
    $pr3 = trim(filter_var($_POST['pr3'], FILTER_SANITIZE_STRING));
    $diploma = trim(filter_var($_POST['diploma'], FILTER_SANITIZE_STRING));
    $score = $phys + $math + $lang;


          /*  $sql = 'INSERT INTO list(id, name, phys, math, lang, pr1, pr2, pr3, diploma, score) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute([$id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score]);*/



    function number($table)
       {
         global $pdo;
         $sql_gold = 'SELECT * FROM ' .$table;
         $query_gold  = $pdo->prepare($sql_gold);
         $query_gold ->execute();
         $number  = $query_gold ->rowCount();
         return $number;
       }

    function minimum($table)
      {
        global $pdo;
      $req=$pdo->prepare("select min(`score`) from " .$table);
        $req->execute();
        $minimum=current($req->fetch());
        return $minimum;

      }

      function insert($table, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score)
      {
        global $pdo;
        $sql = 'INSERT INTO ' .$table. '(id, name, phys, math, lang, pr1, pr2, pr3, diploma, score) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score]);
      }

      insert('list', $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);


      //if (($diploma == "Да")||($diploma == "Да")) {



      switch ($pr1) {
          case 'ФИЗ':
              $pr_1 = 'phys';
              break;
          case 'РФЗ':
              $pr_1 = 'radio';
              break;
          case 'НМТ':
              $pr_1 = 'nmt';
              break;
          case 'ПМФ':
              $pr_1 = 'pmph';
              break;
          case 'БАС':
              $pr_1 = 'bas';
              break;

      }

      switch ($pr2) {
          case 'ФИЗ':
              $pr_2 = 'phys';
              break;
          case 'РФЗ':
              $pr_2 = 'radio';
              break;
          case 'НМТ':
              $pr_2 = 'nmt';
              break;
          case 'ПМФ':
              $pr_2 = 'pmph';
              break;
          case 'БАС':
              $pr_2 = 'bas';
              break;
          case 'NO':
              $pr_2 = 'NO';
              break;
      }

      switch ($pr3) {
          case 'ФИЗ':
              $pr_3 = 'phys';
              break;
          case 'РФЗ':
              $pr_3 = 'radio';
              break;
          case 'НМТ':
              $pr_3 = 'nmt';
              break;
          case 'ПМФ':
              $pr_3 = 'pmph';
              break;
          case 'БАС':
              $pr_3 = 'bas';
              break;
          case 'NO':
              $pr_3 = 'NO';
              break;
      }


    // insert($pr_1, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);
    //вставляем нового участника

  if ((number($pr_1) < 3)||(minimum($pr_1) <= $score))
      {
      insert($pr_1, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);
    }
    else if (((number($pr_2) < 3)||(minimum($pr_2) <= $score))&&($pr_2 != 'NO'))
              {
              insert($pr_2, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);
            }
          else if (((number($pr_3) < 3)||(minimum($pr_3) <= $score))&&($pr_3 != 'NO'))
                    {
                    insert($pr_3, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);
                }
                else {

                  insert('outside',$id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);
                }


    //делаем смещения в таблицах, если произошло переполнение


    function row($table)
      {
        global $pdo;
        $sql_gold = 'SELECT * FROM '.$table. ' ORDER BY `score` ASC';
        $query_gold  = $pdo->prepare($sql_gold);
        $query_gold ->execute();
        $row = $query_gold->fetch(PDO::FETCH_ASSOC);

        $sql_gold = 'SELECT * FROM '.$table. ' WHERE `score` = ? ORDER BY `phys` ASC';
        $query_gold  = $pdo->prepare($sql_gold);
        $query_gold ->execute([$row['score']]);
        $row = $query_gold->fetch(PDO::FETCH_ASSOC);

        $sql_gold = 'SELECT * FROM '.$table. ' WHERE `phys` = ? ORDER BY `math` ASC';
        $query_gold  = $pdo->prepare($sql_gold);
        $query_gold ->execute([$row['phys']]);
        $row = $query_gold->fetch(PDO::FETCH_ASSOC);

        $sql_gold = 'SELECT * FROM '.$table. ' WHERE `math` = ? ORDER BY `lang` ASC';
        $query_gold  = $pdo->prepare($sql_gold);
        $query_gold ->execute([$row['math']]);
        $row = $query_gold->fetch(PDO::FETCH_ASSOC);

        /*$sql_gold = 'SELECT * FROM '.$table. ' WHERE `phys` = ?';
        $query_gold  = $pdo->prepare($sql_gold);
        $query_gold ->execute([$row['phys']]);
        $row = $query_gold->fetch(PDO::FETCH_ASSOC);*/
      //  $min = $row[`score`];
        return $row;
      }

      function delete($table, $row)
      {
        global $pdo;
        $sql = 'DELETE FROM '.$table.' where `id` = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$row['id']]);
      }

      function to($from)
      {
           $row = row($from);

        $pr1 = $row['pr1'];
         $pr2 = $row['pr2'];
         $pr3 = $row['pr3'];

         switch ($pr1) {
             case 'ФИЗ':
                 $pr_1 = 'phys';
                 break;
             case 'РФЗ':
                 $pr_1 = 'radio';
                 break;
             case 'НМТ':
                 $pr_1 = 'nmt';
                 break;
             case 'ПМФ':
                 $pr_1 = 'pmph';
                 break;
             case 'БАС':
                 $pr_1 = 'bas';
                 break;
         }

         switch ($pr2) {
             case 'ФИЗ':
                 $pr_2 = 'phys';
                 break;
             case 'РФЗ':
                 $pr_2 = 'radio';
                 break;
             case 'НМТ':
                 $pr_2 = 'nmt';
                 break;
             case 'ПМФ':
                 $pr_2 = 'pmph';
                 break;
             case 'БАС':
                 $pr_2 = 'bas';
                 break;
             case 'NO':
                 $pr_2 = 'outside';
                 break;

         }

         switch ($pr3) {
             case 'ФИЗ':
                 $pr_3 = 'phys';
                 break;
             case 'РФЗ':
                 $pr_3 = 'radio';
                 break;
             case 'НМТ':
                 $pr_3 = 'nmt';
                 break;
             case 'ПМФ':
                 $pr_3 = 'pmph';
                 break;
             case 'БАС':
                 $pr_3 = 'bas';
                 break;
             case 'NO':
                 $pr_3 = 'outside';
                 break;
         }

         switch ($from) {
             case $pr_1:
                 $to = $pr_2;
                 break;
             case $pr_2:
                $to = $pr_3;
                 break;
              }

        return $to;
      }

      function shift($from, $to)
      {

       $row = row($from);

       $id = $row['id'];
       $name = $row['name'];
       $phys = $row['phys'];
       $math = $row['math'];
       $lang = $row['lang'];
       $pr1 = $row['pr1'];
       $pr2 = $row['pr2'];
       $pr3 = $row['pr3'];
       $diploma = $row['diploma'];
       $score = $row['score'];

       switch ($pr1) {
           case 'ФИЗ':
               $pr_1 = 'phys';
               break;
           case 'РФЗ':
               $pr_1 = 'radio';
               break;
           case 'НМТ':
               $pr_1 = 'nmt';
               break;
           case 'ПМФ':
               $pr_1 = 'pmph';
               break;
           case 'БАС':
               $pr_1 = 'bas';
               break;
       }

       switch ($pr2) {
           case 'ФИЗ':
               $pr_2 = 'phys';
               break;
           case 'РФЗ':
               $pr_2 = 'radio';
               break;
           case 'НМТ':
               $pr_2 = 'nmt';
               break;
           case 'ПМФ':
               $pr_2 = 'pmph';
               break;
           case 'БАС':
               $pr_2 = 'bas';
               break;
           case 'NO':
               $pr_2 = 'outside';
               break;
       }

       switch ($pr3) {
           case 'ФИЗ':
               $pr_3 = 'phys';
               break;
           case 'РФЗ':
               $pr_3 = 'radio';
               break;
           case 'НМТ':
               $pr_3 = 'nmt';
               break;
           case 'ПМФ':
               $pr_3 = 'pmph';
               break;
           case 'БАС':
               $pr_3 = 'bas';
               break;
           case 'NO':
               $pr_3 = 'outside';
               break;
       }




        insert($to, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);

        delete($from, $row);


      }


    if (number($pr_1)  > 3) {
        $to = to($pr_1);
        shift($pr_1, $to);
      //  $pr_2 = $to;
        if ((number($to) > 3)&&($to != 'outside')) {
            $pr_from = $to;
            $to = to($pr_from);
            shift($pr_from, $to);
          //  $pr_3 = $to;
          if ((number($to) > 3)&&($to != 'outside')) {
              shift($to, 'outside');
            }
          }
      }
          elseif ((number($pr_2) > 3)&&($pr_2 != 'outside')) {
            $to = to($pr_2);
            shift($pr_2, $to);
            if (number($to)  > 3) {
              shift($to, 'outside');
            }
          }
              elseif ((number($pr_3) > 3)&&($pr_3 != 'outside')) {
                shift($pr_3, 'outside');
              }


              $sql_gold = 'SELECT * FROM `list` ORDER BY `score` DESC';
              $query_gold  = $pdo->prepare($sql_gold);
              $query_gold ->execute();
              //$row = $query_gold->fetch(PDO::FETCH_ASSOC);
            /*  $min = $row['score'];

              $sql_gold = 'SELECT * FROM '.$table. ' where `score`=? ORDER BY `phys` DESC';
              $query_gold  = $pdo->prepare($sql_gold);
              $query_gold ->execute([$min]);*/
//}

    header('Location:add.php');




 ?>
