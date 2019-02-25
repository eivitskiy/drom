<section class="todoapp">
    <header class="header">
        <h1>todos</h1>
        <input class="new-todo" placeholder="What needs to be done?" autofocus>
    </header>
    <!-- This section should be hidden by default and shown when there are todos -->
    <section class="main">
        <input id="toggle-all" class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">

            <?php foreach($todos as $todo): ?>
            <li <?php echo ($todo->getDone() ? 'class="completed"' : null) ?> data-id="<?php echo $todo->getId() ?>">
                <div class="view">
                    <input class="toggle" type="checkbox" <?php echo ($todo->getDone() ? 'checked' : null) ?>>
                    <label><?php echo $todo->getTask() ?></label>
                    <button class="destroy"></button>
                </div>
                <input class="edit" value="<?php echo $todo->getTask() ?>">
            </li>
            <?php endforeach ?>
        </ul>
    </section>
    <!-- This footer should hidden by default and shown when there are todos -->
    <footer class="footer">
        <!-- This should be `0 items left` by default -->
        <span class="todo-count"><strong><?php echo count($todos) ?></strong> item left</span>
        <!-- Remove this if you don't implement routing -->
        <ul class="filters">
            <li>
                <a class="selected" href="#/">All</a>
            </li>
            <li>
                <a href="#/active">Active</a>
            </li>
            <li>
                <a href="#/completed">Completed</a>
            </li>
        </ul>
        <!-- Hidden if no completed items are left ↓ -->
        <button class="clear-completed">Clear completed</button>
    </footer>
</section>

<footer class="info">
    <p>Double-click to edit a todo</p>
    <!-- Remove the below line ↓ -->
    <p>Template by <a href="http://sindresorhus.com">Sindre Sorhus</a></p>
    <!-- Change this out with your name and url ↓ -->
    <p>Created by <a href="http://todomvc.com">you</a></p>
    <p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
</footer>





<script type="text/template" id="item-template">
    <li data-id="<%-id-%>">
        <div class="view">
            <input class="toggle" type="checkbox">
            <label><%-title-%></label>
            <button class="destroy"></button>
        </div>
        <input class="edit" value="<%-title-%>">
    </li>
</script>

<script type="text/template" id="stats-template">
    <span class="todo-count"><strong><%= remaining %></strong> <%= remaining === 1 ? 'item' : 'items' %> left</span>
    <ul class="filters">
        <li>
            <a class="selected" href="#/">All</a>
        </li>
        <li>
            <a href="#/active">Active</a>
        </li>
        <li>
            <a href="#/completed">Completed</a>
        </li>
    </ul>
    <% if (completed) { %>
    <button class="clear-completed">Clear completed</button>
    <% } %>
</script>