<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Task 1 - Navya Verma</title>

    <style media="screen">

        *{
          padding: 0;
          margin: 0;
          box-sizing: border-box;
        }

        .bodydiv{
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          min-height: 100vh;
        }

        form{
          display: grid;
          grid-template-columns: 1fr 1fr;
          max-width: 60vw;
        }

        form > *{
          display: block;
          margin: 2vh;
        }

        form > * > *{
          margin: 0.5vh;
        }

        .submitdiv{
          grid-column: 1/3;
          text-align: center;
        }

        #submit{
          width: 400px;
          height: 40px;
        }

        #table{
          margin: 2vh 0;
          width: 80vw;
          border-collapse: collapse;
          border: solid 1px black;
          text-align: center;
          table-layout: fixed;
          display: table;
        }

        #table tr, #table td, #table th{
          border: solid 1px black;
        }

    </style>

  </head>
  <body>
    <div class="bodydiv">
      <?php
      $con = mysqli_connect('localhost', 'root', '', 'task1') or die('Could not connect to the database');

      if(isset($_POST['submit'])) {
        if(trim($_POST['fname']) == '' || trim($_POST['lname']) == '' || trim($_POST['age']) == '' || trim($_POST['age']) == '' || trim($_POST['contact']) == '' || trim($_POST['email']) == ''){
          echo '<span id="error">Please Fill all the mandatory fields.</span>';
        } else {
          $fname = trim($_POST['fname']);
          $mname = trim($_POST['mname']);
          $lname = trim($_POST['lname']);
          $contact = trim($_POST['contact']);
          $email = trim($_POST['email']);
          $age = trim($_POST['age']);
          $address = trim($_POST['address']);
          $gender = 0;
          switch($_POST['gender']){
            case 'male': $gender = 1;
            break;
            case 'female': $gender = 2;
            break;
            case 'others': $gender = 3;
          }
          $education = 0;
          switch($_POST['education']){
            case 'high': $education = 1;
            break;
            case 'inter': $education = 2;
            break;
            case 'grad': $education = 3;
            break;
            case 'post': $education = 4;
          }

          $query = "insert into students(first_name, middle_name, last_name, age, gender, email, contact, education, address) values('".$fname."', '".$mname."', '".$lname."', '".$age."', ".$gender.", '".$email."', '".$contact."', ".$education.", '".$address."');";
          if(!mysqli_query($con, $query)){
            echo 'Could not add the data to the table as '.mysqli_error($con);
          }
        }
      }
      ?>

      <form method="post">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id='fname'>

        <label for="mname">Middle Name</label>
        <input type="text" name="mname" id='mname'>

        <label for="lname">Last Name</label>
        <input type="text" name="lname" id='lname'>

        <label for="age">Age</label>
        <input type="number" name="age" id='age'>

        <div>Gender</div>
        <div>
          <div>
            <input type="radio" name="gender" value="male" id='male' checked>
            <label for="male">Male</label>
          </div>

          <div>
            <input type="radio" name="gender" value="female" id='female'>
            <label for="female">Female</label>
          </div>

          <div>
            <input type="radio" name="gender" value="others" id='others'>
            <label for="others">Others</label>
          </div>
        </div>

        <label for="email">Email</label>
        <input type="email" name="email" id='email'>

        <label for="contact">Contact Number</label>
        <input type="number" name="contact" id='contact'>

        <div>Education</div>
        <div>
          <div>
            <input type="radio" name="education" value="high" id='high' checked>
            <label for="high">High School</label>
          </div>

          <div>
            <input type="radio" name="education" value="inter" id='inter'>
            <label for="inter">Intermediate</label>
          </div>

          <div>
            <input type="radio" name="education" value="grad" id='grad'>
            <label for="grad">Graduate</label>
          </div>

          <div>
            <input type="radio" name="education" value="post" id='post'>
            <label for="post">Post graduate</label>
          </div>
        </div>

        <label for="address">Address</label>
        <textarea name="address" id='address' rows="5" cols="80"></textarea>

        <div class="submitdiv">
          <button type="submit" name="submit" id='submit'>Submit</button>
        </div>

      </form>


      <button type="button" name="button" onclick="showHideTable();">Show/Hide Records Below</button>

      <table id='table'>
        <tr>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Last Name</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Email</th>
          <th>Contact Number</th>
          <th>Education</th>
          <th>Address</th>
        </tr>

        <?php
        $query = 'select * from students';
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['middle_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['education']; ?></td>
            <td><?php echo $row['address']; ?></td>
          </tr>
          <?php
        }
        ?>

      </table>

    </div>
  </body>

  <script type="text/javascript">

    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }

    function showHideTable(){
      val = document.getElementById('table').style.display;

      if(val === 'table') document.getElementById('table').style.display = 'none';
              else document.getElementById('table').style.display = 'table';
    }
  </script>

</html>
