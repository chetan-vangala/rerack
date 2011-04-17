<?php require('shared/_head.php'); ?>
</head>
  <body>
    <?php 
      if(isset($_GET['house'])){
        require_once 'shared/_dashboard.php';
      } else {                
        $house = new House();
        //Has the form been submitted?
        if(count($_POST) > 0){
          $data = $_POST['house']['code'];        
          $errors = array();
          //Verify the fields are filled out
          if(!ene($data,array('code'))){
            $errors[] = 'All fields must be complete.';
          }
          $h = $house->find("code=$data");
          if(!empty($h)){
            redirect_to('index.php?house=' . $data);
            return;
          } else {
            $errors[] = "Unable to create team.";
          }
        }
          //Display any error messages we've encountered.
        if(!empty($errors)){
          print_errors($errors);
        } else {
          require_once 'shared/_code.php';
        }
      }
    ?>
  </body>
</html>