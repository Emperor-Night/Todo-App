require('./bootstrap');


$(function () {

    // $("#customSuccess,#customInfo,#customError").delay(4000).fadeToggle(2500);


    // Ajax token header
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Create
    $("body").on("submit", "#createForm", function (event) {

        event.preventDefault();

        var url = $(this).attr("action");
        var input = $("#createForm #name");
        var inputValue = input.val().trim();

        if (inputValue.length) {
            input.removeClass("borderRed");
        } else {
            input.addClass("borderRed");
            return;
        }

        input.val("");

        $.ajax({

            method: "POST",
            url: url,
            data: {name: inputValue},
            success: function (response) {

                displayMessage();
                var todo = response.todo;

                var newLi = `
                                <li class="list-group-item mt-3">

                                    <h3 class="float-left" data-id="${todo.id}"> ${todo.name} </h3>

                                    <form action="/todos/${todo.id}" method="POST" class="deleteForm float-right">
                                        <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal">
                                            Delete <i class='far fa-trash-alt'></i>
                                        </button>
                                    </form>

                                    <form action="/todos/${todo.id}/markCompleted" method="POST" class="statusForm float-right mx-4">
                                        <button class="btn btn-warning"> Uncompleted <i class="far fa-thumbs-down"></i> </button>
                                    </form>

                                    <a href="/todos/${todo.id}/edit" class="editButton btn btn-info float-right"
                                        data-toggle="modal" data-target="#myModal">
                                        Edit <i class='far fa-edit'></i>
                                    </a>
                                    
                                </li>
                                `;

                $("h3.message").remove();

                var ulList = $("ul.list-group");

                if (ulList.length) {
                    ulList.prepend(newLi);
                } else {
                    $("#mainContent").append("<ul class='list-group mt-3'>" + newLi + "</ul>");
                }

            },
            error: function (xhr, textStatus, errorThrown) {
                showError(xhr, errorThrown);
            }

        });

    });

    $("body").on("keyup", "#createForm #name", function () {
        if ($(this).val().trim().length) {
            $(this).removeClass("borderRed");
        }
    });


    // Status
    $("body").on("submit", ".statusForm", function (event) {

        event.preventDefault();

        var form = $(this);
        var url = form.attr("action");
        var button = form.children().last();

        $.ajax({

            method: "PATCH",
            url: url,
            success: function (response) {

                displayMessage();
                var todo = response.todo;

                if (todo.status) {

                    form.attr({
                        "action": "/todos/" + todo.id + "/markUncompleted",
                    });

                    button.removeClass("btn-warning");
                    button.addClass("btn-success");
                    button.html("Completed <i class='far fa-thumbs-up'></i>");

                } else {

                    form.attr({
                        "action": "/todos/" + todo.id + "/markCompleted"
                    });

                    button.removeClass("btn-success");
                    button.addClass("btn-warning");
                    button.html("Uncompleted <i class='far fa-thumbs-down'></i>");

                }

            },
            error: function (xhr, textStatus, errorThrown) {
                showError(xhr, errorThrown);
            }

        });

    });


    // Edit
    $("body").on("click", ".editButton", function () {

        url = $(this).attr("href");

        $.ajax({

            method: "GET",
            url: url,
            success: function (response) {
                var todo = response.todo;
                $("#updateForm #name").val(todo.name);
                $("#updateForm").attr("action", "/todos/" + todo.id);
            },
            error: function (xhr, textStatus, errorThrown) {
                showError(xhr, errorThrown);
            }

        });

    });


    // Update
    $("body").on("keyup", "#updateForm #name", function () {

        var inputValue = $(this).val().trim();
        var url = $("#updateForm").attr("action");

        if (inputValue.length) {
            $("#label").removeClass("labelRed");
            $(this).removeClass("borderRed");
        } else {
            $("#label").addClass("labelRed");
            $(this).addClass("borderRed");
            return;
        }

        $.ajax({

            method: "PATCH",
            url: url,
            data: {name: inputValue},
            success: function (response) {
                $("h3[data-id='" + response.todo.id + "']").html(inputValue);
            },
            error: function (xhr, textStatus, errorThrown) {
                showError(xhr, errorThrown);
            }

        });

    });

    $("body").on("submit", "#updateForm", function (event) {
        event.preventDefault();
    });


    // Delete
    $("body").on("submit", ".deleteForm", function (event) {

        event.preventDefault();

        var url = $(this).attr("action");
        var li = $(this).parent();

        $("#confirmDelete").off().on("click", function () {

            $.ajax({

                method: "DELETE",
                url: url,
                success: function (response) {

                    displayMessage();
                    li.remove();

                    if (!response.count) {
                        $("ul.list-group").remove();
                        $("#mainContent").append("<h3 class='text-center message'>No todo found</h3>");
                    }

                },
                error: function (xhr, textStatus, errorThrown) {
                    showError(xhr, errorThrown);
                }

            });

        });

    });


    // Search
    $("body").on("keyup", "#searchForm #name", function () {

        var inputVal = $(this).val().toLowerCase().trim();
        $("h3.message").remove();
        var i = 0;

        $("h3").not(".message").filter(function () {

            var hValue = $(this).html().toLowerCase().trim();
            var status = hValue.indexOf(inputVal) >= 0;
            $(this).parent().toggle(status);

            if (status) {
                i++;
            }

        });

        if (!i) {
            $("#mainContent").append("<h3 class='text-center message'>No todo found</h3>");
        }

    });

    $("body").on("submit", "#searchForm", function (event) {
        event.preventDefault();
    });


    // Custom helper functions

    function displayMessage() {
        $("#customSuccess").show();
        $("#customSuccess").delay(2000).fadeOut(500);
    }

    function showError(xhr, errorThrown) {
        alert(xhr.status + " | " + errorThrown);
        location.reload();
    }


});