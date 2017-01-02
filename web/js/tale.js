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

    /*------------- checkbox  -----------------*/
    $('td > .check').click(function(event) {
        event.preventDefault();

        var id = $(this).attr("data-c"); //Получить id FilterKey.
        var id2 = $(this).attr("data-d"); //Получить category_id.
        
        /*alert(id);*/
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'check',
            data: { id: id, id2: id2},
            success: function (Data) {
                alert(data.id);
                alert(data.name);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.responseText);
            }
        });

    });

    /*------------- type  -----------------*/
    $('td > .drop').change(function(event) {
        event.preventDefault();

        var id = $(this).attr("data-c"); //Получить id FilterKey.
        var id2 = $(this).attr("data-d"); //Получить category_id.
        var id3 = $(this).val(); //Получить priznak.        
        /*alert($(this).val());*/
        
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'type',
            data: { id: id, id2: id2, id3: id3},
            success: function (Data) {
                alert(data.id);
                alert(data.name);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.responseText);
            }
        });

    });

    /*-------------  modal2 (filter)  ---------------*/
    $('.popupModal2').click(function(e) {
        e.preventDefault();

        $('#modal2').modal('show').find('.modal-body')
            .load($(this).attr('href'));
    });

    /*-------------  Filter CheckBox  ---------------*/
    $('[name="checkbox-sb"]').change(function(e) {
        e.preventDefault();

        var key = $(this).attr("data-key"); //Получить свойство.
        var category = $(this).attr("data-category"); //Получить category->title.
        var value = $(this).attr("data-value"); //Получить значение свойства.

        /*$(this).checked = !$(this).checked;*/
        /*alert(key+' '+category+' '+value);*/

        $.ajax({
            type: 'GET',
            /*dataType: 'json',*/
            url: 'checkbox',
            data: { category: category, key: key, value: value},
            success: function () {
                console.log('Успешно! (CheckBox)');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.responseText);
            }
        });


    });

});

