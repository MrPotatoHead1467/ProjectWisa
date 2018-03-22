<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<?php 
include "WISA-Connection.php";
if (isset($_POST['submit'])){
    $test = mysqli_real_escape_string($conn, $_POST['demo']);
    echo "id=".$test;
}
?>
<input id="Test" list="users" name="users"/>
  <datalist id="users">
    <?php
    $sql = "SELECT * FROM tbl_personen";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            echo "<option id='".$row['fld_persoon_id']."' value='".$row['fld_persoon_naam']." ( ".$row['fld_persoon_gb_datum']." )'>";
        }
    }
    ?>
    <option value="Test14689">
  </datalist>
<form action="Test_Pagina.php" method="post">
    <input id="demo" name="demo" type="hidden"/>
    <button type="Submit" id="submit" name="submit">Test</button>
</form>

<script type="text/javascript">
<!--
    $(function() {
      $('#Test').on('input',function() {
        var opt = $('option[value="'+$(this).val()+'"]');
        document.getElementById("demo").value = opt.attr('id');
      });
    });
-->
</script>

</body>
</html>