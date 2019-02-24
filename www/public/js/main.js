$(document).ready(function () {

    // отмечаем все как выполненные/невыполненные
    $('#toggle-all').change(function () {
        let checkedAll = $("#toggle-all").prop("checked");
        let liTodoElems = $('ul.todo-list > li');

        $.post({
            url: '/todos/changeAllStatus',
            data: {
                status: checkedAll
            },
            success: function (response) {
                if (checkedAll) {
                    liTodoElems.addClass('completed');
                    liTodoElems.find('input.toggle[type="checkbox"]').prop('checked', true);
                } else {
                    liTodoElems.removeClass('completed');
                    liTodoElems.find('input.toggle[type="checkbox"]').prop('checked', false);
                }
            },
            error: function (response) {
                console.error(response)
            }
        });
    });

    // отмечаем одну как выполненную
    $(document).on('click', 'input.toggle[type="checkbox"]', function () {
        if($(this).prop('checked')) {
            $(this).parent().parent().addClass('completed');
        } else {
            $(this).parent().parent().removeClass('completed');
        }
    });

    // добавление новой задачи
    $('input.new-todo').on('keypress', function (e) {
        if (e.which === 13) {
            let todoInputElem = $('input.new-todo');

            $.post({
                url: '/todos/create',
                data: {
                    task: todoInputElem.val()
                },
                success: function (response) {

                    let todoItemTemplate = $('#item-template').text();

                    todoItemTemplate = todoItemTemplate.replace('<%-id-%>', response.id);

                    $.each(todoItemTemplate.match(/<%-title-%>/ig), function () {
                        todoItemTemplate = todoItemTemplate.replace('<%-title-%>', response.task);
                    });

                    todoItemTemplate = $(todoItemTemplate);

                    $('ul.todo-list').append(todoItemTemplate);

                    todoInputElem.val(null);

                    updateItemsCount();
                },
                error: function (response) {
                    console.error(response)
                }
            });
        }
    });

    // редактирование задачи
    $(document).on('click', 'ul.todo-list > li > div.view > label', function () {
        let liTodoElem = $(this).parent().parent();
        liTodoElem.addClass('editing');

        let editElem = liTodoElem.find('input.edit');
        editElem.focus().focusout(function () {
            $.post({
                url: '/todos/update',
                data: {
                    id: liTodoElem.attr('data-id'),
                    task: editElem.val()
                },
                success: function (response) {
                    liTodoElem.find('label').get(0).innerHTML = response.task;
                    liTodoElem.removeClass('editing');
                },
                error: function (response) {
                    console.error(response)
                }
            });
        });
    });

    // удаление задачи
    $(document).on('click', 'ul.todo-list > li > div.view > button.destroy', function () {
        removeTodoElem($(this).parent().parent());

        // let liTodoElem = $(this).parent().parent();
        // $.post({
        //     url: '/todos/delete',
        //     data: {
        //         id: liTodoElem.attr('data-id')
        //     },
        //     success: function (response) {
        //         liTodoElem.remove();
        //
        //         updateItemsCount();
        //     },
        //     error: function (response) {
        //         console.error(response);
        //     }
        // });
    });

    // фильтры
    $('ul.filters a').click(function (e) {
        e.preventDefault();

        $('ul.filters a.selected').removeClass('selected');
        $(this).addClass('selected');

        $('ul.todo-list li').show();

        switch ($(this).attr('href')) {
            case '#/active':
                $('ul.todo-list li.completed').hide();
                break;
            case '#/completed':
                $('ul.todo-list li:not(.completed)').hide();
                break;
        }

        updateItemsCount();
    });

    // удалить выполненные
    $('button.clear-completed').click(function () {
        let completedLiElems = $('ul.todo-list > li.completed');
        $.each(completedLiElems, function (k, v) {
            removeTodoElem($(v));
        });
    });

});

function removeTodoElem(elem) {
    $.post({
        url: '/todos/delete',
        data: {
            id: elem.attr('data-id')
        },
        success: function (response) {
            elem.remove();

            updateItemsCount();
        },
        error: function (response) {
            console.error(response);
        }
    });
}

function updateItemsCount() {
    $('span.todo-count').find('strong').get(0).innerText = $('ul.todo-list > li:visible').length;
}