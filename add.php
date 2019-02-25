<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="icon" type="image" href="img/icon_PHP.ico" sizes="32x32">
  <!--<link rel="stylesheet" href="style.css">-->
  <title>Добавить абитуриента</title>


  <style>

       p {
            width: 200px;
            background: #ccccff;
            border-radius: 5px;
        }
        .check + p {
            opacity:0.5;
        }
        .check:checked + p {
            opacity: 1;
        }

      /*  #radiobox {
     width: 200px;
     background: #ccccff;
     border-radius: 5px;
     display: block;
     position: relative;
     overflow: hidden;
     z-index: 1;
 }
 #radiobox-curtain {
     opacity: 0.5;
     filter: alpha(opacity=50);
     position: absolute;
     background: white;
     width: 100%;
     height: 100%;
     z-index: 10;
 }*/

        </style>

</head>
<body>


      <div class="col-md-5 mb-5">
             <h4 class="mt-5">Добавить абитуриента</h4>
             <form action="db.php" method="post">

               <label for="id">id</label>
               <input type="text" name="id" id="id" class="form-control">

               <label for="name">Имя участника</label>
               <input type="text" name="name" id="name" class="form-control">
              <br>
               <h5>Баллы</h5>

               <label for="phys">Физика</label>
               <input type="number" name="phys" id="phys" class="form-control">

               <label for="math">Математика</label>
               <input type="number" name="math" id="math" class="form-control">

               <label for="lang">Русский язык</label>
               <input type="number" name="lang" id="lang" class="form-control">

               <br><br>


               <h5>Приоритеты</h5>

               <h6>Приоритет 1:</h6>

              <p class="col-md-7 mb-5">
                <label for="PHYS">ФИЗ: </label><input type="radio" name="pr1" id="PHYS" value="ФИЗ">
               <label for="RADIO">РФЗ: </label><input type="radio" name="pr1" id="RADIO" value="РФЗ">
               <label for="NMT">НМТ: </label><input type="radio" name="pr1" id="NMT" value="НМТ">
               <label for="PMPH">ПМФ: </label><input type="radio" name="pr1" id="PMPH" value="ПМФ">
               <label for="BAS">БАС: </label><input type="radio" name="pr1" id="BAS" value="БАС">
             </p>



            <!--  <p>Приоритет 2:</p>-->

              <p id="radiobox"  class="col-md-7 mb-5">
                <label for="NO2" >Не выбран: </label><input type="radio" name="pr2" id="NO2"  value="NO" checked>
                <label for="PHYS2" >ФИЗ: </label><input type="radio" name="pr2" id="PHYS2"  value="ФИЗ">
                <label for="RADIO2" >РФЗ: </label><input type="radio" name="pr2" id="RADIO2"  value="РФЗ">
                <label for="NMT2" >НМТ: </label><input type="radio" name="pr2" id="NMT2"  value="НМТ">
                <label for="PMPH2" >ПМФ: </label><input type="radio" name="pr2" id="PMPH2"   value="ПМФ">
                <label for="BAS2" >БАС: </label><input type="radio" name="pr2" id="BAS2"  value="БАС">
              </p>



               <p id="radiobox"  class="col-md-7 mb-5">
                   <label for="NO3" >Не выбран: </label><input type="radio" name="pr3" id="NO3"  value="NO" checked>
                 <label for="PHYS3" >ФИЗ: </label><input type="radio" name="pr3" id="PHYS3"  value="ФИЗ">
                 <label for="RADIO3" >РФЗ: </label><input type="radio" name="pr3" id="RADIO3"  value="РФЗ">
                 <label for="NMT3" >НМТ: </label><input type="radio" name="pr3" id="NMT3"  value="НМТ">
                 <label for="PMPH3" >ПМФ: </label><input type="radio" name="pr3" id="PMPH3"   value="ПМФ">
                 <label for="BAS3" >БАС: </label><input type="radio" name="pr3" id="BAS3"  value="БАС">
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
