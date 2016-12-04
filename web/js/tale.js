$(document).ready(function(){

    /*-------------  modal  ---------------*/
    $('.popupModal').click(function(e) {
            e.preventDefault();

            $('#modal').modal('show').find('.modal-body')
                .load($(this).attr('href'));
        });

    /*-------------  tree  ---------------*/
    $('.trees').click(function(event) {
        event.preventDefault();

        var cat = $(this).attr("href"); //Получить текст ссылки
        $('select').val(cat);
        /*alert(cat);*/
        $('#treeModal').modal('hide');
    });
});

