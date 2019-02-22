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

                    $.each(todoItemTemplate.match( /<%-title-%>/ig ), function() {
                        todoItemTemplate = todoItemTemplate.replace('<%-title-%>', response.task);
                    });

                    todoItemTemplate = $(todoItemTemplate);

                    $('ul.todo-list').append(todoItemTemplate);

                    todoInputElem.val(null);
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
        let liTodoElem = $(this).parent().parent();
        $.post({
            url: '/todos/delete',
            data: {
                id: liTodoElem.attr('data-id')
            },
            success: function (response) {
                liTodoElem.remove();
            },
            error: function (response) {
                console.error(response)
            }
        });
    });


});