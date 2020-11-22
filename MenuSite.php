<html lang="fr">

  <head>
  <meta charset="utf-8" />
        <title>Website Style</title>  
	 <link rel="stylesheet" type="text/css" href="style1.css">

		<div id ="header"> <br> 
		<h> GENEGATE </h> <br><br>
			<div class = "searchbar">
  			<form id="form"> 
  			<input type="search" id="query" placeholder = "Search..">
  			<button text-align = "center"> Rechercher </button>
  			</form>
				
			<form action="https://www.google.com/search" class="searchform" method="get" name="searchform" target="_blank">
<input name="sitesearch" type="hidden" value="example.com">
<input autocomplete="on" class="form-control search" name="q" placeholder="Search in example.com" required="required"  type="text">
<button class="button" type="submit">Search</button>
</form>				

			</div>
	</div>

  </head>



   <body>

			<div id ="menu"> 
  			<li><a href="MenuSite">Home</a></li>
  			<li><a href="#"> Access Forum</a></li>
  			<li><a href="YourAccount.html"> Your Account </a></li>
  			<li><a href="Contact.html"> Contact </a></li>
			</div>


			<div class="sidenav"> <br>
			 <a href="#"> Login </a> <br> <br> 
			  <a href="#"> Register </a> <br> <br> 
			  <a href="#"> Submit Search </a> <br><br> 
			  <a href="#"> BLAST </a> <br> <br>
			  <a href="#"> Uniprot </a> <br> <br>
			  <a href="#"> Ensembl </a> <br> <br>
			  <a href="#"> PFAM </a> <br> <br>
			  <a href="#"> Prosite </a> <br> <br>
			  <a href="#"> Articles </a> <br> <br>    
			</div>

			<div id ="searchSeq">
				<form>
				Submit a Sequence Job : <br>
​				<textarea id="txtArea" rows="5" cols="50" id="query" placeholder = "Search.."> </textarea> <br>
 				Séquence :
 				<select> 
  				<option value="nucl"> Nucléotique </option>
  				<option value="2"> Proteique </option>
				</select>
				<input type="submit" value="Search" /> </button> <br><br><br>
				</form>
			</div>

			<div id ="searchGenome">
				<form>
					Submit a Genome Job : <br>
​					<textarea id="txtArea" rows="2" cols="50" id="query" placeholder = "Search.."> </textarea> <br>
					<input type="submit" value="Search" /> </button> <br>
				</form>
			</div>
		
		<div class = "annotations">
    <br><br> Les séquences que vous avez annotées: <br><br>
		</div>

		<div class = "annotate">
    	<input  type="submit" class="btn" value="Annotated Sequences" />  
    	<input type="submit" class="btn" value="Non Annotated Sequences" /> 
    	<input type="submit" class="btn"  value="Start Annotation" />  
		</div>
	</body>


	<div class="bottombar">
  	<a href="#news"> Website Plan</a>
  	<a href="policy.html"> Policy</a>
  	<a href="About us.html">About Us</a>
  	<a href="Contact.html">Contact Us</a>
	</div>

	<div id = "footer">
		© 2020 GeneGATE
	</div> 



</html>

