<?php
require "config.php";

  $select = $conn->query("SELECT * FROM posts");
  $select->execute();
  $rows = $select->fetchAll(PDO::FETCH_OBJ);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Like and Dislike System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <style>
    .red{
      background-color: red;
    }
  </style>
  <script>
    function UpdateRecord(id, val) {
      $.ajax({
        type: "POST",
        url: "update.php",
        data: "id="+id+"&val="+val,
        cache: false
      });
    }
  </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                   <?php foreach($rows as $row) : ?>
              <div class="card mt-5" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row->title; ?></h5>
                        <p class="card-text"><?php echo $row->body; ?></p>
                        <?php if($row->likes == 0) : ?>
                        <button class="btn btn-primary mr-5" onClick="UpdateRecord(<?php echo $row->id; ?>, <?php echo $row->likes + 1; ?>)">Like</button><span><?php echo $row->likes; ?></span> 
                        <?php else : ?>
                          <button class="red btn btn-primary mr-5"  onClick="UpdateRecord(<?php echo $row->id; ?>, <?php echo $row->likes - 1; ?>)">Liked</button><span><?php echo $row->likes; ?></span> 
                          <?php endif; ?> 
                    </div>
              </div>
              <br>
              <?php endforeach; ?>


                      
            </div>
       </div>
       
    </div>

    
    

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>      
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>

  <script>
    $(document).ready(function() {
      $("button").click(function() {
        if($(this).text() == "like") {
            $(this).text("liked");
        } else {
            $(this).text("like");
        };

        function withoutRef(){
          setInterval(function(){
            $("body").load("index.php");
          }, 1000);
        }
        withoutRef();
      });
    });
  </script>

</body>
</html>