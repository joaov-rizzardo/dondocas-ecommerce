<script>
    function showLoading(){
        document.querySelector('#loading').style.display = "flex"
    }

    function hideLoading(){
        document.querySelector('#loading').style.display = "none"
    }
</script>

<link rel="stylesheet" href="<?=$pathBase?>css/loading.css">

<div id="loading">
        <img src="<?=$pathBase?>img/loading.gif" alt="">
</div>