let Management = {
    action()
    {
        let postNumber = document.getElementById("post_number"),
        seeWebsite = document.getElementById('see_website'),
        modify = document.getElementById('modify'),
        remove = document.getElementById('remove'),
        removal = document.getElementById('removal');

        seeWebsite.addEventListener("click", function (){
            open("index.php?action=post&id=" + postNumber.textContent+"#menu");
        });

        modify.addEventListener("click", function () {
            location.href="index.php?action=admin&status=connected&activity=updatePost&id=" +  postNumber.textContent;
        });

        remove.addEventListener("click", function () {         
            removal.style.display ="block";          
        });
    }
}

Management.action();  