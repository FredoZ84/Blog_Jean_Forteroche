let Posts = {
	access() {
		let accessPost = document.getElementById("access_post"), 
	    article = document.getElementById("article"),
	    link = 'index.php?action=post&id=',
	    titleAnchor ='#title'
	    option = document.querySelectorAll("option") ;
 

		article.addEventListener("change", function (e) {
		    accessPost.style.display = 'inline';
		    accessPost.style.color = 'linen';
		    accessPost.href = link + e.target.value + titleAnchor ;   
		});
	}
}

Posts.access();	