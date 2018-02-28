<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="KSLeuven" />
    
    <link href="Wisa-Layout.css" rel="stylesheet" type="text/css" />

	<title>TEST | Page</title>
</head>

<body>

        <!--<button onclick="page_fullscreen()">Full Screen</button> --->

        <!-- LINK: naar handleiding online , EXTRA: andere handleiding voor ADMIN dus andere link & andere geen handleiding bij het inloggen, ZIE STATUS SESSION-->
        <!--</a><a class="nav1-link" onclick="document.getElementsByClassName('page_fullscreen-grey').style.display = 'block';" title="HELP: handleiding">HELP</a>
-->
        
    <div class="page_fullscreen-grey">
        <div class="page_cover">
            <div class="page_cover-space">
                <button class="page_cover-close" onclick="page_cover_close() "title="Handleiding sluiten">X</button>
                <div class="page_cover-titlebox">
                    <h3 class="page_cover-title">Handleiding</h3>
                    <h4 class="page_cover-title-sub">Inschrijvingsformulieren</h4>
                </div>
                <div class="page_cover-info">
                    <p id="mess">Nog niet beschikbaar.</p>
                    <!--<embed src="WISA_Handleiding-Inschrijvingsformulieren.txt"/>-->
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        function page_fullscreen()
            {
                document.getElementsByClassName("page_fullscreen-grey").style.display = "block";
            }
        
        function page_cover_close()
            {
                document.getElementsByClassName("page_cover-close").style.display = "none"
            }
    </script>

</body>
</html>