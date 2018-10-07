<?php
session_start();
// images to be resized. underscores linked and added to the next page.
// }
?>

<html>
<head>
	<style>
    body
	{
		background: radial-gradient(rgba(107, 50, 67, 0.89),rgba(66, 27, 40));
	}
    .name {
        float: center;
        color: white;
    }
	table {
		width: 100%
		}
	table, td, th {
		border: 1px solid black;
	}
    #welcome
    {
	text-align: center;
	font-family: cursive;
	font-size: 1000%;
	color: rgb(138, 73, 100);
    }
    
</style>
</head>

<body>
    <h1 id="welcome"><p>Categories: Celebrity brands</p></h1>
	<table>
		<tr> </tr>
		<tr>
            <td><div class = "beauty"> </div>
                <img id = "Red" src=https://limecrime-weblinc.netdna-ssl.com/product_images/red-rose/Red%20Rose/5b43e6ca6170702c1b0006b8/zoom.jpg?c=1531176650 style = "height:10%; with:10%; float:left">
                <div class = "name"> Red </div></td>
            <td><div class = "beauty"> </div> 
                <img id = "nude" src=https://cdn8.bigcommerce.com/s-xmr8hpfiop/images/stencil/300x300/products/213/631/Lip-pencil-Nude__83231.1519172553.jpg?c=2 style = "height:20%; with:30%; float:center">
                <div class = "name"> Nude </div></td>
            <td><div class = "beauty"> </div>
                <img id = "kkw" src=https://i.pinimg.com/originals/89/ba/47/89ba4768c2981fbfabba031d42d335be.png style = "height:20%; with:20%; float:right"> 
                <div class = "name"> Purple </div></td>
        </tr>
        
        </table>
</body>
