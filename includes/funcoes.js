
        $(function(){

            const url_base = 'http://localhost:8000/api'; 

            $(".vote").click(function(){

                let id_production = $(this).data('production');
                console.log(id_production)

                $.post( `${url_base}/vote`, { production: id_production } )
                .done(function( data ) {                
                
                    alert(data.message);
                } )                
                .fail(function() {
                    alert('Falha ao contabilizar seu voto')

                })
            })
        });
    