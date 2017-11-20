$(function(){
    $(document).ready(function(){
        searchData();
        
        function searchData(query){
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {query:query},
                success:function(data){
                    $("#results").html(data);
                }
            });
        }
        $('#search-text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                searchData(search);
            }else{
                searchData();
            }
        });
    });
});