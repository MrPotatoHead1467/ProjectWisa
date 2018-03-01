<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>TEST | Page</title>
    
    <style>
        .tabs_names_arrows  {}
        
        #t1  {display: none}
        #t2  {display: none}
        #t3  {display: none}
        
        #tabs_names_arrows_vorige   {display:  none;}
        #tabs_names_arrows_volgende   {display:  none;}
    </style>
</head>

<body>
    <!-- vorige -->
    <button class="tabs_names_arrows" id="tabs_names_arrows_vorige" onclick="tabs_next()" title="Vorige tabblad">
        &#8249;
    </button>
    
        <!-- tabbladen -->
        <div class="tabs" id="1">
            <button class="tabs_names" onclick="tab_show_info(event, 'nieuweinschrijving')">
                Nieuwe inschrijving
            </button>
                    
            <button class="tabs_names" onclick="tab_show_info(event,'nieuwevraag')">
                Nieuwe vraag
            </button>
                    
            <button class="tabs_names" onclick="tab_show_info(event, 'goedkeuren')">
                Inschrijvingen goedkeuren
            </button>
            
            <button class="tabs_names" onclick="tab_show_info(event, naam1')">
                Naam1
            </button>
            
            <button class="tabs_names" onclick="tab_show_info(event, naam2')">
                Naam2
            </button>
        </div>
        <div class="tabs" id="2">
            <button class="tabs_names" onclick="tab_show_info(event, naam3')">
                Naam3
            </button>
            
            <button class="tabs_names" onclick="tab_show_info(event, naam4')">
                Naam4
            </button>
            
            <button class="tabs_names" onclick="tab_show_info(event, naam5')">
                Naam5
            </button>
            
            <button class="tabs_names" onclick="tab_show_info(event, naam6')">
                Naam6
            </button>
            
            <button class="tabs_names" onclick="tab_show_info(event, naam8')">
                Naam7
            </button>
        </div>
        <div class="tabs" id="3">
            <button class="tabs_names" onclick="tab_show_info(event, naam8')">
                Naam8
            </button>
        </div>
    
    <!-- volgende -->
    <button class="tabs_names_arrows" id="tabs_names_arrows_volgende" onclick="tabs_next()" title="Volgende tabblad">
        &#8250;
    </button>
    
    <p id="demo"></p>
    <p id="demo2"></p>
    <p id="demo3"></p>    
        


<script>
    var amount = document.querySelectorAll(".tabs").length;
    var vorige = document.getElementById(".tabs_names_arrows_vorige");
    var volgende = document.getElementById(".tabs_names_arrows_volgende");
    var letter = "t"
    var nummer = 1
    var show = letter + nummer;
    var id = document.querySelector('.tabs').id;
    
    document.getElementById("demo").innerHTML = amount;
    document.getElementById("demo2").innerHTML = id;
    document.getElementById("demo3").innerHTML = "show class tab" + show;
    
    tabs_show();
    
    function tabs_show()
        {
            if (show == 1)
                {
                    document.getElementById(show).style.display == "block";
                    if (amount == show)
                        {
                            vorige.style.display = "none";
                            volgende.style.display = "none";
                        }
                    else
                        {
                            vorige.style.display = "none";
                            volgende.style.display = "block";
                        }
                }
            else if (show > 1)
                {
                    document.getElementById(show).style.display == "block";
                    if (amount == show)
                        {
                            vorige.style.display = "block";
                            volgende.style.display = "none";
                        }
                    else
                        {
                            vorige.style.display = "block";
                            volgende.style.display = "block";
                        }
                }
            else
                {
                    show = 1;
                }
        }
        
    //document.getElementById("").addEventListener("click", displayDate);
        
    function tabs_next()
        {
            show = (show + 1);
            tabs_show();
            //tabs_hide();
        }
        
    function tabs_prev()
        {
            show = (show - 1);
            tabs_show();
            //tabs_hide();
        }
        
    function tabs_hide()
        {
            if (id != show)
                {
                    id.style.display = "none";
                }
        }

</script>

</body>
</html>