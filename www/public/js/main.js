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
        let liTodoElem = $(this).parent().parent();
        let editElem = liTodoElem.find('input.edit');

        saveEditedTodo(liTodoElem, editElem);
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
            saveEditedTodo(liTodoElem, editElem)
        });

        editElem.on('keypress', function (e) {
            if (e.which === 13) {
                saveEditedTodo(liTodoElem, editElem)
            }
        });
    });

    // удаление задачи
    $(document).on('click', 'ul.todo-list > li > div.view > button.destroy', function () {
        removeTodoElem($(this).parent().parent());
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

function saveEditedTodo(liTodoElem, editElem) {
    $.post({
        url: '/todos/update',
        data: {
            id: liTodoElem.attr('data-id'),
            task: editElem.val(),
            done: liTodoElem.find('input[type="checkbox"]').prop('checked')
        },
        success: function (response) {
            liTodoElem.find('label').get(0).innerHTML = response.task;
            liTodoElem.removeClass('editing');
            if (response.done) {
                liTodoElem.addClass('completed');
            } else {
                liTodoElem.removeClass('completed');
            }
        },
        error: function (response) {
            console.error(response)
        }
    });
}

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