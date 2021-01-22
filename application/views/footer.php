<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Created by Rakesh Gupta</p>
            </div>
        </div>
    </div>
</footer>

<script>
	$(window).on('keydown',function(event){
	    if(event.keyCode==123){
	        return false;	//Prevent from f12
	    } else if(event.ctrlKey && event.shiftKey && event.keyCode==73){
	        return false;  //Prevent from ctrl+shift+i
	    } else if(event.ctrlKey && event.keyCode==73){
	        return false;  //Prevent from ctrl+shift+i
	    }
	});

	$(document).on("contextmenu",function(e){
		e.preventDefault();
	});

</script>

</body>
</html>
