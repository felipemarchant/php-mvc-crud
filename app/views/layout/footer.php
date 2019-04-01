
<script>
    window.onload = function () {
        var btnExclude = document.querySelectorAll('.btn-exclude');
        if(btnExclude.length > 0) {
            for (var i = 0, l = btnExclude.length; i < l; i++) {
                btnExclude[i].addEventListener('click', function(event){
                    if(!confirm('Tem certeza que deseja excluir esse item?')) {
                        event.preventDefault();
                    }
                });
            }
        }
    }
</script>
</body>
</html>