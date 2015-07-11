<?php header("content-type: text/css");
$color = $_GET['color']; $font = $_GET['font']; $logoheight = $_GET['logoheight']; $footer_text_style = $_GET['footer_text_style'];

function HexToRGB($hex) {
	$hex = str_replace("#", "", $hex);
	$color = array();
	
	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	
	return $color;
}

$rgb = HexToRGB($color);
?>

/*  ----------------------------------------------------------------------
	Custom logo height setting
----------------------------------------------------------------------  */

<?php $tallerheight = $logoheight + 18; ?>

header { height:<?php echo $tallerheight; ?>px; }
#logo a { height:<?php echo $logoheight; ?>px; }

/*  ----------------------------------------------------------------------
	Load & Setup the custom font
	----------------------------------------------------------------------  */

<?php if ($font == 'Lobster Two:400italic'){ $font = 'Lobster Two'; } ?>
<?php if ($font == 'Alegreya:700'){ $font = 'Alegreya'; } ?>
<?php if ($font != 'sans-serif'){ $font = "'".$font."'"; } ?>

.bitter,
#content .entry h1,
#content .entry h2,
#content .entry h3,
#content .entry h4,
#content .entry h5,
#content .entry blockquote p { font-family: <?php echo $font; ?>, serif; font-weight: normal; }

/* END Custom Font */


/*  ----------------------------------------------------------------------
	Custom Color
	----------------------------------------------------------------------  */

a,
nav > ul > li > a:hover,
nav > ul > li.hover > a,
nav > ul > li.current > a,
nav li li a:hover,
footer p a:hover,
footer p span a,
#countdown h4,
#recent a:hover .bitter,
#upcoming a:hover .bitter,
#upcoming .custom-row a,
#respond span.required { color: #<?php echo $color; ?>; }

#respond input#submit,
#upcoming .date { background: #<?php echo $color; ?>; }

<?php
	$rgb_normal =  $rgb['r'].','.$rgb['g'].','.$rgb['b'];
	$rgb_light = ($rgb['r'] - 22).','.($rgb['g'] - 24).','.($rgb['b'] - 4);
	$rgb_dark = ($rgb['r'] - 44).','.($rgb['g'] - 48).','.($rgb['b'] - 8);
?>

.red-button,
#respond input#submit,
form.styled .button,
.widget #search .go {
	 background: rgb(<?php echo $rgb_normal; ?>); 
	 background: -moz-linear-gradient(top, rgba(<?php echo $rgb_normal; ?>,1) 0%, rgba(<?php echo $rgb_light; ?>,1) 100%); 
	 background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(<?php echo $rgb_normal; ?>,1)), color-stop(100%,rgba(<?php echo $rgb_light; ?>,1))); 
	 background: -webkit-linear-gradient(top, rgba(<?php echo $rgb_normal; ?>,1) 0%,rgba(<?php echo $rgb_light; ?>,1) 100%); 
	 background: -o-linear-gradient(top, rgba(<?php echo $rgb_normal; ?>,1) 0%,rgba(<?php echo $rgb_light; ?>,1) 100%); 
	 background: -ms-linear-gradient(top, rgba(<?php echo $rgb_normal; ?>,1) 0%,rgba(<?php echo $rgb_light; ?>,1) 100%); 
	 background: linear-gradient(top, rgba(<?php echo $rgb_normal; ?>,1) 0%,rgba(<?php echo $rgb_light; ?>,1) 100%);
	 border:1px solid rgb(<?php echo $rgb_dark; ?>);
	 color:#fff;
}
.red-button:hover,
#respond input#submit:hover,
form.styled .button:hover,
.widget #search .go:hover {
	background: rgb(<?php echo $rgb_light; ?>); 
	background: -moz-linear-gradient(top, rgba(<?php echo $rgb_light; ?>,1) 0%, rgba(<?php echo $rgb_normal; ?>,1) 100%); 
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(<?php echo $rgb_light; ?>,1)), color-stop(100%,rgba(<?php echo $rgb_normal; ?>,1))); 
	background: -webkit-linear-gradient(top, rgba(<?php echo $rgb_light; ?>,1) 0%,rgba(<?php echo $rgb_normal; ?>,1) 100%); 
	background: -o-linear-gradient(top, rgba(<?php echo $rgb_light; ?>,1) 0%,rgba(<?php echo $rgb_normal; ?>,1) 100%); 
	background: -ms-linear-gradient(top, rgba(<?php echo $rgb_light; ?>,1) 0%,rgba(<?php echo $rgb_normal; ?>,1) 100%); 
	background: linear-gradient(top, rgba(<?php echo $rgb_light; ?>,1) 0%,rgba(<?php echo $rgb_normal; ?>,1) 100%);
	color:#fff;
}

<?php if ($footer_text_style == 'dark'){ ?>

footer p { color: #fff; text-shadow:1px 1px 0 rgba(0,0,0,0.4); }
footer p a { color: #fff; }
footer p a:hover { color: #fff; }

<?php } else { ?>

footer p { color: #595959; text-shadow:1px 1px 0 rgba(255,255,255,0.4); }
footer p a { color: #595959; }
footer p a:hover { color: #<?php echo $color; ?>; }

<?php } ?>