<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />

	<title>TEST | Open tabs</title>
    
    <style>
        .tabs_info-box  {border: pink}
        .tabs_info  {border: aqua;
                    DISPLAY: none;}
    
    </style> 
</head>

<body>
    
    
    
    <div class="tabs">
        <button class="tabs_names" onclick="tab_show_info(event, 'relaties'">
            Relaties
        </button>
        <button class="tabs_names" onclick="tab_show_info(event, 'loopbaan'">
            Loopbaan
        </button>
    </div>
    
    <div class="tabs_info-box">
        <div class="tabs_info-box-space">        
            <div id="relaties" class="tabs_info">
                <p>formulier relaties werkt</p>
            </div> 
            <div id="loopbaan" class="tabs_info">
                <p>formulier loopbaan werkt</p>
            </div> 
        </div>
    </div>
     
    <script>
        function tab_show_info(evt, form)
            {
                var i, tab_info, tab_links;
                var inhoud = form     
                
                tab_info = document.getElementsByClassName("tabs_info");
                for (i = 0; i < tab_info.length; i++)
                    {
                        tab_info[i].style.display = "none";
                    }
                tab_links = document.getElementsByClassName("tabs_names");
                for (i = 0; i < tab_links.length; i++)
                    {
                        tab_links[i].className = tab_links[i].className.replace("active", "");
                    }
                document.getElementById(form).style.display = "block";
                evt.currentTarget.className += " active";
                window.location.href = "http://localhost/ProjectWisa/ProjectWisa/TEST-OpenTabs.php?" + inhoud;
            }
    </script> 
     
    <?PHP
        $Formulier = $_SERVER['QUERY_STRING'];
        $URL = $_SERVER['REQUEST_URI'].$Formulier;
        
        if ($Formulier == '?' or $Formulier == '')
            {
                echo "Formulier: ".$Formulier;
            }
        else
            {
                $parameters = "'click', '".$Formulier."'";
                echo "Parameters: ".$parameters;
                echo "<script type='text/javascript'>";
                    echo "tab_show_info(".$parameters.")";
                echo "</script>"; 
            }
    ?>
</body>
</html>