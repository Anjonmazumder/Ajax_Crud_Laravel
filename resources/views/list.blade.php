
<html>
    <head>
        <title>Ajax Todo List</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />




    </head>
    <body>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6">

                    <div class="panel panel-primary">
                        <div class="panel-heading">Todo List
                            <a href="#" class="pull-right" style="color:white;" data-toggle="modal" data-target="#myModal" id="addNew">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="panel-body">

                            <ul class="list-group"  id="items">
                                @foreach($items as $item)
                                <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">{{$item->item_name}}
                                    <input type="hidden" id="itemId"value="{{$item->id}}"> 
                                </li>

                                @endforeach

                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <input type="text" name="searchItem" id="searchItem" placeholder="Search" class="form-control">

                </div>

                <div class="modal" tabindex="-1" role="dialog" id="myModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title">Add New Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden"id="hid">
                                <p>
                                    <input type="text" placeholder="Write Item Here" class="form-control" id="addItem">
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" style="display:none;" id="saveChanges" data-dismiss="modal">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="display: none;" id="delete">Delete</button>
                                <button type="button" class="btn btn-success" id="addButton" data-dismiss="modal">Add New Item</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        {{ csrf_field() }}





        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 <script>
$(document).ready(function () {
    $(document).on('click', '.ourItem', function (event) {
        var itemName = $(this).text();
        var id = $(this).find("#itemId").val();
        console.log(id);
        $('#title').text('Edit Item');
        var itemName = $.trim(itemName);

        $("#addItem").val(itemName);
        $("#delete").show(400);
        $("#saveChanges").show(400);
        $("#addButton").hide(400);
        $("#hid").val(id);
        //console.log(itemName);



    });
    $(document).on('click', '#addNew', function (event) {
        $('#title').text('Add New Item');

        $("#addItem").val("");
        $("#delete").hide(400);
        $("#saveChanges").hide(400);
        $("#addButton").show(400);




    });


    $("#addButton").click(function (event) {
        var name = $("#addItem").val();
        //console.log(name);
        if (name === "") {
            swal("Error!", "Item Name can not be blank", "error");
        }
        else {
            $.post("list",
                    {
                        itemName: name,
                        '_token': $('input[name=_token]').val()
                    },
            function (data) {
                $("#items").load(location.href + ' #items');
                swal("Success!", "Data inserted Successfully", "success", {
                    timer: 2000
                });
                $("#addItem").val("");
                //console.log(data);


            });
        }

    });
    $("#delete").click(function (event) {

        var id = $("#hid").val();
        //console.log(id);
        $.post("delete",
                {
                    id: id,
                    '_token': $('input[name=_token]').val()
                },
        function (data) {

            $("#items").load(location.href + ' #items');

            swal("Success!", "Data Deleted Successfully", "success", {
                timer: 2000
            });

            //console.log(data);


        });

    });
    $("#saveChanges").click(function (event) {

        var id = $("#hid").val();
        var value = $("#addItem").val();
        ;
        console.log(value);
        $.post("update",
                {
                    id: id,
                    itemName: value,
                    '_token': $('input[name=_token]').val()
                },
        function (data) {

            $("#items").load(location.href + ' #items');

            swal("Success!", "Data Updated Successfully", "success", {
                timer: 2000
            });

            //console.log(data);


        });

    });
    $(function () {

        $("#searchItem").autocomplete({
            source:"{{url('search')}}"
        });
    });


});

 </script>

    </body>
</html>


