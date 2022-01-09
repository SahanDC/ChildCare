<?php require_once('config/db.php');
require_once('models/manager.php');

?>

<?php
include 'config/db.php'; // Using database connection file here
// $requestObj = new Advice($connection);
//print_r(unserialize($_SESSION['manager']));
$manager = unserialize($_SESSION['manager']);
$id = $_GET['id']; // get id through query string
$advice = $manager->getAdvice_array()[$id];
//print_r($advice);
$topic = $advice->get_topic();
$content = $advice->get_content();


if (isset($_POST['submit'])) {
  $topic = $_POST['topic'];
  $content = $_POST['content'];
  //
  $manager->editAdvice($connection, $advice, $topic, $content);
}
?>

<!doctype html>
<html lang="en">

<head>




  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/patientmanager_styles.css" rel="stylesheet">
  <link href="css/updateStyle.css" rel="stylesheet">
  <title>Health advices</title>
  <title>Document</title>

</head>

<div class="container">


  <!-- Modal -->

  <div class="container">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: rgb(43, 189, 247, 0.3);">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modify Advice</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="" method="POST">

          <div class="modal-body">
            <div class="col-md-12"><label class="labels">Advice Topic</label><textarea class="form-control" id="topic_area" name="topic" rows="3" placeholder="enter topic here" required><?php echo $topic ?></textarea></div>
            <div class="col-md-12"><label class="labels">Advice content </label><textarea class="form-control" id="content_area" name="content" rows="8" placeholder="enter content here" required><?php echo $content ?></textarea></div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-info" value="submit" name="submit">
          </div>
        </form>
        <!-- finish -->
      </div>
    </div>
  </div>
</div>

</html>