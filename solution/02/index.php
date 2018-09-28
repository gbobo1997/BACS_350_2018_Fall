<?php 
    $page_title = 'BACS 350 - Project #2 - Includes';
    include "header.php"; 
 ?>

<!--  Your code goes here -->



<p>This is a simple HTML page that demonstrates using an Include to capture boiler-plate code.</p>
<p>This reduces duplication in code.</p>
<p>Learn about the <a href="pattern.php">Include Design Pattern</a></p>

<h2>Problem</h2>

<p>
    Many constructs are repeated on different pages of a website. We need an easy way to use code that we have written
    for several different pages. HTML provides no mechanism that will allow us to reuse HTML code.
</p>
<p>
    One place where this would be handy is in defining a standard HTML structure for every web page in our
    site. All of the code required to start a page and the code to end a page could be packaged in a way
    that we would not have to replicate this code.
</p>

<h2>Solution</h2>

<h3>Header/Footer Alternative</h3>
<p>
    Put all of the HTML code that we want to use into two files. <b>header.php</b> holds the start of the page while <b>footer.php</b> holds the end of the page.
</p>

<p>
    Define a page with the following PHP code.
</p>
<pre>
        include 'header.php';
        < !-- Add HTML code here -- >
        include 'footer.php';
</pre>

<?php include "footer.php"; ?>
