<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="icon" type="image" href="img/icon_PHP.ico" sizes="32x32">
  <!--<link rel="stylesheet" href="style.css">-->
  <title>Редактирование</title>

  <?php

    $user = 'root';
    $password = '';
    $db = 'entrance';
    $host = 'localhost';

    $dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
    $pdo = new PDO($dsn, $user, $password);


    $sql = 'SELECT * FROM `list` WHERE `id`=:id';
    $id = $_GET['id'];
    $query = $pdo->prepare($sql);
    $query->execute(['id'=>$id]);

    $student = $query->fetch(PDO::FETCH_ASSOC);

   ?>





</head>
<body>

<p> <a href="show.php">Вернуться обратно</a></p>
  <div class="col-md-5 mb-5">
         <h4 class="mt-5">Добавить абитуриента</h4>
         <form action="update.php" method="post">

           <label for="id">id</label>
           <input type="text" name="id" id="id" class="form-control" value = <?=$student['id']?>>

           <label for="name">Имя участника</label>
           <input type="text" name="name" id="name" class="form-control" value = <?=$student['name']?>>
          <br>
           <h5>Баллы</h5>

           <label for="phys">Физика</label>
           <input type="number" name="phys" id="phys" class="form-control" value = <?=$student['phys']?>>

           <label for="math">Математика</label>
           <input type="number" name="math" id="math" class="form-control" value = <?=$student['math']?>>

           <label for="lang">Русский язык</label>
           <input type="number" name="lang" id="lang" class="form-control"value = <?=$student['lang']?>>

           <br><br>


           <h5>Приоритеты</h5>

           <h6>Приоритет 1:</h6>

          <p class="col-md-7 mb-5">
            <label for="PHYS">ФИЗ: </label><input type="radio" name="pr1" id="PHYS" value="ФИЗ" <?php if ($student['pr1'] == "ФИЗ") {echo "checked";}?>>
           <label for="RADIO">РФЗ: </label><input type="radio" name="pr1" id="RADIO" value="РФЗ" <?php if ($student['pr1'] == "РФЗ") {echo "checked";}?>>
           <label for="NMT">НМТ: </label><input type="radio" name="pr1" id="NMT" value="НМТ" <?php if ($student['pr1'] == "НМТ") {echo "checked";}?>>
           <label for="PMPH">ПМФ: </label><input type="radio" name="pr1" id="PMPH" value="ПМФ" <?php if ($student['pr1'] == "ПМФ") {echo "checked";}?>>
           <label for="BAS">БАС: </label><input type="radio" name="pr1" id="BAS" value="БАС" <?php if ($student['pr1'] == "БАС") {echo "checked";}?>>
         </p>



        <!--  <p>Приоритет 2:</p>-->

          <p id="radiobox"  class="col-md-7 mb-5">
            <label for="NO2" >Не выбран: </label><input type="radio" name="pr2" id="NO2"  value="NO" <?php if ($student['pr2'] == "NO") {echo "checked";}?>>
            <label for="PHYS2" >ФИЗ: </label><input type="radio" name="pr2" id="PHYS2"  value="ФИЗ" <?php if ($student['pr2'] == "ФИЗ") {echo "checked";}?>>
            <label for="RADIO2" >РФЗ: </label><input type="radio" name="pr2" id="RADIO2"  value="РФЗ" <?php if ($student['pr2'] == "РФЗ") {echo "checked";}?>>
            <label for="NMT2" >НМТ: </label><input type="radio" name="pr2" id="NMT2"  value="НМТ" <?php if ($student['pr2'] == "НМТ") {echo "checked";}?>>
            <label for="PMPH2" >ПМФ: </label><input type="radio" name="pr2" id="PMPH2"   value="ПМФ" <?php if ($student['pr2'] == "ПМФ") {echo "checked";}?>>
            <label for="BAS2" >БАС: </label><input type="radio" name="pr2" id="BAS2"  value="БАС" <?php if ($student['pr2'] == "БАС") {echo "checked";}?>>
          </p>



           <p id="radiobox"  class="col-md-7 mb-5">
               <label for="NO3" >Не выбран: </label><input type="radio" name="pr3" id="NO3"  value="NO" <?php if ($student['pr3'] == "NO") {echo "checked";}?>>
             <label for="PHYS3" >ФИЗ: </label><input type="radio" name="pr3" id="PHYS3"  value="ФИЗ" <?php if ($student['pr3'] == "ФИЗ") {echo "checked";}?>>
             <label for="RADIO3" >РФЗ: </label><input type="radio" name="pr3" id="RADIO3"  value="РФЗ" <?php if ($student['pr3'] == "РФЗ") {echo "checked";}?>>
             <label for="NMT3" >НМТ: </label><input type="radio" name="pr3" id="NMT3"  value="НМТ" <?php if ($student['pr3'] == "НМТ") {echo "checked";}?>>
             <label for="PMPH3" >ПМФ: </label><input type="radio" name="pr3" id="PMPH3"   value="ПМФ" <?php if ($student['pr3'] == "ПМФ") {echo "checked";}?>>
             <label for="BAS3" >БАС: </label><input type="radio" name="pr3" id="BAS3"  value="БАС" <?php if ($student['pr3'] == "БАС") {echo "checked";}?>>
           </p>


          <h5>Аттестат</h5>

          <select size="3" name="diploma" >
                 <option disabled>Выберите состояние</option>
                 <option selected value="Да">Да</option>
                 <option value="Забрал">Забрал аттестат</option>
                 <option value="Обещал">Обещал принести</option>
                 <option value="Нет">Нет</option>
           </select>
           <br><br>
            <button type="submit" id="send" class="btn btn-success mt-3">Сохранить</button>
            </form>





      </div>



</body>
</html>
