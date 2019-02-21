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
      }


    // insert($pr_1, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);
    //вставляем нового участника

  if ((number($pr_1) < 3)||(minimum($pr_1) < $score))
      {
      insert($pr_1, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);
    }
    else if ((number($pr_2) < 3)||(minimum($pr_2) < $score))
              {
              insert($pr_2, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);
            }
          else if ((number($pr_3) < 3)||(minimum($pr_3) < $score))
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
        return $row;
      }

      function delete($table, $row)
      {
        global $pdo;
        $sql = 'DELETE FROM '.$table.' where `score` = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$row['score']]);
      }

      function shift($from, $to)
      {

      global $pr_1, $pr_2, $pr_3;

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
       }


        insert($to, $id, $name, $phys, $math, $lang, $pr1, $pr2, $pr3, $diploma, $score);

        delete($from, $row);
      }


    if (number($pr_1)  > 3) {
        $row = row($pr_1);

        switch ($row['$pr2']) {
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
        }

        shift($pr_1, $pr_2);
        if (number($pr_2) > 3) {
            shift($pr_2, $pr_3);
          if (number($pr_3) > 3) {
                shift($pr_3, 'outside');
            }
          }
      }
          elseif (number($pr_2) > 3) {
            shift($pr_2, $pr_3);
            if (number($pr_3)  > 3) {
              shift($pr_3, 'outside');
            }
          }
              elseif (number($pr_3) > 3) {
                shift($pr_3, 'outside');
              }

    header('Location:add.php');




 ?>
