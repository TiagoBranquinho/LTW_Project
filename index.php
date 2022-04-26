<?php 
    session_start();
    include_once('templates/common.tpl.php');
    output_header();
?>
<main>
<div id="welcome">
<div id="bigLogo">
<img src="https://picsum.photos/100" alt="logopic">
<h2>FOOD CENTER</h2>
<h4>Since 2022</h4>
</div>
<div id="search">
<h1>Welcome</h1>
<form>
<select name="restaurant">
    <option disabled selected value><h3>Search restaurants here</h3></option>
    <option value="1">Tasca</option>
    <option value="2">KFC</option>
    <option value="3">Sabor Gaúcho</option>
</select>
</form>

</div>
</div>
</main>
<?php output_footer();?>