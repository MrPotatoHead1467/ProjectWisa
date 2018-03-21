<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />

	<title>WISA | Zoekmachine</title>
    
    <style type="text/css">
    
    </style>
    
</head>

<body>
<?PHP 
    include "WISA-Connection.php";
?>

    <table>
        <tr>
            <th colspan="2">
                <input class="" id="zoekmachine" onkeyup="ZoekItem()" type="text"/>
            </th>
        </tr>
        <?PHP
            $sql = "SELECT * FROM tbl_personen ORDER BY fld_persoon_naam ASC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                        {
                            echo "<tr class='zoekmachine_item' id='".$row['fld_persoon_id']."' onclick='SelectItem("; echo "'".$row['fld_persoon_id']."', '".$row['fld_persoon_naam']."'"; echo ")'>";
                                echo "<td class='zoekmachine_item_s1'>";
                                    echo $row['fld_persoon_naam'];
                                echo "</td>";
                                echo "<td class='zoekmachine_item_s2'>";
                                    echo " | ".$row['fld_persoon_gb_datum'];
                                echo "</td>";
                            echo "</tr>";
                        }
                }
        ?>
    </table>
    <p id="test"></p>
        
        <script>
            Zoekmachine = document.querySelector("zoekmachine");
            Item = document.getElementsByClassName("zoekmachine_item_s1").;
            var Tekst = "30";
            //Persoon = document.querySelector(".persoon");
            //var when = "keyup";
            //Tekst.onkeyup = function(){document.getElementById("test").innerHTML = Tekst;}
            
            function ZoekItem()
                {
                    var i = 0
                    for (i < Tekst.length)
                        {
                            Tekst = document.getElementsByClassName("zoekmachine").value;
                            document.getElementById("test").innerHTML = Tekst;
                            
                            if (includes())
                            
                            i++;
                            //var Mogelijk = MogelijkePersonen[i];
                            //var MogelijkTekst = Mogelijk.Tekst; 
                            //var KleinMogelijkTekst = MogelijkTekst.toLowerCase();
                            //var KleinTekst = Tekst.toLowerCase(); 
                            //var regex = new RegExp("^" + Tekst, "i");
                            //var match = Mogelijktekst.match(regex); 
                            //var contains = KleinMogelijkTekst.indexOf(KleinTekst) != -1;
                            //if (match || contains)
                                //{
                                   //Mogelijk.selected = true;
                                    //return;
                                //}
                            //Zoekmachine.selectedIndex = 0;
                        }
                                    
                }
                                                            
                            //var Tekst = Zoekmachine.value; 
                            //var MogelijkePersonen = Persoon.MogelijkePersonen; 
                            //
                                        
        </script>
        
        
    
    
    
    
    
</body>
</html>

