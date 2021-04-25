<?php declare(strict_types=1) ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laba 5</title>
    <link media="all" rel="stylesheet" href="styles.css">
    <link media="all" rel="stylesheet" href="calculator.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic" type="text/css">
    <style>
      body {
        margin: 0;
        color: #7e7e7e;
        font: 17px/1.412 "Istok Web", "Arial", "Helvetica", sans-serif;
        background: #f9f9f9;
        overflow-y: scroll;
        min-width: 320px;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: none;
      }
    </style>
    <title>Laba 4</title>

  </head>
  <body class="home-page">

    <div id="wrapper">
      <header id="header">
        <div class="panel">
          <div id='header-container' class="container">
            <strong class="logo"><a href="#">Laba 5</a></strong>
            <ul>
              <li><a href="#">Home</a></li>
            </ul>
          </div>
        </div>
        <div class="hero">
          <div class="img">
            <div class="s1">
              <div class="s2" style="background: url('images/banner.jpg') no-repeat 0 0; background-size: cover; width: 100%; height: 300px; display:flex; justify-content: center; align-items: center; color: #fff;">
                <h1>Лабораторное работа №5</h1>
              </div>
            </div>
          </div>

        </div>
        <div class="navigation">
          <nav>
            <ul>
              <li class="active"><a href="#">Поиск</a></li>
              <li><a href="#">Результаты поиска</a></li>
              <li><a href="#">Пункт 3</a></li>
               <li><a href="#">Пункт 4</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <div id="main">

        <div id='var-7' class="container">
          <h1 class="hide">Поиск</h1>
          <div class="holder">
 <h1>Лабораторноя работа №4</h1>
       

            <!-- Form login -->


            <div class="login-wrapper__each">


              <h2>Вариант №0</h2>

              <?php
              //Данные бызы данных для соединения
              $db_name = 'maxim';
              $user = 'root';
              $pass = '';


              try {
                //Соединение с базой данных
                $dbh = new PDO('mysql:host=localhost;dbname=' . $db_name, $user, $pass);

                //выбираем таблицу из базы данных
                $query = $dbh->query('
                  SELECT 
                    l.name, 
                    l.year, 
                    b.FID_Book,
                    b.FID_Author,
                    a.ID_Authors,
                    a.name
                  FROM
                      book_authors b
                  INNER JOIN literarure l 
                    ON b.FID_Book = l.ID_Book
                  INNER JOIN authors a 
                    ON b.FID_Author = a.ID_Authors
                ');

                $titles = array();
                $names = array();

                //Обрабатываем полученные данные из базы данных
                foreach ($query as $row) {
                    $titles[] = $row[0];
                  $names[] = $row['name'];
                  //print $row['author'];
                }
                $result_titles = array_unique($titles);
                $result_names = array_unique($names);

                //print_r($result_titles);
                
                
                
                // соединение больше не нужно, закрываем
                $query = null;
                $dbh = null;
              } catch (PDOException $e) {
                //выводим ошибку
                print "Error!: " . $e->getMessage() . "<br/>";
              }
              
              
              ?>


               <form class="login" method="post" action="result.php">

                <p class="form-row">
                  <label>Выберите название:</label>
                  <select name="name">
                    <?php foreach ($result_titles as $title) {?>
                      <option value="<?php print $title;?>"><?php print $title;?></option>
                    <?php }?>
                  </select>
                </p>
                <div class="form-row">
                  <label>Выберите временной период  годах:</label>
                  <div class="flex-box">
                    <input type="text" class="input-text" name="start_date" id="start_date" placeholder="1990" value="">
                    <input type="text" class="input-text" name="end_date" id="end_date" placeholder="2021" value="">
                  </div>
                </div>
                <p class="form-row">
                  <label>Выберите имя автора:</label>
                  <select name="author">
                    <?php foreach ($result_names as $name) {?>
                      <option value="<?php print $name;?>"><?php print $name;?></option>
                    <?php }?>
                  </select>
                </p>
                <p class="form-row">
                  <button type="submit" class="button" name="login" value="Sign In">Отправить</button>
                </p>


              </form>


            </div>




          </div>
        </div>
      </div>
      <footer id="footer">
        <ul>
          <li>© Copyright 2021 Maxim</li>
        </ul>
      </footer>

    </div>  
  </body>
</html>
