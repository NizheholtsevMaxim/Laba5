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
              <li><a href="index.php">Поиск</a></li>
              <li class="active"><a href="#">Результаты поиска</a></li>
              <li><a href="#">Пункт 3</a></li>
              <li><a href="#">Пункт 3</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <div id="main">

        <div id='var-7' class="container">
          <h1 class="hide">Разультаты поиска</h1>
          <div class="holder">
            <!-- Form login -->


            <div class="login-wrapper__each login-wrapper__each-2">


              <h2>Разультаты поиска</h2>

              <?php
              // Данные из формы запроса
              $name = $_POST['name'];
              $start_date = $_POST['start_date'];
              $end_date = $_POST['end_date'];
              $author = $_POST['author'];

              //Данные бызы данных для соединения
              $db_name = 'maxim';
              $user = 'root';
              $pass = '';


              try {
                //Соединение с базой данных
                $pdo = new PDO('mysql:host=localhost;dbname=' . $db_name, $user, $pass);
//$stmt = $pdo->prepare('SELECT name FROM users WHERE email = :email');
                //выбираем таблицу из базы данных
                $stmt = $pdo->prepare('
                  SELECT
                    l.name,
                    l.year,
                    l.ISBN,
                    l.literature,
                    l.quantity,
                    l.publisher,
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
                  WHERE 
                    a.name = :author
                ');


                // $stmt->execute(array('name' => $name));
                //stmt->execute(array('year' => $year));
                $stmt->execute(array('author' => $author));
                ?>

                <table>
                  <thead>
                    <tr>
                      <td>Название</td>
                      <td>ISBN</td>
                      <td>Издание</td>
                      <td>Год выхода</td>
                      <td>Кол-во страниц</td>
                      <td>Автор</td>
                      <td>Тип издания</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($stmt as $row) { ?>
                      <tr>
                        <td><?php print($row[0]); ?></td>
                        <td><?php print($row['ISBN']); ?></td>
                        <td><?php print($row['publisher']); ?></td>

                        <td><?php print($row['year']); ?></td>
                        <td><?php print($row['quantity']); ?></td>
                        <td><?php print($row['name']); ?></td>
                        <td><?php print($row['literature']); ?></td>
                      </tr>

                    <?php } ?>

                  </tbody>
                </table>


              </div>

              <?php
              $titles = array();
              $names = array();

              //Обрабатываем полученные данные из базы данных
//                foreach ($query as $row) {
//                  $titles[] = $row[0];
//                  $names[] = $row['name'];
//                  //print $row['author'];
//                }
//                $result_titles = array_unique($titles);
//                $result_names = array_unique($names);
              //print_r($result_titles);
              // соединение больше не нужно, закрываем
              $query = null;
              $dbh = null;
            } catch (PDOException $e) {
              //выводим ошибку
              print "Error!: " . $e->getMessage() . "<br/>";
            }
            ?>








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
