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

 /*   /!*-------------  filter  ---------------*!/
    //отследить изменения первого элемента DropDown
    $('select').eq( 0 ).change(function(event) {
        event.preventDefault();

        var url='test?id='+$(this).val(); //в контроллер
        /!*alert(url);*!/
        location.href = url;
    });*/

});

