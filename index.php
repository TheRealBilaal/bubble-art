<?php 
	session_start();
	if (!empty($_GET["upload"])) {
		//User uploaded image
		$img = "img-uploaded/" . $_GET["upload"];
	} else if (!empty($_GET["url"])) {
		//Image from user uploaded URL
		$img = $_GET["url"];
	} else {
		//Use random image
		$rand = mt_rand(1,4);
		if ($rand == 1) {
			$img = "https://source.unsplash.com/500x500/?pet";
		} else if ($rand == 2) {
			$img = "https://source.unsplash.com/500x500/?city,landmark";
		} else if ($rand == 3) {
			$img = "https://source.unsplash.com/500x500/?car";
		} else {
			//Randomly generates an image from /img/
			$directory = "img/";
			$files_jpg = glob($directory . "*.jpg");
			$files_png = glob($directory . "*.png");
			$files_gif = glob($directory . "*.gif");

			$images = array_merge($files_jpg, $files_png, $files_gif);
			$img = $images[array_rand($images)];
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset='utf-8'>
	    <meta name="viewport" content="width=540, user-scalable=0">
	    <meta name="apple-mobile-web-app-capable" content="yes">
	    <meta name="apple-mobile-web-app-status-bar-style" content="default">
	    <title>Bubble Art</title>
	    <script type="text/javascript" src="/bubble/d3.min.js"></script>
	    <script type="text/javascript" src="/bubble/bubble.js"></script>
	    <link rel="stylesheet" type="text/css" href="/bubble/bubble.css">
	    <link rel="stylesheet" type="text/css" href="/main.css">
	</head>
	<body>
		<?php include "header.php"; ?>
        <noscript>
        	<p>Your browser does not support JavaScript or it is disabled.<br>JavaScript is needed to view this site.</p>
        </noscript>
	    <div id="center">
	        <div id="cont">
	            <div id="dots"></div>
	        </div>
	    </div>
	    <script type="text/javascript">
	        (function() {
	            window.onerror = function(msg, url, ln) {
	                msg = msg.toString();
	                if (msg === 'Script error.' && url === '' && ln === 0) {
	                	return;
	                }
	                // Track only one error per page load
	                window.onerror = function() {};
	            };

	            //Checks for canvas support
	            if (!koala.supportsCanvas()) {
	                alert("Your browser does not support HTML5 Canvas. Supported browsers include the latest versions of Chrome, Safari, Firefox, Opera, and Edge");
	                return;
	            }

	            //Checks for SVG support
	            if (!koala.supportsSVG()) {
	                alert("Your browser does not have support for SVG image. Supported browsers include the latest versions of Chrome, Safari, Firefox, Opera, and Edge");
	                return;
	            }

	            //Checks if D3 is loaded
	            if (!window.d3) {
	                alert("The D3.js was not loaded. Try refreshing the page and see if that helps.");
	                return;
	            }

	            try {
	            	//Gets image URL generated from PHP
	                var file = '<?php echo $img; ?>';

	                var img = new Image();

	                img.onload = function() {
	                    var colorData;

	                    try {
	                        colorData = koala.loadImage(this);
	                    } catch (e) {
	                        colorData = null;
	                        alert("There was an error loading the image.");

	                        setTimeout(function() {
	                            window.location.href = domian;
	                        }, 750);
	                    }

	                    if (colorData) {
	                        koala.makeCircles("#dots", colorData);
	                    }
	                };

	                //Allows for images from external servers
	                img.crossOrigin = "Anonymous";

	                img.src = file;
	            } catch (e) {

	            }
	        })();
	    </script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <script src="/nav.js"></script>
	</body>
</html>