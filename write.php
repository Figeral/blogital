    <body>        
        <script>
            $(function(){
            setTimeout(function() {
                $('#error').fadeOut();
            }, 3000); 

            });
        </script>    
		<div id="container">
            <h1>New Post</h1>
            <form method="post" action="">                 
                <div id = "inputtitle">
                    <input id = "txttitle" type="text" name="title" placeholder="Enter Title" autofocus>                    
                </div>
                <div id="message">
                    <textarea name = "post"></textarea>
                    <script>CKEDITOR.replace('post', {height: 500});
                    </script>                    
                </div>
                <div id = "error" class="error">Error Message Here</div>
                <div id="submit-section">        
                    <input id = "postsubmit" class="btn btn-primary" type="submit" name="submit" value="Send" />                    
                    <select id = "postoptions" class = "custom-select" name = "audience">
                        <option value = ''>Available to: </option>
                        <option value = '1'>Public</option>
                        <option value = '2'>Members Only</option>           
                    </select>                                        
                </div>                
            </form>                
		</div>
        <div id = 'postlogout'>
            <a href = "logout.php?admin=1">Click here to logout</a> | 
            <a href = "read.php" target="_blank">Click here to read posts</a>            
        </div>        

	</body>
</html>